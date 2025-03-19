@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">Historial de Citas Médicas</h2>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Lista de Citas') }}</span>
                </div>

                <div class="card-body">
                    <!-- Formulario de Filtro -->
                    <form method="GET" action="{{ route('citas.historial') }}" class="mb-4">
                        <div class="row align-items-end">
                            <div class="col-md-10">
                                <label for="idMascota" class="form-label">Filtrar por Mascota:</label>
                                <select name="idMascota" id="idMascota" class="form-control">
                                    <option value="">Todas</option>
                                    @foreach ($mascotas as $mascota)
                                        <option value="{{ $mascota->idMascota }}" 
                                            {{ request('idMascota') == $mascota->idMascota ? 'selected' : '' }}>
                                            {{ $mascota->nomMascota }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                            </div>
                        </div>
                    </form>

                    <!-- Tabla de Citas -->
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Mascota</th>
                                    <th>Dueño</th>
                                    <th>Veterinario</th>
                                    <th>Tipo de Cita</th>
                                    <th>Observaciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($citas as $cita)
                                    <tr>
                                        <td>{{ $cita->fecha }}</td>
                                        <td>{{ $cita->mascota->nomMascota }}</td>
                                        <td>{{ $cita->dueno->nombre }}</td>
                                        <td>{{ $cita->veterinario->nombreVete }}</td>
                                        <td>{{ $cita->tipoCita }}</td>
                                        <td>{{ $cita->observaciones ?? 'N/A' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> <!-- Fin de table-responsive -->
                </div> <!-- Fin de card-body -->
            </div> <!-- Fin de card -->
        </div> <!-- Fin de col-md-10 -->
    </div> <!-- Fin de row -->
</div> <!-- Fin de container -->
@endsection
