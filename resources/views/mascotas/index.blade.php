@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Lista de Mascotas
                            <a href="{{ route('mascotas.create') }}" class="btn btn-primary float-end">Agregar Mascota</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <table class="table table-responsive table-bordered table-striped">  
                        <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Edad</th>
                                    <th>Color</th>
                                    <th>Tipo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($mascotas as $mascota)
                                    <tr>
                                        <td>{{ $mascota->idMascota }}</td>
                                        <td>{{ $mascota->nomMascota }}</td>
                                        <td>{{ $mascota->edadMascota }}</td>
                                        <td>{{ $mascota->colorMascota }}</td>
                                        <td>{{ $mascota->tipoMascota }}</td>
                                        <td>
                                            <a href="{{ route('mascotas.show', $mascota->idMascota) }}" class="btn btn-info btn-sm">Ver</a>
                                            <a href="{{ route('mascotas.edit', $mascota->idMascota) }}" class="btn btn-primary btn-sm">Editar</a>
                                            <form action="{{ route('mascotas.destroy', $mascota->idMascota) }}" method="POST" style="display: inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta mascota?')">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No hay mascotas registradas</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                        {{ $mascotas->links('pagination::simple-bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
