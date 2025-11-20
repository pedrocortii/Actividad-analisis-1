@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    
    {{-- Encabezado principal --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark mb-0">
            <i class="fa-solid fa-people-group me-2 text-primary"></i> Grupos de Trabajo
        </h3>
        @can('crear work groups')
        <a href="{{ route('work-groups.create') }}" class="btn btn-primary rounded-pill shadow-sm px-3">
            <i class="fa-solid fa-plus me-1"></i> Agregar Grupo
        </a>
        @endcan
    </div>

    {{-- Formulario de Filtros --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white d-flex align-items-center">
            <h5 class="mb-0 me-auto"><i class="fa-solid fa-filter me-2 text-primary"></i>Filtros de Búsqueda</h5>
            <button class="btn btn-link shadow-none" type="button" data-toggle="collapse" data-target="#filtersCollapse" aria-expanded="true" aria-controls="filtersCollapse">
                <i class="fa-solid fa-chevron-up"></i>
            </button>        </div>
        <div class="collapse show" id="filtersCollapse">
            <div class="card-body">
                <form action="{{ route('work-groups.index') }}" method="GET">
                    <div class="row g-3">
                        <div class="col-md-4 col-lg-3">
                            <label for="name" class="form-label small fw-bold text-muted">Nombre Grupo</label>
                            <input type="text" class="form-control form-control-sm" id="name" name="name" value="{{ request('name') }}" placeholder="Buscar grupo">
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <label for="vehiculo_id" class="form-label small fw-bold text-muted">Vehículo</label>
                            <select class="form-select form-select-sm" id="vehiculo_id" name="vehiculo_id">
                                <option value="">Todos los Vehículos</option>
                                @foreach ($vehiculos as $vehiculo)
                                    <option value="{{ $vehiculo->id }}" {{ request('vehiculo_id') == $vehiculo->id ? 'selected' : '' }}>
                                        {{ $vehiculo->patente }} - {{ $vehiculo->marca->nombre ?? 'N/A' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <label for="employee_id" class="form-label small fw-bold text-muted">Empleado</label>
                            <select class="form-select form-select-sm" id="employee_id" name="employee_id">
                                <option value="">Todos los Empleados</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}" {{ request('employee_id') == $employee->id ? 'selected' : '' }}>
                                        {{ $employee->nombre }} {{ $employee->apellido }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Botones --}}
                    <div class="row mt-4">
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary btn-sm rounded-pill px-4">
                                <i class="fa-solid fa-magnifying-glass me-2"></i> Buscar
                            </button>
                            <a href="{{ route('work-groups.exportpdf', request()->query()) }}" class="btn btn-danger btn-sm rounded-pill px-4" target="_blank">
                                <i class="fa-solid fa-file-pdf me-2"></i> PDF
                            </a>
                            <a href="{{ route('work-groups.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-4">
                                <i class="fa-solid fa-rotate-left me-2"></i> Limpiar
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Tabla --}}
    <div class="card shadow-sm rounded-4">
        <div class="card-body p-0">
            @if (session('success'))
                <div class="alert alert-success m-3" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light border-bottom border-2">
                        <tr>
                            <th>ID</th>
                            <th>Nombre del Grupo</th>
                            <th>Vehículo</th>
                            <th>Empleados Asignados</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($workGroups as $group)
                        <tr>
                            <td>{{ $group->id }}</td>
                            <td class="fw-bold text-dark">{{ $group->name }}</td>
                            <td>
                                @if($group->vehiculo)
                                    <div class="small">
                                        <strong>{{ $group->vehiculo->patente }}</strong><br>
                                        {{ $group->vehiculo->marca->nombre ?? 'N/A' }} {{ $group->vehiculo->modelo }}
                                    </div>
                                @else
                                    <span class="fst-italic text-secondary">Sin vehículo</span>
                                @endif
                            </td>
                            <td>
                                @forelse ($group->employees as $employee)
                                    <span class="badge bg-info text-dark mb-1">{{ $employee->nombre }} {{ $employee->apellido }}</span><br>
                                @empty
                                    <span class="fst-italic text-secondary">Sin empleados</span>
                                @endforelse
                            </td>
                            <td class="text-center">
                                <div class="d-inline-flex gap-1 flex-wrap justify-content-center">
                                    @can('ver work groups')
                                    <a href="{{ route('work-groups.show', $group->id) }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    @endcan
                                    @can('editar work groups')
                                    <a href="{{ route('work-groups.edit', $group->id) }}" class="btn btn-sm btn-primary rounded-pill px-3">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    @endcan
                                    @can('eliminar work groups')
                                    <form action="{{ route('work-groups.destroy', $group->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este grupo de trabajo?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">No se encontraron grupos de trabajo.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3 p-3">
                {{ $workGroups->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection