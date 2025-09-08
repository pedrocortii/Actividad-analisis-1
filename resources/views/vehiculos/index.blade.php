@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>{{ __('Vehículos') }}</span>
                        <a href="{{ route('vehiculos.create') }}" class="btn btn-success btn-sm">
                            <i class="fa-solid fa-plus"></i> Agregar vehículo
                        </a>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Patente</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Año</th>
                                    <th>Foto</th>
                                    <th>VTV</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vehiculos as $vehiculo)
                                    <tr>
                                        <td>{{ $vehiculo->id }}</td>
                                        <td>{{ $vehiculo->patente }}</td>
                                        <td>{{ $vehiculo->marca }}</td>
                                        <td>{{ $vehiculo->modelo }}</td>
                                        <td>{{ $vehiculo->año }}</td>
                                        <td>{{ $vehiculo->foto }}</td>
                                        <td>{{ $vehiculo->vtv }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('vehiculos.edit', $vehiculo->id) }}" class="btn btn-warning btn-sm px-3 py-1">
                                                    <i class="fa-solid fa-pen-to-square"></i> Editar
                                                </a>
                                                <form action="{{ route('vehiculos.destroy', $vehiculo->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm px-3 py-1" onclick="return confirm('¿Estás seguro de eliminar este vehículo?')">
                                                        <i class="fa-solid fa-trash"></i> Eliminar 
                                                    </button>
                                                </form>
                                            </div>
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
