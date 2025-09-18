@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Dashboard') }}</span>
                    <a href="{{ route('marcaVehiculos.create') }}" class="btn btn-primary btn-sm">Añadir marca</a>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status')}}
                        </div>
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($marcaVehiculos as $marcaVehiculo)
                                <tr>
                                    <td>{{ $marcaVehiculo->id }}</td>
                                    <td>{{ $marcaVehiculo->nombre }}</td>
                                    <td>
                                        <a href="{{ route('marcaVehiculo.edit', $marcaVehiculo->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                        <form action="{{ route('marcaVehiculo.destroy', $marcaVehiculo->id) }}" method="POST" style='display:inline-block;'>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estas seguro de eliminar esta marca de vehiculo?')">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection