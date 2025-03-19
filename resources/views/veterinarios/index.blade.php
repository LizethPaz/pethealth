@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Lista de Veterinarios
                            <a href="{{ route('veterinarios.create') }}" class="btn btn-primary float-end">Agregar Veterinario</a>
                            <a href="{{ route('veterinarios.trashed') }}" class="btn btn-warning float-end me-2">Ver Eliminados</a>
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
                                    <td>
                                        <a href="{{ route('veterinarios.show', $veterinario->idVete) }}" class="btn btn-info btn-sm">Ver</a>
                                        <a href="{{ route('veterinarios.edit', $veterinario->idVete) }}" class="btn btn-primary btn-sm">Editar</a>
                                        <form action="{{ route('veterinarios.destroy', $veterinario->idVete) }}" method="POST" style="display: inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este veterinario?')">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                        {{ $veterinarios->links('pagination::simple-bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection