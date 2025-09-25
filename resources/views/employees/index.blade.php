@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center rounded-top">
            <h4 class="mb-0 fw-semibold">Empleados</h4>
            <a href="{{ route('employees.create') }}" class="btn btn-outline-light btn-sm">
                <i class="fa-solid fa-plus"></i> Agregar empleado
            </a>
        </div>

        <div class="card-body bg-white">
            <div class="row g-3">
                @foreach($employees as $employee)
                    <div class="col-md-4 col-lg-3">
                        <div class="border rounded p-3 h-100 d-flex flex-column justify-content-between bg-light">
                            <div>
                                <h5 class="fw-semibold text-dark">{{ $employee->nombre }} {{ $employee->apellido }}</h5>
                                <p class="mb-1"><strong>DNI:</strong> {{ $employee->dni }}</p>
                                <p class="mb-1"><strong>Email:</strong> {{ $employee->email }}</p>
                                <p class="mb-1"><strong>Tel:</strong> {{ $employee->telefono }}</p>
                                <p class="mb-1"><strong>Rol:</strong> {{ $employee->rol }}</p>
                                <p class="mb-1"><strong>Licencia:</strong> 
                                    <span class="badge {{ $employee->licencia_conducir ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $employee->licencia_conducir ? 'Sí' : 'No' }}
                                    </span>
                                </p>
                                <p class="mb-1"><strong>Estado:</strong> 
                                    <span class="badge 
                                        @if($employee->estado === 'activo') bg-success 
                                        @elseif($employee->estado === 'inactivo') bg-danger 
                                        @else bg-secondary @endif">
                                        {{ ucfirst($employee->estado) }}
                                    </span>
                                </p>
                                <p class="mb-1"><strong>Fecha de contratación:</strong> {{ $employee->fecha_contratacion }}</p>
                                <p class="mb-1"><strong>Dirección:</strong> {{ $employee->direccion }}</p>
                                @foreach($employee->skills as $skill)
                                    <span class="badge bg-info text-dark">{{ $skill->nombre }}</span>
                                @endforeach
                            </div>
                            <div class="mt-3 d-flex gap-2">
                                <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-outline-primary btn-sm flex-fill">
                                    <i class="fa-solid fa-pen-to-square"></i> Editar
                                </a>
                                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="flex-fill">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm w-100" onclick="return confirm('¿Estás seguro de eliminar este empleado?')">
                                        <i class="fa-solid fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .badge {
        font-size: 0.8rem;
        padding: 0.35em 0.55em;
    }
    .card h5 {
        font-size: 1.05rem;
    }
</style>
@endpush
