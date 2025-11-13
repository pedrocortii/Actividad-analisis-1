@extends('layouts.admin')
    
@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
        
                {{-- Encabezado principal --}}
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="fw-bold text-dark mb-0">
                        <i class="fa-solid fa-people-group me-2 text-primary"></i> Detalles del Grupo: {{ $workGroup->name }}
                    </h3>
                    <a href="{{ route('work-groups.index') }}" class="btn btn-secondary rounded-pill shadow-sm px-3">
                        <i class="fa-solid fa-arrow-left me-1"></i> Volver a Grupos
                    </a>
                </div>
    
                {{-- Tarjeta de detalles del Grupo --}}
                <div class="card shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-primary text-white rounded-top-4">
                        <h5 class="mb-0"><i class="fa-solid fa-circle-info me-2"></i> Información del Grupo</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <strong>Nombre del Grupo:</strong>
                                <p class="mb-0">{{ $workGroup->name }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong>Vehículo Asignado:</strong>
                                @if ($workGroup->vehiculo)
                                    <p class="mb-0">
                                        {{ $workGroup->vehiculo->patente }} ({{ $workGroup->vehiculo->marca->nombre ?? 'N/A' }} - {{
        $workGroup->vehiculo->modelo }})
                                        @if($workGroup->vehiculo->foto)
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/' . $workGroup->vehiculo->foto) }}" alt="Foto del Vehículo" class="img
        thumbnail shadow-sm" style="max-width: 150px; border-radius: 8px;">
                                            </div>
                                        @endif
                                    </p>
                                @else
                                    <p class="mb-0 text-muted">Sin vehículo asignado</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
    
                {{-- Tarjeta de Empleados del Grupo --}}
                <div class="card shadow-sm rounded-4">
                    <div class="card-header bg-primary text-white rounded-top-4">
                        <h5 class="mb-0"><i class="fa-solid fa-users me-2"></i> Empleados del Grupo</h5>
                    </div>
                    <div class="card-body p-4">
                        @if ($workGroup->employees->count() > 0)
                            <ul class="list-group list-group-flush">
                                @foreach ($workGroup->employees as $employee)
                                    <li class="list-group-item">
                                        {{ $employee->nombre }} {{ $employee->apellido }}
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted text-center mb-0">No hay empleados asignados a este grupo.</p>
                        @endif
                    </div>
                </div>
    
            </div>
        </div>
    </div>
@endsection