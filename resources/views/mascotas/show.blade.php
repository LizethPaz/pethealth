@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Detalles de Mascota
                            <a href="{{ route('mascotas.index') }}" class="btn btn-danger float-end">Volver</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="fw-bold">ID:</label>
                            <p>{{ $mascota->idMascota }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="fw-bold">Nombre:</label>
                            <p>{{ $mascota->nomMascota }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="fw-bold">Edad:</label>
                            <p>{{ $mascota->edadMascota }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="fw-bold">Color:</label>
                            <p>{{ $mascota->colorMascota }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="fw-bold">Tipo:</label>
                            <p>{{ $mascota->tipoMascota }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="fw-bold">Fecha de Creación:</label>
                            <p>{{ $mascota->created_at->format('d/m/Y H:i:s') }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="fw-bold">Última Actualización:</label>
                            <p>{{ $mascota->updated_at->format('d/m/Y H:i:s') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection