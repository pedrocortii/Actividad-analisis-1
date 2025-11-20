@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    
    {{-- Encabezado principal --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark mb-0">
            <i class="fa-solid fa-truck me-2 text-primary"></i> Vehículos
        </h3>
        @can('crear vehiculos')
        <a href="{{ route('vehiculos.create') }}" class="btn btn-primary rounded-pill shadow-sm px-3">
            <i class="fa-solid fa-plus me-1"></i> Registrar Vehículo
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
                <form action="{{ route('vehiculos.index') }}" method="GET">
                    <div class="row g-3">
                        <div class="col-md-4 col-lg-3">
                            <label for="marca_vehiculo_id" class="form-label small fw-bold text-muted">Marca</label>
                            <select class="form-select form-select-sm" id="marca_vehiculo_id" name="marca_vehiculo_id">
                                <option value="">Todas las Marcas</option>
                                @foreach ($marcas as $marca)
                                    <option value="{{ $marca->id }}" {{ request('marca_vehiculo_id') == $marca->id ? 'selected' : '' }}>
                                        {{ $marca->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <label for="modelo" class="form-label small fw-bold text-muted">Modelo</label>
                            <input type="text" class="form-control form-control-sm" id="modelo" name="modelo" value="{{ request('modelo') }}" placeholder="Buscar modelo">
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <label for="año" class="form-label small fw-bold text-muted">Año</label>
                            <input type="number" class="form-control form-control-sm" id="año" name="año" value="{{ request('año') }}" placeholder="Año">
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <label for="patente" class="form-label small fw-bold text-muted">Patente</label>
                            <input type="text" class="form-control form-control-sm" id="patente" name="patente" value="{{ request('patente') }}" placeholder="Buscar patente">
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <label for="estado" class="form-label small fw-bold text-muted">Estado</label>
                            <select class="form-select form-select-sm" id="estado" name="estado">
                                <option value="">Todos los Estados</option>
                                <option value="disponible" {{ request('estado') == 'disponible' ? 'selected' : '' }}>Disponible</option>
                                <option value="en_mantenimiento" {{ request('estado') == 'en_mantenimiento' ? 'selected' : '' }}>En Mantenimiento</option>
                            </select>
                        </div>
                    </div>

                    {{-- Botones --}}
                    <div class="row mt-4">
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary btn-sm rounded-pill px-4">
                                <i class="fa-solid fa-magnifying-glass me-2"></i>Buscar
                            </button>
                            <a href="{{ route('vehiculos.exportpdf') }}?desde={{ request('desde') }}&hasta={{ request('hasta') }}&marca_vehiculo_id={{ request('marca_vehiculo_id') }}" 
                               class="btn btn-danger btn-sm rounded-pill px-4" target="_blank">
                                <i class="fa-solid fa-file-pdf me-2"></i> PDF
                            </a>
                            <a href="{{ route('vehiculos.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-4">
                                <i class="fa-solid fa-rotate-left me-2"></i>Limpiar
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Tarjeta principal --}}
    <div class="card shadow-sm rounded-4">
        <div class="card-body p-0">
            @if (session('status'))
                <div class="alert alert-success m-3" role="alert">
                    <i class="fa-solid fa-circle-check me-2"></i>{{ session('status') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light border-bottom border-2">
                        <tr>
                            <th>ID</th>
                            <th>Patente</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Año</th>
                            <th>Estado</th>
                            <th>VTV</th>
                            <th>Foto</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($vehiculos as $vehiculo)
                            <tr>
                                <td class="text-muted">{{ $vehiculo->id }}</td>
                                <td class="fw-bold text-dark">{{ $vehiculo->patente }}</td>
                                <td>{{ $vehiculo->marca->nombre ?? 'Sin marca' }}</td>
                                <td>{{ $vehiculo->modelo }}</td>
                                <td>{{ $vehiculo->año }}</td>
                                <td>
                                    @if ($vehiculo->estado == 'disponible')
                                        <span class="badge bg-success">Disponible</span>
                                    @elseif ($vehiculo->estado == 'en_mantenimiento')
                                        <span class="badge bg-warning text-dark">En Mantenimiento</span>
                                    @elseif ($vehiculo->estado == 'ocupado')
                                        <span class="badge bg-info">Ocupado</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $vehiculo->estado }}</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge {{ $vehiculo->vtv ? 'bg-success' : 'bg-danger' }}">
                                        {{ $vehiculo->vtv ? 'Sí' : 'No' }}
                                    </span>
                                </td>
                                <td>
                                    @if($vehiculo->foto)
                                        <img src="{{ asset('storage/' . $vehiculo->foto) }}" alt="Foto" class="img-thumbnail shadow-sm" style="max-width: 70px; border-radius: 8px;">
                                    @else
                                        <span class="text-muted fst-italic">Sin foto</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-inline-flex gap-1 flex-wrap justify-content-center">
                                        @can('editar vehiculos')
                                        <a href="{{ route('vehiculos.edit', $vehiculo->id) }}" class="btn btn-sm btn-primary rounded-pill px-3" title="Editar">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        @endcan
                                        @can('eliminar vehiculos')
                                        <form action="{{ route('vehiculos.destroy', $vehiculo->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3" title="Eliminar" onclick="return confirm('¿Estás seguro de eliminar este vehículo?')">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">No se encontraron vehículos.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Enlaces de paginación --}}
            <div class="d-flex justify-content-center mt-3 p-3">
                {{ $vehiculos->appends(request()->input())->links() }}
            </div> 
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.table-hover tbody tr:hover {
    background-color: #f8f9fa;
    transition: background-color 0.2s ease;
}

.btn {
    transition: all 0.2s ease;
}

.btn:hover {
    transform: translateY(-1px);
}

.alert-success {
    border-left: 5px solid #198754;
}
</style>
@endpush