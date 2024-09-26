@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card text-white bg-dark">
        <div class="card-header">
            <h4 class="text-center">Empleados</h4>
        </div>
        <div class="card-body">
            <a href="{{ route('empleados.create') }}" class="btn btn-primary">Crear Empleado</a>
            <table class="table mt-3 text-white">
                <thead>
                    <tr>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Telefono</th>
                        <th>Direccion</th>
                        <th>Pais</th>
                        <th>Ciudad</th>
                        <th>Cargos</th>
                        <th>Jefe</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($empleados as $empleado)
                    <tr>
                        <td>{{ $empleado->nombres }}</td>
                        <td>{{ $empleado->apellidos }}</td>
                        <td>{{ $empleado->direccion }}</td>
                        <td>{{ $empleado->telefono }}</td>
                        <td>{{ $empleado->ciudad->pais->nombre }}</td>
                        <td>{{ $empleado->ciudad->nombre }}</td>
                        <td>{{ implode(', ', $empleado->cargos->pluck('nombre')->toArray()) }}</td>
                        <td>{{ optional($empleado->jefe)->nombres ? optional($empleado->jefe)->nombres . ' ' . optional($empleado->jefe)->apellidos : 'Sin Jefe Asignado' }}</td>
                        <td>
                            <a href="{{ route('empleados.edit', $empleado) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('empleados.destroy', $empleado) }}" method="POST" style="display:inline;">
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