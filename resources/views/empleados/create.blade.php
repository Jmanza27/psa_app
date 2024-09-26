@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="card text-white bg-dark">
        <div class="card-header">
            <h4 class="text-center">Crear Empleado</h4>
        </div>
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <strong>¡Ups!</strong> Hay algunos problemas con la entrada.<br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{ route('empleados.store') }}" method="POST">
                @csrf

                <!-- Nombres -->
                <div class="form-group">
                    <label for="nombres">Nombres</label>
                    <input type="text" name="nombres" class="form-control" value="{{ old('nombres') }}">
                    @error('nombres')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Apellidos -->
                <div class="form-group">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" name="apellidos" class="form-control" value="{{ old('apellidos') }}">
                    @error('apellidos')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Identificación -->
                <div class="form-group">
                    <label for="identificacion">Identificación</label>
                    <input type="text" name="identificacion" class="form-control" value="{{ old('identificacion') }}">
                    @error('identificacion')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Dirección -->
                <div class="form-group">
                    <label for="direccion">Dirección</label>
                    <input type="text" name="direccion" class="form-control" value="{{ old('direccion') }}">
                    @error('direccion')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Teléfono -->
                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" name="telefono" class="form-control" value="{{ old('telefono') }}">
                    @error('telefono')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="pais_nacimiento">País de Nacimiento</label>
                    <select name="pais_nacimiento" id="pais_nacimiento" class="form-control">
                        <option value="">Seleccione una Pais</option>
                        @foreach ($paises as $pais)
                        <option value="{{ $pais->id }}">{{ $pais->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="ciudad_id">Ciudad de Nacimiento</label>
                    <select name="ciudad_id" id="ciudad_id" class="form-control">
                        <option value="">Seleccione una ciudad</option>
                        <!-- Las ciudades se cargarán aquí mediante JavaScript -->
                    </select>
                </div>


                <!-- Cargos -->
                <div class="form-group">
                    <label for="cargos">Cargos</label>
                    <select name="cargos[]" class="form-control" class="form-select" multiple>
                        @foreach($cargos as $cargo)
                        <option value="{{ $cargo->id }}" {{ in_array($cargo->id, old('cargos', [])) ? 'selected' : '' }}>
                            {{ $cargo->nombre }}
                        </option>
                        @endforeach
                    </select>
                    @error('cargos')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Jefe -->
                <div class="form-group">
                    <label for="jefe_id">Jefe (opcional)</label>
                    <select name="jefe_id" class="form-control">
                        <option value="">Sin Jefe Asignado</option>
                        @foreach($empleados as $empleado)
                        <option value="{{ $empleado->id }}" {{ old('jefe_id') == $empleado->id ? 'selected' : '' }}>
                            {{ $empleado->nombres }} {{ $empleado->apellidos }}
                        </option>
                        @endforeach
                    </select>
                    @error('jefe_id')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="{{ route('empleados.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>

<!-- Script para manejar la carga dinámica de las ciudades según el país seleccionado -->
<script>
    document.getElementById('pais_nacimiento').addEventListener('change', function() {
        const paisId = this.value;

        fetch(`/empleados/ciudades/${paisId}`)
            .then(response => response.json())
            .then(data => {
                const ciudadSelect = document.getElementById('ciudad_id');
                ciudadSelect.innerHTML = '<option value="">Seleccione una ciudad</option>';
                data.forEach(ciudad => {
                    ciudadSelect.innerHTML += `<option value="${ciudad.id}">${ciudad.nombre}</option>`;
                });
            });
    });
</script>
@endsection