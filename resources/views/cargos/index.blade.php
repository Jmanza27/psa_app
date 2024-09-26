@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card text-white bg-dark">
        <div class="card-header">
            <h4 class="text-center">Cargos</h4>
        </div>
        <div class="card-body">
            <a href="{{ route('cargos.create') }}" class="btn btn-primary">Crear Cargo</a>
            <table class="table mt-3 text-white">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cargos as $cargo)
                    <tr>
                        <td>{{ $cargo->nombre }}</td>
                        <td>
                            <a href="{{ route('cargos.edit', $cargo) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('cargos.destroy', $cargo) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">Borrar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection