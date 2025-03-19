@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Lista de Dueños
                            <a href="{{ route('duenos.create') }}" class="btn btn-primary float-end">Registrar Dueño</a>
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
                                    <th>Mascota</th>
                                    <th>Celular</th>
                                    <th>Correo</th>
                                    <th>Ciudad</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($duenos as $dueno)
                                <tr>
                                    <td>{{ $dueno->idDueno }}</td>
                                    <td>{{ $dueno->nombre }}</td>
                                    <td>{{ $dueno->mascota->nomMascota ?? 'Sin mascota' }}</td>
                                    <td>{{ $dueno->celular }}</td>
                                    <td>{{ $dueno->correo }}</td>
                                    <td>{{ $dueno->ciudad }}</td>
                                    <td>
                                        <a href="{{ route('duenos.show', $dueno->idDueno) }}" class="btn btn-info btn-sm">Ver</a>
                                        <a href="{{ route('duenos.edit', $dueno->idDueno) }}" class="btn btn-primary btn-sm">Editar</a>
                                        <form action="{{ route('duenos.destroy', $dueno->idDueno) }}" method="POST" style="display: inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este dueño?')">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                        {{ $duenos->links('pagination::simple-bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection