@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    
    {{-- Encabezado principal --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark mb-0">
            <i class="fa-solid fa-users me-2 text-primary"></i> Usuarios
        </h3>
        @can('crear usuarios')
        <a href="{{ route('users.create') }}" class="btn btn-primary rounded-pill shadow-sm px-3">
            <i class="fa-solid fa-plus me-1"></i> Nuevo Usuario
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
                <form action="{{ route('users.index') }}" method="GET">
                    <div class="row g-3">
                        <div class="col-md-4 col-lg-3">
                            <label for="name" class="form-label small fw-bold text-muted">Nombre</label>
                            <input type="text" class="form-control form-control-sm" id="name" name="name" value="{{ request('name') }}" placeholder="Buscar nombre">
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <label for="email" class="form-label small fw-bold text-muted">Correo</label>
                            <input type="email" class="form-control form-control-sm" id="email" name="email" value="{{ request('email') }}" placeholder="Buscar email">
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <label for="role" class="form-label small fw-bold text-muted">Rol</label>
                            <select class="form-select form-select-sm" id="role" name="role">
                                <option value="">Todos los Roles</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}" {{ request('role') == $role->name ? 'selected' : '' }}>
                                        {{ $role->name }}
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
                            <a href="{{ route('users.exportpdf', request()->query()) }}" class="btn btn-danger btn-sm rounded-pill px-4" target="_blank">
                                <i class="fa-solid fa-file-pdf me-2"></i> PDF
                            </a>
                            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-4">
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
                            <th>Nombre</th>
                            <th>Correo Electrónico</th>
                            <th>Roles</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td class="text-muted">{{ $user->id }}</td>
                            <td class="fw-bold text-dark">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @foreach($user->roles as $role)
                                    <span class="badge bg-info text-dark">{{ $role->name }}</span>
                                @endforeach
                            </td>
                            <td class="text-center">
                                <div class="d-inline-flex gap-1 flex-wrap justify-content-center">
                                    @can('editar usuarios')
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary rounded-pill px-3">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                    @endcan
                                    @can('eliminar usuarios')
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
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
                                <td colspan="5" class="text-center text-muted py-4">No se encontraron usuarios.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3 p-3">
                {{ $users->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection