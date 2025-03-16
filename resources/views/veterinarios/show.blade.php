@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Detalles del Veterinario
                            <a href="{{ route('veterinarios.index') }}" class="btn btn-danger float-end">Volver</a>
                            <a href="{{ route('veterinarios.edit', $veterinario->idVete) }}" class="btn btn-primary float-end me-2">Editar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <strong>ID:</strong> {{ $veterinario->idVete }}
                        </div>
                        <div class="mb-3">
                            <strong>Nombre:</strong> {{ $veterinario->nombreVete }}
                        </div>
                        <div class="mb-3">
                            <strong>Correo Electrónico:</strong> {{ $veterinario->correo }}
                        </div>
                        <div class="mb-3">
                            <strong>Especialidad:</strong> {{ $veterinario->especialidad }}
                        </div>
                        <div class="mb-3">
                            <strong>Teléfono:</strong> {{ $veterinario->telefono }}
                        </div>
                        
                        <div class="mb-3">
                            <h5>Citas asignadas:</h5>
                            @if($veterinario->citas->count() > 0)
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Mascota</th>
                                            <th>Dueño</th>
                                            <th>Tipo de Cita</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($veterinario->citas as $cita)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y H:i') }}</td>
                                                <td>{{ $cita->mascota->nomMascota ?? 'N/A' }}</td>
                                                <td>{{ $cita->dueno->nombre ?? 'N/A' }}</td>
                                                <td>{{ $cita->tipoCita }}</td>
                                                <td>
                                                    <a href="{{ route('citas.show', $cita->idCita) }}" class="btn btn-info btn-sm">Ver</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p>No hay citas asignadas a este veterinario.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection