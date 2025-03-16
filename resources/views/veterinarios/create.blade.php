@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Agregar Veterinario
                            <a href="{{ route('veterinarios.index') }}" class="btn btn-danger float-end">Volver</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('veterinarios.store') }}" method="POST">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="nombreVete">Nombre</label>
                                <input type="text" name="nombreVete" value="{{ old('nombreVete') }}" class="form-control" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="correo">Correo Electrónico</label>
                                <input type="email" name="correo" value="{{ old('correo') }}" class="form-control" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="especialidad">Especialidad</label>
                                <input type="text" name="especialidad" value="{{ old('especialidad') }}" class="form-control" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="telefono">Teléfono</label>
                                <input type="text" name="telefono" value="{{ old('telefono') }}" class="form-control" required>
                            </div>
                            
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection