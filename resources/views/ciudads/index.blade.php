@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card text-white bg-dark">
        <div class="card-header">
            <h4 class="text-center">Ciudades</h4>
        </div>
        <div class="card-body">
            <table class="table mt-3 text-white">
                <thead>
                    <tr>
                        <th>Ciudad</th>
                        <th>Pais</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ciudads as $ciudad)
                    <tr>
                        <td>{{ $ciudad->nombre }}</td>
                        <td>{{ $ciudad->pais->nombre }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection