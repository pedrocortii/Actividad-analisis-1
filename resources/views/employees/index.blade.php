@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    
    {{-- Encabezado principal --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark mb-0">
            <i class="fa-solid fa-user-tie me-2 text-primary"></i> Empleados
        </h3>
        @can('crear employees')
        <a href="{{ route('employees.create') }}" class="btn btn-primary rounded-pill shadow-sm px-3">
            <i class="fa-solid fa-plus me-1"></i> Nuevo Empleado
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
                <form action="{{ route('employees.index') }}" method="GET">
                    <div class="row g-3">
                        <div class="col-md-4 col-lg-3">
                            <label for="nombre" class="form-label small fw-bold text-muted">Nombre</label>
                            <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" value="{{ request('nombre') }}" placeholder="Buscar nombre">
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <label for="apellido" class="form-label small fw-bold text-muted">Apellido</label>
                            <input type="text" class="form-control form-control-sm" id="apellido" name="apellido" value="{{ request('apellido') }}" placeholder="Buscar apellido">
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <label for="dni" class="form-label small fw-bold text-muted">DNI</label>
                            <input type="text" class="form-control form-control-sm" id="dni" name="dni" value="{{ request('dni') }}" placeholder="Buscar DNI">
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <label for="estado" class="form-label small fw-bold text-muted">Estado</label>
                            <select class="form-select form-select-sm" id="estado" name="estado">
                                <option value="">Todos los Estados</option>
                                <option value="activo" {{ request('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
                                <option value="inactivo" {{ request('estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <label for="skill_id" class="form-label small fw-bold text-muted">Habilidad</label>
                            <select class="form-select form-select-sm" id="skill_id" name="skill_id">
                                <option value="">Todas las Habilidades</option>
                                @foreach($skills as $skill)
                                    <option value="{{ $skill->id }}" {{ request('skill_id') == $skill->id ? 'selected' : '' }}>
                                        {{ $skill->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Botones --}}
                    <div class="row mt-4">
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary btn-sm rounded-pill px-4">
                                <i class="fa-solid fa-magnifying-glass me-2"></i>Buscar
                            </button>
                            <a href="{{ route('employees.exportpdf', request()->query()) }}" class="btn btn-danger btn-sm rounded-pill px-4" target="_blank">
                                <i class="fa-solid fa-file-pdf me-2"></i> PDF
                            </a>
                            <a href="{{ route('employees.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-4">
                                <i class="fa-solid fa-rotate-left me-2"></i>Limpiar
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
                            <th>DNI</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Estado</th>
                            <th>Habilidades</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($employees as $employee)
                        <tr>
                            <td class="text-muted">{{ $employee->id }}</td>
                            <td class="fw-bold text-dark">{{ $employee->dni }}</td>
                            <td>{{ $employee->nombre }} {{ $employee->apellido }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->telefono ?? 'N/A' }}</td>
                            <td>
                                @if($employee->estado == 'activo')
                                    <span class="badge bg-success">Activo</span>
                                @elseif($employee->estado == 'inactivo')
                                    <span class="badge bg-secondary">Inactivo</span>
                                @else
                                    <span class="badge bg-secondary">{{ $employee->estado }}</span>
                                @endif
                            </td>
                            <td>
                                @forelse($employee->skills as $skill)
                                    <span class="badge bg-primary mb-1">{{ $skill->nombre }}</span>
                                @empty
                                    <span class="text-muted fst-italic">Sin habilidades</span>
                                @endforelse
                            </td>
                            <td class="text-center">
                                <div class="d-inline-flex gap-1 flex-wrap justify-content-center">
                                    @can('editar employees')
                                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-sm btn-primary rounded-pill px-3" title="Editar">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    @endcan
                                    @can('eliminar employees')
                                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este empleado?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3" title="Eliminar">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">No se encontraron empleados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3 p-3">
                {{ $employees->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection