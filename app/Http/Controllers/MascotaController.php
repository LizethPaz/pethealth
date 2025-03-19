<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use Illuminate\Http\Request;

class MascotaController extends Controller
{
    /**
     * Muestra un listado de mascotas.
     */
    public function index()
    {
        //ver de a 10 mascotas
        $mascotas = Mascota::paginate(10);
        return view('mascotas.index', compact('mascotas'));
    }

    /**
     * Muestra el formulario para crear una nueva mascota.
     */
    public function create()
    {
        return view('mascotas.create');
    }

    /**
     * Almacena una nueva mascota en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomMascota' => 'required|string|max:255',
            'edadMascota' => 'required|integer|min:0',
            'colorMascota' => 'required|string|max:255',
            'tipoMascota' => 'required|string|max:255',
        ]);

        Mascota::create($request->all());

        return redirect()->route('mascotas.index')
            ->with('success', 'Mascota creada exitosamente.');
    }

    /**
     * Muestra los detalles de una mascota específica.
     */
    public function show(Mascota $mascota)
    {
        return view('mascotas.show', compact('mascota'));
    }

    /**
     * Muestra el formulario para editar una mascota.
     */
    public function edit(Mascota $mascota)
    {
        return view('mascotas.edit', compact('mascota'));
    }

    /**
     * Actualiza la información de una mascota en la base de datos.
     */
    public function update(Request $request, Mascota $mascota)
    {
        $request->validate([
            'nomMascota' => 'required|string|max:255',
            'edadMascota' => 'required|integer|min:0',
            'colorMascota' => 'required|string|max:255',
            'tipoMascota' => 'required|string|max:255',
        ]);

        $mascota->update($request->all());

        return redirect()->route('mascotas.index')
            ->with('success', 'Mascota actualizada exitosamente.');
    }

    /**
     * Elimina una mascota (soft delete).
     */
    public function destroy(Mascota $mascota)
    {
        if ($mascota->dueno()->exists()) {
            return redirect()->route('mascotas.index')
                ->with('error', 'No se puede eliminar la mascota porque tiene un dueño asociado.');
        }
    
        $mascota->delete();
        return redirect()->route('mascotas.index')
            ->with('success', 'Mascota eliminada exitosamente.');
    }
}
?>