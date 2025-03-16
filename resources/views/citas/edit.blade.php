@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Editar Cita') }}</div>

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

                        <form method="POST" action="{{ route('citas.update', $cita->idCita) }}">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <label for="fecha" class="col-md-4 col-form-label text-md-end">{{ __('Fecha') }}</label>
                                <div class="col-md-6">
                                    <input id="fecha" type="date" class="form-control @error('fecha') is-invalid @enderror"
                                        name="fecha"
                                        value="{{ old('fecha') ?? \Carbon\Carbon::parse($cita->fecha)->format('Y-m-d') }}"
                                        required>
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
                                        @foreach ($horasDisponibles as $horaDisponible)
                                            <option value="{{ $horaDisponible }}" {{ (old('hora') ?? $hora) == $horaDisponible ? 'selected' : '' }}>{{ $horaDisponible }}</option>
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
                                            <option value="{{ $dueno->idDueno }}" {{ (old('idDueno') ?? $cita->idDueno) == $dueno->idDueno ? 'selected' : '' }}>{{ $dueno->nombre }}
                                            </option>
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
                                        <option value="1">Cargando mascotas...</option>
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
                                        <option value="Consulta General" {{ (old('tipoCita') ?? $cita->tipoCita) == 'Consulta General' ? 'selected' : '' }}>Consulta General</option>
                                        <option value="Vacunación" {{ (old('tipoCita') ?? $cita->tipoCita) == 'Vacunación' ? 'selected' : '' }}>Vacunación</option>
                                        <option value="Desparasitación" {{ (old('tipoCita') ?? $cita->tipoCita) == 'Desparasitación' ? 'selected' : '' }}>Desparasitación
                                        </option>
                                        <option value="Cirugía" {{ (old('tipoCita') ?? $cita->tipoCita) == 'Cirugía' ? 'selected' : '' }}>Cirugía</option>
                                        <option value="Control" {{ (old('tipoCita') ?? $cita->tipoCita) == 'Control' ? 'selected' : '' }}>Control</option>
                                        <option value="Emergencia" {{ (old('tipoCita') ?? $cita->tipoCita) == 'Emergencia' ? 'selected' : '' }}>Emergencia</option>
                                    </select>
                                    @error('tipoCita')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="idVete">Veterinario</label>
                                <select name="idVete" id="idVete" class="form-control" required>
                                    <option value="">Seleccionar veterinario</option>
                                    @foreach($veterinarios as $veterinario)
                                        <option value="{{ $veterinario->idVete }}" {{ $cita->idVete == $veterinario->idVete ? 'selected' : '' }}>
                                            {{ $veterinario->nombreVete }} - {{ $veterinario->especialidad }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row mb-3">
                                <label for="observaciones"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Observaciones') }}</label>
                                <div class="col-md-6">
                                    <textarea id="observaciones"
                                        class="form-control @error('observaciones') is-invalid @enderror"
                                        name="observaciones"
                                        rows="3">{{ old('observaciones') ?? $cita->observaciones }}</textarea>
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
                                        {{ __('Actualizar Cita') }}
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

    @section('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Función para cargar las mascotas basadas en el dueño seleccionado
                function cargarMascotas(idDueno, mascotaSeleccionada = null) {
                    if (!idDueno) {
                        document.getElementById('idMascota').innerHTML = '<option value="">Seleccione un dueño primero</option>';
                        return;
                    }

                    // Realizar petición AJAX para obtener las mascotas
                    fetch(`/mascotas-por-dueno/${idDueno}`)
                        .then(response => response.json())
                        .then(data => {
                            let mascotaSelect = document.getElementById('idMascota');
                            mascotaSelect.innerHTML = '<option value="">Seleccione una mascota</option>';

                            data.forEach(mascota => {
                                let option = document.createElement('option');
                                option.value = mascota.idMascota;
                                option.textContent = mascota.nombre;

                                // Si hay una mascota seleccionada, marcarla como seleccionada
                                if (mascotaSeleccionada && mascota.idMascota == mascotaSeleccionada) {
                                    option.selected = true;
                                }

                                mascotaSelect.appendChild(option);
                            });
                        })
                        .catch(error => console.error('Error:', error));
                }

                // Configurar evento change en el select de dueños
                document.getElementById('idDueno').addEventListener('change', function () {
                    cargarMascotas(this.value);
                });

                // Cargar mascotas al inicio si hay un dueño seleccionado
                const idDueno = document.getElementById('idDueno').value;
                if (idDueno) {
                    // Usar el valor antiguo de la mascota si existe, si no, usar el valor de la cita
                    const mascotaSeleccionada = "{{ old('idMascota') ? old('idMascota') : $cita->idMascota }}";
                    cargarMascotas(idDueno, mascotaSeleccionada);
                }
            });
        </script>
    @endsection
@endsection