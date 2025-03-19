<?php

namespace App\Http\Controllers;

use App\Models\Dueno;
use App\Models\Mascota;
use Illuminate\Http\Request;

class DuenoController extends Controller
{
    /**
     * Muestra un listado de dueños.
     */
    public function index()
    {
        $duenos = Dueno::with('mascota')->paginate(10);
        return view('duenos.index', compact('duenos'));
    }

    /**
     * Muestra el formulario para crear un nuevo dueño.
     */
    public function create()
    {
        $mascotas = Mascota::all();
        return view('duenos.create', compact('mascotas'));
    }

    /**
     * Almacena un nuevo dueño en la base de datos.
     */
    public function store(Request $request)
    {   
        $request->validate([
            'nombre' => 'required|string|max:255',
            'idMascota' => 'required|exists:mascotas,idMascota',
            'celular' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
            'correo' => 'required|email|max:255',
            'ciudad' => 'required|string|max:255',
        ]);

        Dueno::create($request->all());

        return redirect()->route('duenos.index')
            ->with('success', 'Dueño registrado exitosamente.');
    }

    /**
     * Muestra los detalles de un dueño específico.
     */
    public function show(Dueno $dueno)
    {
        $dueno->load('mascota');
        return view('duenos.show', compact('dueno'));
    }

    /**
     * Muestra el formulario para editar un dueño.
     */
    public function edit(Dueno $dueno)
    {
        $mascotas = Mascota::all();
        return view('duenos.edit', compact('dueno', 'mascotas'));
    }

    /**
     * Actualiza la información de un dueño en la base de datos.
     */
    public function update(Request $request, Dueno $dueno)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'idMascota' => 'required|exists:mascotas,idMascota',
            'celular' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
            'correo' => 'required|email|max:255',
            'ciudad' => 'required|string|max:255',
        ]);

        $dueno->update($request->all());

        return redirect()->route('duenos.index')
            ->with('success', 'Información del dueño actualizada exitosamente.');
    }

    /**
     * Elimina un dueño (soft delete).
     */
    public function destroy(Dueno $dueno)
    {
        $dueno->delete();

        return redirect()->route('duenos.index')
            ->with('success', 'Dueño eliminado exitosamente.');
    }
}

?>