@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Crear Nueva Cita') }}</div>
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
                        <form method="POST" action="{{ route('citas.store') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="fecha" class="col-md-4 col-form-label text-md-end">{{ __('Fecha') }}</label>
                                <div class="col-md-6">
                                    <input id="fecha" type="date" class="form-control @error('fecha') is-invalid @enderror"
                                        name="fecha" value="{{ old('fecha') ?? date('Y-m-d') }}" required>
                                    @error('fecha')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="hora" class="col-md-4 col-form-label text-md-end">{{ __('Hora') }}</label>
                                <div class="col-md-6">
                                    <select id="hora" class="form-control @error('hora') is-invalid @enderror" name="hora"
                                        required>
                                        <option value="">Seleccione una hora</option>
                                        @foreach ($horasDisponibles as $hora)
                                            <option value="{{ $hora }}" {{ old('hora') == $hora ? 'selected' : '' }}>{{ $hora }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('hora')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="idDueno" class="col-md-4 col-form-label text-md-end">{{ __('Dueño') }}</label>
                                <div class="col-md-6">
                                    <select id="idDueno" class="form-control @error('idDueno') is-invalid @enderror"
                                        name="idDueno" required>
                                        <option value="">Seleccione un dueño</option>
                                        @foreach ($duenos as $dueno)
                                            <option value="{{ $dueno->idDueno }}" {{ old('idDueno') == $dueno->idDueno ? 'selected' : '' }}>{{ $dueno->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @error('idDueno')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="idMascota"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Mascota') }}</label>
                                <div class="col-md-6">
                                    <select id="idMascota" class="form-control @error('idMascota') is-invalid @enderror"
                                        name="idMascota" required>
                                        <option value="1">Seleccione un dueño primero</option>
                                        @foreach ($mascotas as $mascota)
                                            <option value="{{ $mascota->idMascota }}" {{ old('idMascota') == $mascota->idMascota ? 'selected' : '' }}>{{ $mascota->nomMascota }}</option>
                                        @endforeach
                                    </select>
                                    @error('idMascota')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="tipoCita"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Tipo de Cita') }}</label>
                                <div class="col-md-6">
                                    <select id="tipoCita" class="form-control @error('tipoCita') is-invalid @enderror"
                                        name="tipoCita" required>
                                        <option value="">Seleccione el tipo de cita</option>
                                        <option value="Consulta General" {{ old('tipoCita') == 'Consulta General' ? 'selected' : '' }}>Consulta General</option>
                                        <option value="Vacunación" {{ old('tipoCita') == 'Vacunación' ? 'selected' : '' }}>
                                            Vacunación</option>
                                        <option value="Desparasitación" {{ old('tipoCita') == 'Desparasitación' ? 'selected' : '' }}>Desparasitación</option>
                                        <option value="Cirugía" {{ old('tipoCita') == 'Cirugía' ? 'selected' : '' }}>Cirugía
                                        </option>
                                        <option value="Control" {{ old('tipoCita') == 'Control' ? 'selected' : '' }}>Control
                                        </option>
                                        <option value="Emergencia" {{ old('tipoCita') == 'Emergencia' ? 'selected' : '' }}>
                                            Emergencia</option>
                                    </select>
                                    @error('tipoCita')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="idVete" class="col-md-4 col-form-label text-md-end">Veterinario</label>
                                <div class="col-md-6">
                                    <select name="idVete" id="idVete" class="form-control @error('idVete') is-invalid @enderror" required>
                                        <option value="">Seleccionar veterinario</option>
                                        @foreach($veterinarios as $veterinario)
                                            <option value="{{ $veterinario->idVete }}" {{ old('idVete') == $veterinario->idVete ? 'selected' : '' }}>
                                                {{ $veterinario->nombreVete }} - {{ $veterinario->especialidad }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('idVete')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="observaciones"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Observaciones') }}</label>
                                <div class="col-md-6">
                                    <textarea id="observaciones"
                                        class="form-control @error('observaciones') is-invalid @enderror"
                                        name="observaciones" rows="3">{{ old('observaciones') }}</textarea>
                                    @error('observaciones')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Guardar Cita') }}
                                    </button>
                                    <a href="{{ route('citas.index') }}" class="btn btn-secondary">
                                        {{ __('Cancelar') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<!--
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Función para cargar las mascotas basadas en el dueño seleccionado
            function cargarMascotas(idDueno) {
                console.log('Cargando mascotas para dueño ID:', idDueno);
                
                if (!idDueno) {
                    document.getElementById('idMascota').innerHTML = '<option value="">Seleccione un dueño primero</option>';
                    return;
                }
                
                // Realizar petición AJAX para obtener las mascotas
                fetch(`/mascotas-por-dueno/${idDueno}`)
                    .then(response => {
                        console.log('Respuesta del servidor:', response);
                        return response.json();
                    })
                    .then(data => {
                        console.log('Datos recibidos:', data);
                        let mascotaSelect = document.getElementById('idMascota');
                        mascotaSelect.innerHTML = '<option value="">Seleccione una mascota</option>';
                        
                        // Verificar si data es un array y tiene elementos
                        if (Array.isArray(data) && data.length > 0) {
                            data.forEach(mascota => {
                                console.log('Procesando mascota:', mascota);
                                let option = document.createElement('option');
                                option.value = mascota.idMascota;
                                option.textContent = mascota.nombre;
                                
                                // Marcar como seleccionada si coincide con el valor antiguo
                                if (mascota.idMascota == "{{ old('idMascota') }}") {
                                    option.selected = true;
                                }
                                mascotaSelect.appendChild(option);
                            });
                        } else {
                            console.log('No se encontraron mascotas para este dueño');
                            mascotaSelect.innerHTML = '<option value="">No hay mascotas disponibles</option>';
                        }
                    })
                    .catch(error => {
                        console.error('Error al cargar mascotas:', error);
                        document.getElementById('idMascota').innerHTML = '<option value="">Error al cargar mascotas</option>';
                    });
            }
            
            // Configurar evento change en el select de dueños
            document.getElementById('idDueno').addEventListener('change', function () {
                cargarMascotas(this.value);
            });
            
            // Cargar mascotas al inicio si hay un dueño seleccionado
            const idDueno = document.getElementById('idDueno').value;
            console.log('Valor inicial del dueño:', idDueno);
            if (idDueno) {
                cargarMascotas(idDueno);
            }
        });
    </script>
@endsection-->