@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center mb-4">
        <div class="col-lg-8 text-center">
            <h2 class="fw-bold text-dark mb-1">Grupos de Trabajo</h2>
            <p class="text-muted">Listado de grupos y sus integrantes</p>
        </div>
    </div>

    <div class="row g-3">
        @foreach($workGroups as $group)
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm rounded-3 hover-card">
                    <div class="card-body d-flex flex-column">
                        <!-- Header: nombre del grupo -->
                        <h5 class="fw-bold text-dark">{{ $group->name }}</h5>

                        <!-- Vehículo -->
                        <p class="text-muted mb-2">
                            Vehículo: 
                            @if($group->vehiculo)
                                <span class="fw-semibold text-dark">{{ $group->vehiculo->patente }}</span>
                                <br>
                                <small>{{ $group->vehiculo->marca }} {{ $group->vehiculo->modelo }}</small>
                            @else
                                <span class="fst-italic text-secondary">Sin vehículo</span>
                            @endif
                        </p>

                        <!-- Empleados -->
                        <p class="text-muted mb-2">Empleados: {{ $group->employees->count() }}</p>
                        <ul class="ps-3 mb-2">
    @foreach ($group->employees as $employee)
        <li class="mb-2 pb-1 border-bottom border-dashed">
            <span class="fw-semibold">DNI:</span> {{ $employee->dni }}<br>
            <span>{{ $employee->nombre }} {{ $employee->apellido }}</span><br>
            <span class="fw-semibold">Estado:</span>
            <span class="badge 
                @if($employee->estado === 'activo') bg-success 
                @elseif($employee->estado === 'inactivo') bg-danger 
                @else bg-secondary 
                @endif
                text-white ms-1">{{ $employee->estado }}</span>
        </li>
    @endforeach
</ul>

                        <!-- Botones -->
                        <div class="mt-auto d-flex justify-content-between gap-1">
                            <a href="{{ route('work-groups.show', $group->id) }}" class="btn btn-outline-secondary btn-sm flex-fill">
                                <i class="fa-solid fa-eye"></i> Ver
                            </a>
                            <a href="{{ route('work-groups.edit', $group->id) }}" class="btn btn-outline-primary btn-sm flex-fill">
                                <i class="fa-solid fa-pen-to-square"></i> Editar
                            </a>
                            <form action="{{ route('work-groups.destroy', $group->id) }}" method="POST" class="flex-fill">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm w-100" onclick="return confirm('¿Eliminar este grupo de trabajo?')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Paginación -->
    <div class="d-flex justify-content-center mt-4">
        {{ $workGroups->links() }}
    </div>
</div>
@endsection

@push('styles')
<style>
    body {
        background: #f4f6f9; /* gris claro AdminLTE */
    }
    .hover-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border-radius: 12px;
    }
    .hover-card:hover {
        transform: scale(1.03);
        box-shadow: 0 8px 20px rgba(0,0,0,0.12);
    }
    .badge {
        font-size: 0.8em;
        padding: 0.3em 0.55em;
    }
</style>
@endpush
