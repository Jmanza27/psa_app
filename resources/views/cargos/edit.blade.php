@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card text-white bg-dark">
        <div class="card-header">
            <h4 class="text-center">Editar Cargo</h4>
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
            <form action="{{ route('cargos.update', $cargo->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nombres -->
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $cargo->nombre) }}">
                    @error('nombre')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="{{ route('cargos.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection