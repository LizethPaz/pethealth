@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Editar Dueño
                            <a href="{{ route('duenos.index') }}" class="btn btn-danger float-end">Volver</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('duenos.update', $dueno->idDueno) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="nombre">Nombre Completo</label>
                                <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ $dueno->nombre }}">
                                @error('nombre')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="idMascota">Mascota</label>
                                <select name="idMascota" id="idMascota" class="form-control @error('idMascota') is-invalid @enderror">
                                    <option value="">Seleccione una mascota</option>
                                    @foreach($mascotas as $mascota)
                                        <option value="{{ $mascota->idMascota }}" {{ $dueno->idMascota == $mascota->idMascota ? 'selected' : '' }}>
                                            {{ $mascota->nomMascota }} ({{ $mascota->tipoMascota }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('idMascota')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="celular">Número de Celular</label>
                                <input type="text" name="celular" id="celular" class="form-control @error('celular') is-invalid @enderror" value="{{ $dueno->celular }}">
                                @error('celular')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="direccion">Dirección</label>
                                <input type="text" name="direccion" id="direccion" class="form-control @error('direccion') is-invalid @enderror" value="{{ $dueno->direccion }}">
                                @error('direccion')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="correo">Correo Electrónico</label>
                                <input type="email" name="correo" id="correo" class="form-control @error('correo') is-invalid @enderror" value="{{ $dueno->correo }}">
                                @error('correo')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="ciudad">Ciudad</label>
                                <input type="text" name="ciudad" id="ciudad" class="form-control @error('ciudad') is-invalid @enderror" value="{{ $dueno->ciudad }}">
                                @error('ciudad')
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