@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Editar Mascota
                            <a href="{{ route('mascotas.index') }}" class="btn btn-danger float-end">Volver</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('mascotas.update', $mascota->idMascota) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="nomMascota">Nombre</label>
                                <input type="text" name="nomMascota" id="nomMascota" class="form-control @error('nomMascota') is-invalid @enderror" value="{{ $mascota->nomMascota }}">
                                @error('nomMascota')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="edadMascota">Edad</label>
                                <input type="number" name="edadMascota" id="edadMascota" class="form-control @error('edadMascota') is-invalid @enderror" value="{{ $mascota->edadMascota }}">
                                @error('edadMascota')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="colorMascota">Color</label>
                                <input type="text" name="colorMascota" id="colorMascota" class="form-control @error('colorMascota') is-invalid @enderror" value="{{ $mascota->colorMascota }}">
                                @error('colorMascota')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tipoMascota">Tipo</label>
                                <input type="text" name="tipoMascota" id="tipoMascota" class="form-control @error('tipoMascota') is-invalid @enderror" value="{{ $mascota->tipoMascota }}">
                                @error('tipoMascota')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection