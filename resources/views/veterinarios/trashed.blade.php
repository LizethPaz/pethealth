@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Veterinarios Eliminados
                            <a href="{{ route('veterinarios.index') }}" class="btn btn-primary float-end">Volver</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Especialidad</th>
                                    <th>Teléfono</th>
                                    <th>Eliminado el</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($veterinarios as $veterinario)
                                <tr>
                                    <td>{{ $veterinario->idVete }}</td>
                                    <td>{{ $veterinario->nombreVete }}</td>
                                    <td>{{ $veterinario->correo }}</td>
                                    <td>{{ $veterinario->especialidad }}</td>
                                    <td>{{ $veterinario->telefono }}</td>
                                    <td>{{ $veterinario->deleted_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <form action="{{ route('veterinarios.restore', $veterinario->idVete) }}" method="POST" style="display: inline-block">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-success btn-sm">Restaurar</button>
                                        </form>
                                        <form action="{{ route('veterinarios.force-delete', $veterinario->idVete) }}" method="POST" style="display: inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar permanentemente este veterinario?')">Eliminar Permanentemente</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection