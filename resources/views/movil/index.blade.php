@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Móviles</h2>
        <a href="{{ route('movil.create') }}" class="btn btn-success">
            <i class="fa-solid fa-plus"></i> Agregar Móvil
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row g-3">
        @foreach($moviles as $movil)
            <div class="col-md-4 col-lg-3">
                <div class="p-3 border rounded h-100 d-flex flex-column justify-content-between">
                    <div>
                        <h5>{{ $movil->nombre }}</h5>
                        <p class="mb-1"><strong>Código:</strong> {{ $movil->codigo }}</p>
                        <p class="mb-1"><strong>Zona asignada:</strong> {{ $movil->zona_asignada }}</p>
                        <p class="mb-1"><strong>Estado:</strong> {{ $movil->estado }}</p>
                        <p><strong>Vehículos Asignados:</strong></p>
                        <ul>
                            @forelse($movil->vehiculos as $vehiculo)
                                <li>{{ $vehiculo->marca }} {{ $vehiculo->modelo }} ({{ $vehiculo->año }})</li>
                            @empty
                                <li>No hay vehículos asignados.</li>
                            @endforelse
                        </ul>
                    </div>

                    <div class="mt-3">
                        <form action="{{ route('movil.asignarVehiculo') }}" method="POST">
                            @csrf
                            <input type="hidden" name="movil_id" value="{{ $movil->id }}">
                            <div class="input-group mb-2">
                                <select class="form-control form-control-sm" name="vehiculo_id" required>
                                    <option value="">Selecciona un vehículo</option>
                                    @foreach($vehiculos as $vehiculo)
                                        <option value="{{ $vehiculo->id }}">{{ $vehiculo->marca }} {{ $vehiculo->modelo }} ({{ $vehiculo->año }})</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-primary btn-sm" type="submit">Asignar</button>
                            </div>
                        </form>
                    </div>
                    <div class="mt-2 d-flex gap-2">
                        <a href="{{ route('movil.edit', $movil->id) }}" class="btn btn-warning btn-sm flex-fill">
                            <i class="fa-solid fa-pen-to-square"></i> Editar
                        </a>
                        <form action="{{ route('movil.destroy', $movil->id) }}" method="POST" class="flex-fill">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm w-100" onclick="return confirm('¿Estás seguro de eliminar este móvil?')">
                                <i class="fa-solid fa-trash"></i> Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection