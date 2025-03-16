<?php

namespace App\Http\Controllers;

use App\Models\Veterinario;
use Illuminate\Http\Request;

class VeterinarioController extends Controller
{
    public function index()
    {
        $veterinarios = Veterinario::all();
        return view('veterinarios.index', compact('veterinarios'));
    }

    public function create()
    {
        return view('veterinarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombreVete' => 'required',
            'correo' => 'required|email|unique:veterinarios',
            'especialidad' => 'required',
            'telefono' => 'required'
        ]);

        Veterinario::create($request->all());
        return redirect()->route('veterinarios.index')
            ->with('success', 'Veterinario creado exitosamente');
    }

    public function show(Veterinario $veterinario)
    {
        return view('veterinarios.show', compact('veterinario'));
    }

    public function edit(Veterinario $veterinario)
    {
        return view('veterinarios.edit', compact('veterinario'));
    }

    public function update(Request $request, Veterinario $veterinario)
    {
        $request->validate([
            'nombreVete' => 'required',
            'correo' => 'required|email|unique:veterinarios,correo,'.$veterinario->idVete.',idVete',
            'especialidad' => 'required',
            'telefono' => 'required'
        ]);

        $veterinario->update($request->all());
        return redirect()->route('veterinarios.index')
            ->with('success', 'Veterinario actualizado exitosamente');
    }

    public function destroy(Veterinario $veterinario)
    {
        $veterinario->delete(); // Esto aplicará softDelete
        return redirect()->route('veterinarios.index')
            ->with('success', 'Veterinario eliminado exitosamente');
    }
    
    // Método opcional para ver registros eliminados
    public function trashed()
    {
        $veterinarios = Veterinario::onlyTrashed()->get();
        return view('veterinarios.trashed', compact('veterinarios'));
    }
    
    // Método opcional para restaurar registros
    public function restore($id)
    {
        Veterinario::withTrashed()->find($id)->restore();
        return redirect()->route('veterinarios.index')
            ->with('success', 'Veterinario restaurado exitosamente');
    }
    
    // Método opcional para eliminar permanentemente
    public function forceDelete($id)
    {
        Veterinario::withTrashed()->find($id)->forceDelete();
        return redirect()->route('veterinarios.trashed')
            ->with('success', 'Veterinario eliminado permanentemente');
    }
}