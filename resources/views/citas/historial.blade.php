@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Historial de Citas Médicas</h2>

    <!-- Formulario de Filtro -->
    <form method="GET" action="{{ route('citas.historial') }}">
        <div class="mb-3">
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
        <button type="submit" class="btn btn-primary">Filtrar</button>
    </form>

    <!-- Tabla de Citas -->
    <table class="table mt-4">
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
</div>
@endsection
