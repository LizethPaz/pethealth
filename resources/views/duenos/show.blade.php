@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Detalles del Dueño
                            <a href="{{ route('duenos.index') }}" class="btn btn-danger float-end">Volver</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="fw-bold">ID:</label>
                                    <p>{{ $dueno->idDueno }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="fw-bold">Nombre:</label>
                                    <p>{{ $dueno->nombre }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="fw-bold">Celular:</label>
                                    <p>{{ $dueno->celular }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="fw-bold">Correo:</label>
                                    <p>{{ $dueno->correo }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="fw-bold">Dirección:</label>
                                    <p>{{ $dueno->direccion }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="fw-bold">Ciudad:</label>
                                    <p>{{ $dueno->ciudad }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="fw-bold">Mascota:</label>
                                    <p>
                                        @if($dueno->mascota)
                                            {{ $dueno->mascota->nomMascota }} ({{ $dueno->mascota->tipoMascota }})
                                            <a href="{{ route('mascotas.show', $dueno->mascota->idMascota) }}" class="btn btn-sm btn-info">Ver Mascota</a>
                                        @else
                                            Sin mascota asignada
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="fw-bold">Fecha de Registro:</label>
                            <p>{{ $dueno->created_at->format('d/m/Y H:i:s') }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="fw-bold">Última Actualización:</label>
                            <p>{{ $dueno->updated_at->format('d/m/Y H:i:s') }}</p>
                        </div>
                        
                        <div class="mt-4">
                            <a href="{{ route('duenos.edit', $dueno->idDueno) }}" class="btn btn-primary">Editar</a>
                            <form action="{{ route('duenos.destroy', $dueno->idDueno) }}" method="POST" style="display: inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este dueño?')">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection