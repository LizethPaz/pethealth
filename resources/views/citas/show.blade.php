@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Detalles de la Cita') }}</span>
                    <a href="{{ route('citas.index') }}" class="btn btn-secondary btn-sm">Volver</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th width="30%">ID de Cita</th>
                                    <td>{{ $cita->idCita }}</td>
                                </tr>
                                <tr>
                                    <th>Fecha y Hora</th>
                                    <td>{{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Dueño</th>
                                    <td>
                                        {{ $cita->dueno->nombre }}
                                        <a href="{{ route('duenos.show', $cita->idDueno) }}" class="btn btn-info btn-sm ml-2">Ver Dueño</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Mascota</th>
                                    <td>
                                        {{ $cita->mascota->nombre }}
                                        <a href="{{ route('mascotas.show', $cita->idMascota) }}" class="btn btn-info btn-sm ml-2">Ver Mascota</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tipo de Cita</th>
                                    <td>{{ $cita->tipoCita }}</td>
                                </tr>
                                <tr>
                                    <th>Veterinario</th>
                                    <td>{{ $cita->veterinario->nombreVete ?: 'No hay observaciones' }}</td>
                                </tr>
                                <tr>
                                    <th>Observaciones</th>
                                    <td>{{ $cita->observaciones ?: 'No hay observaciones' }}</td>
                                </tr>
                                <tr>
                                    <th>Fecha de Creación</th>
                                    <td>{{ $cita->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Última Actualización</th>
                                    <td>{{ $cita->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        <a href="{{ route('citas.edit', $cita->idCita) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('citas.destroy', $cita->idCita) }}" method="POST" onsubmit="return confirm('¿Está seguro de eliminar esta cita?');" class="ml-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection