@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Lista de Citas') }}</span>
                    <a href="{{ route('citas.create') }}" class="btn btn-primary btn-sm">Nueva Cita</a>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Fecha y Hora</th>
                                    <th>Dueño</th>
                                    <th>Mascota</th>
                                    <th>Tipo de Cita</th>
                                    <th>Veterinario</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($citas as $cita)
                                    <tr>
                                        <td>{{ $cita->idCita }}</td>
                                        <td>{{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y H:i') }}</td>
                                        <td>{{ $cita->dueno->nombre }}</td>
                                        <td>{{ $cita->mascota->nomMascota }}</td>
                                        <td>{{ $cita->tipoCita }}</td>
                                        <td>{{ $cita->veterinario->nombreVete ?? 'N/A'}}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('citas.show', $cita->idCita) }}" class="btn btn-info btn-sm">Ver</a>
                                                <a href="{{ route('citas.edit', $cita->idCita) }}" class="btn btn-warning btn-sm">Editar</a>
                                                <form action="{{ route('citas.destroy', $cita->idCita) }}" method="POST" onsubmit="return confirm('¿Está seguro de eliminar esta cita?');" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No hay citas registradas</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                        {{ $citas->links('pagination::simple-bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection