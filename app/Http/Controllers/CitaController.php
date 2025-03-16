<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Dueno;
use App\Models\Mascota;
use App\Models\Veterinario;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Mail\CitaConfirmacionMail;
use Illuminate\Support\Facades\Mail;
use \Illuminate\Support\Facades\Log;


class CitaController extends Controller 
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $citas = Cita::with(['dueno', 'mascota', 'veterinario'])->orderBy('fecha')->get();
        return view('citas.index', compact('citas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $duenos = Dueno::all();
        $mascotas = Mascota::all();
        $veterinarios = Veterinario::all();
        
        // Generar horas disponibles (intervalos de 15 minutos desde 6:00 hasta 20:00)
        $horasDisponibles = $this->generarHorasDisponibles();
        
        return view('citas.create', compact('duenos', 'mascotas', 'veterinarios', 'horasDisponibles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'fecha' => 'required|date',
        'hora' => 'required',
        'idDueno' => 'required|exists:duenos,idDueno',
        'idMascota' => 'required|exists:mascotas,idMascota',
        'idVete' => 'required|exists:veterinarios,idVete',
        'tipoCita' => 'required|string|max:255',
        'observaciones' => 'nullable|string'
    ]);
    
    // Combinar fecha y hora
    $fechaHora = Carbon::parse($request->fecha . ' ' . $request->hora);
    
    // Verificar si ya existe una cita en ese horario para el mismo veterinario
    $citaExistente = Cita::where('fecha', $fechaHora)
                          ->where('idVete', $request->idVete)
                          ->exists();
                          
    if ($citaExistente) {
        return back()->withErrors(['hora' => 'Ya existe una cita programada con este veterinario en este horario'])->withInput();
    }
    
    // Crear la cita una sola vez con los datos correctos
    $cita = Cita::create([
        'fecha' => $fechaHora,
        'idDueno' => $request->idDueno,
        'idMascota' => $request->idMascota,
        'idVete' => $request->idVete,
        'tipoCita' => $request->tipoCita,
        'observaciones' => $request->observaciones,
    ]);
    
    // Cargar la relación de dueño y enviar el correo
    $cita->load('dueno');
    $dueno = $cita->dueno;
    
    if ($dueno && $dueno->correo) {
        try {
            Log::info("Intentando enviar correo a: " . $cita->dueno->correo);
            
            // Envío directo (sin cola) para depuración
            Mail::to($cita->dueno->correo)->send(new CitaConfirmacionMail($cita));
            
            Log::info("Correo enviado exitosamente a: " . $cita->dueno->correo);
            return redirect()->route('citas.index')->with('success', 'Cita creada y correo enviado exitosamente');
        } catch (\Exception $e) {
            Log::error("Error al enviar correo: " . $e->getMessage());
            return redirect()->route('citas.index')->with('warning', 'Cita creada pero hubo un problema al enviar el correo: ' . $e->getMessage());
        }
    } else {
        Log::warning("No se pudo enviar correo: correo del dueño no disponible");
        return redirect()->route('citas.index')->with('warning', 'Cita creada pero no se pudo enviar correo (correo no disponible)');
    }
}
    /**
     * Display the specified resource.
     */
    public function show(Cita $cita)
    {
        $cita->load(['dueno', 'mascota', 'veterinario']);
        return view('citas.show', compact('cita'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cita $cita)
    {
        $duenos = Dueno::all();
        $mascotas = Mascota::all();
        $veterinarios = Veterinario::all();
        $horasDisponibles = $this->generarHorasDisponibles();
        
        // Obtener la hora de la cita en formato para el select
        $hora = Carbon::parse($cita->fecha)->format('H:i');
        
        return view('citas.edit', compact('cita', 'duenos', 'mascotas', 'veterinarios', 'horasDisponibles', 'hora'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cita $cita)
    {
        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required',
            'idDueno' => 'required|exists:duenos,idDueno',
            'idMascota' => 'required|exists:duenos,idMascota',
            'idVete' => 'required|exists:veterinarios,idVete',
            'tipoCita' => 'required|string|max:255',
            'observaciones' => 'nullable|string'
        ]);
        
        // Combinar fecha y hora
        $fechaHora = Carbon::parse($request->fecha . ' ' . $request->hora);
        
        // Verificar si ya existe una cita en ese horario para el mismo veterinario (excluyendo la cita actual)
        $citaExistente = Cita::where('fecha', $fechaHora)
                            ->where('idVete', $request->idVete)
                            ->where('idCita', '!=', $cita->idCita)
                            ->exists();
                            
        if ($citaExistente) {
            return back()->withErrors(['hora' => 'Ya existe una cita programada con este veterinario en este horario'])->withInput();
        }
        
        $cita->update([
            'fecha' => $fechaHora,
            'idDueno' => $request->idDueno,
            'idMascota' => $request->idMascota,
            'idVete' => $request->idVete,
            'tipoCita' => $request->tipoCita,
            'observaciones' => $request->observaciones,
        ]);
        
        return redirect()->route('citas.index')->with('success', 'Cita actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cita $cita)
    {
        $cita->delete();
        return redirect()->route('citas.index')->with('success', 'Cita eliminada exitosamente');
    }
    
    /**
     * Generar horarios disponibles
     */
    private function generarHorasDisponibles()
    {
        $horasDisponibles = [];
        $horaInicio = Carbon::createFromTime(6, 0, 0);
        $horaFin = Carbon::createFromTime(20, 0, 0);
        
        while ($horaInicio <= $horaFin) {
            $horasDisponibles[] = $horaInicio->format('H:i');
            $horaInicio->addMinutes(15);
        }
        
        return $horasDisponibles;
    }
    
    /**
     * Obtener mascotas por dueño para cargar dinámicamente
     */
    public function getMascotasPorDueno($idDueno)
    {
        $mascotas = Mascota::where('idDueno', $idDueno)
                           ->get(['idMascota', 'nombre']);      
        return response()->json($mascotas);

    }

    /**
     * Obtener disponibilidad del veterinario para una fecha específica
     */
    public function getDisponibilidadVeterinario($idVete, $fecha)
    {
        // Convertir la fecha recibida
        $fecha = Carbon::parse($fecha);
        
        // Obtener todas las citas del veterinario en esa fecha
        $citasVeterinario = Cita::where('idVete', $idVete)
                                ->whereDate('fecha', $fecha->toDateString())
                                ->get();
        
        // Obtener las horas ocupadas
        $horasOcupadas = [];
        foreach ($citasVeterinario as $cita) {
            $horasCita = Carbon::parse($cita->fecha)->format('H:i');
            $horasOcupadas[] = $horasCita;
        }
        
        // Generar todas las horas disponibles
        $todasHoras = $this->generarHorasDisponibles();
        
        // Filtrar las horas disponibles
        $horasDisponibles = array_filter($todasHoras, function($hora) use ($horasOcupadas) {
            return !in_array($hora, $horasOcupadas);
        });
        
        return response()->json(['horasDisponibles' => array_values($horasDisponibles)]);
    }

    /**
     * Display a calendar view of appointments.
     */
    public function calendar(Request $request)
    {
        // Obtener mes y año de la URL, o usar el mes actual
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);
        
        // Crear fecha Carbon para el mes solicitado
        $date = Carbon::createFromDate($year, $month, 1);
        
        // Obtener mes anterior y siguiente para navegación
        $prevDate = $date->copy()->subMonth();
        $nextDate = $date->copy()->addMonth();
        
        $prevMonth = $prevDate->month;
        $prevYear = $prevDate->year;
        $nextMonth = $nextDate->month;
        $nextYear = $nextDate->year;
        
        // Obtener nombre del mes
        $monthName = $date->locale('es')->monthName;
        
        // Determinar el primer día del calendario (lunes de la semana del primer día del mes)
        $firstDayOfCalendar = $date->copy()->startOfMonth()->startOfWeek(Carbon::MONDAY);
        
        // Determinar el último día del calendario (domingo de la semana del último día del mes)
        $lastDayOfCalendar = $date->copy()->endOfMonth()->endOfWeek(Carbon::SUNDAY);
        
        // Obtener todas las citas para el período mostrado
        $citas = Cita::with(['dueno', 'mascota', 'veterinario'])
            ->whereBetween('fecha', [$firstDayOfCalendar->copy()->startOfDay(), $lastDayOfCalendar->copy()->endOfDay()])
            ->get();
        
        // Agrupar las citas por fecha (para acceso más rápido)
        $citasPorFecha = [];
        foreach ($citas as $cita) {
            $citaFecha = Carbon::parse($cita->fecha)->format('Y-m-d');
            if (!isset($citasPorFecha[$citaFecha])) {
                $citasPorFecha[$citaFecha] = [];
            }
            $citasPorFecha[$citaFecha][] = $cita;
        }
        
        // Construir días del calendario
        $calendarDays = [];
        $currentDay = $firstDayOfCalendar->copy();
        
        while ($currentDay <= $lastDayOfCalendar) {
            $formattedDate = $currentDay->format('Y-m-d');
            $currentMonth = $currentDay->month == $month;
            
            $calendarDays[] = [
                'date' => $formattedDate,
                'dayNumber' => $currentDay->day,
                'weekday' => $currentDay->dayOfWeek,
                'today' => $currentDay->isToday(),
                'currentMonth' => $currentMonth,
                'citas' => $currentMonth && isset($citasPorFecha[$formattedDate]) ? $citasPorFecha[$formattedDate] : []
            ];
            
            $currentDay->addDay();
        }
        
        // Obtener lista de veterinarios para filtrado
        $veterinarios = Veterinario::all();
        
        return view('citas.calendar', compact(
            'calendarDays', 'month', 'year', 'monthName', 
            'prevMonth', 'prevYear', 'nextMonth', 'nextYear',
            'veterinarios'
        ));
    }
}