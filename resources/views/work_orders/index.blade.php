@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">

    <!-- Encabezado -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">
            <i class="fas fa-clipboard-list me-2"></i> Órdenes de trabajo
        </h3>
        @can('crear work orders')
            <a href="{{ route('work-orders.create') }}" class="btn btn-primary rounded-pill shadow-sm">
                <i class="fas fa-plus me-1"></i> Nueva orden
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
                <form action="{{ route('work-orders.index') }}" method="GET">
                    <div class="row g-3">
                        <!-- Primera fila -->
                        <div class="col-md-4 col-lg-3">
                            <label for="codigo" class="form-label small fw-bold text-muted">Código</label>
                            <input type="text" class="form-control form-control-sm" id="codigo" name="codigo" value="{{ request('codigo') }}" placeholder="Buscar código">
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <label for="descripcion" class="form-label small fw-bold text-muted">Descripción</label>
                            <input type="text" class="form-control form-control-sm" id="descripcion" name="descripcion" value="{{ request('descripcion') }}" placeholder="Buscar descripción">
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <label for="fecha_solicitud_desde" class="form-label small fw-bold text-muted">Fecha Desde</label>
                            <input type="date" class="form-control form-control-sm" id="fecha_solicitud_desde" name="fecha_solicitud_desde" value="{{ request('fecha_solicitud_desde') }}">
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <label for="fecha_solicitud_hasta" class="form-label small fw-bold text-muted">Fecha Hasta</label>
                            <input type="date" class="form-control form-control-sm" id="fecha_solicitud_hasta" name="fecha_solicitud_hasta" value="{{ request('fecha_solicitud_hasta') }}">
                        </div>

                        <!-- Segunda fila -->
                        <div class="col-md-4 col-lg-3">
                            <label for="work_group_id" class="form-label small fw-bold text-muted">Grupo Trabajo</label>
                            <select class="form-select form-select-sm" id="work_group_id" name="work_group_id">
                                <option value="">Todos los Grupos</option>
                                @foreach ($workGroups as $group)
                                    <option value="{{ $group->id }}" {{ request('work_group_id') == $group->id ? 'selected' : '' }}>
                                        {{ $group->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <label for="user_id" class="form-label small fw-bold text-muted">Usuario</label>
                            <select class="form-select form-select-sm" id="user_id" name="user_id">
                                <option value="">Todos los Usuarios</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <label for="estado" class="form-label small fw-bold text-muted">Estado</label>
                            <select class="form-select form-select-sm" id="estado" name="estado">
                                <option value="">Todos los Estados</option>
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->name }}" {{ request('estado') == $status->name ? 'selected' : '' }}>
                                        {{ $status->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <label for="prioridad" class="form-label small fw-bold text-muted">Prioridad</label>
                            <select class="form-select form-select-sm" id="prioridad" name="prioridad">
                                <option value="">Todas las Prioridades</option>
                                <option value="Baja" {{ request('prioridad') == 'Baja' ? 'selected' : '' }}>Baja</option>
                                <option value="Media" {{ request('prioridad') == 'Media' ? 'selected' : '' }}>Media</option>
                                <option value="Alta" {{ request('prioridad') == 'Alta' ? 'selected' : '' }}>Alta</option>
                                <option value="Urgente" {{ request('prioridad') == 'Urgente' ? 'selected' : '' }}>Urgente</option>
                            </select>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="row mt-4">
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary btn-sm rounded-pill px-4">
                                <i class="fa-solid fa-magnifying-glass me-2"></i>Buscar
                            </button>
                            <a href="{{ route('work-orders.exportpdf', request()->query()) }}" class="btn btn-danger btn-sm rounded-pill px-4" target="_blank">
                                <i class="fa-solid fa-file-pdf me-2"></i> PDF
                            </a>
                            <a href="{{ route('work-orders.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-4">
                                <i class="fa-solid fa-rotate-left me-2"></i>Limpiar
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Tabla -->
    <div class="card shadow-sm rounded-4">
        <div class="card-body p-0">
            @if (session('status'))
                <div class="alert alert-success m-3" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="workOrdersTable">
                    <thead class="table-light border-bottom border-2">
                        <tr>
                            <th>ID</th>
                            <th>Código</th>
                            <th>Descripción</th>
                            <th>Fecha solicitud</th>
                            <th>Estado</th>
                            <th>Prioridad</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($workOrders as $workOrder)
                            <tr>
                                <td>{{ $workOrder->id }}</td>
                                <td>{{ $workOrder->codigo }}</td>
                                <td class="text-truncate" style="max-width: 200px;" title="{{ $workOrder->descripcion }}">
                                    {{ $workOrder->descripcion }}
                                </td>
                                <td>{{ \Carbon\Carbon::parse($workOrder->fecha_solicitud)->format('d/m/Y') }}</td>
                                <td>
                                    @if($workOrder->status->name === 'Completado')
                                        <span class="badge bg-success">
                                            <i class="fas fa-check-circle me-1"></i> Completado
                                        </span>
                                    @elseif($workOrder->status->name === 'Pendiente de Asignacion')
                                        <span class="badge bg-warning text-dark">
                                            <i class="fas fa-hourglass-half me-1"></i> Pendiente
                                        </span>
                                    @elseif($workOrder->status->name === 'Asignado')
                                        <span class="badge bg-info">
                                            <i class="fas fa-users me-1"></i> Asignado
                                        </span>
                                    @elseif($workOrder->status->name === 'Aceptado')
                                        <span class="badge bg-primary">
                                            <i class="fas fa-play-circle me-1"></i> Aceptado
                                        </span>
                                    @elseif($workOrder->status->name === 'Rechazado')
                                        <span class="badge bg-danger">
                                            <i class="fas fa-times-circle me-1"></i> Rechazado
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">
                                            {{ $workOrder->status->name }}
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if($workOrder->prioridad === 'Alta')
                                        <span class="badge bg-danger">
                                            <i class="fas fa-exclamation-triangle me-1"></i> Alta
                                        </span>
                                    @elseif($workOrder->prioridad === 'Media')
                                        <span class="badge bg-warning text-dark">
                                            <i class="fas fa-minus-circle me-1"></i> Media
                                        </span>
                                    @else
                                        <span class="badge bg-success">
                                            <i class="fas fa-arrow-down me-1"></i> Baja
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-inline-flex gap-1 flex-wrap justify-content-center">
                                        <a href="{{ route('work-orders.edit', $workOrder->id) }}" class="btn btn-sm btn-primary rounded-pill px-3" title="Editar">
                                            <i class="fas fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('work-orders.destroy', $workOrder->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta orden de trabajo?');" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3" title="Eliminar">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        <button class="btn btn-outline-info btn-sm ver-mas rounded-pill px-3"
                                                data-workorder='@json($workOrder)'>
                                            <i class="fas fa-eye me-1"></i> Ver
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">No se encontraron órdenes de trabajo.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Paginación -->
    <div class="d-flex justify-content-center mt-4">
        {{ $workOrders->appends(request()->input())->links() }}
    </div>
</div>

<!-- Modal (mantener igual) -->
<div class="modal fade" id="modalWorkOrder" tabindex="-1" aria-labelledby="modalWorkOrderLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-4 shadow-lg">
            <div class="modal-header bg-primary bg-gradient text-white">
                <h5 class="modal-title fw-bold">
                    <i class="fas fa-info-circle me-2"></i>Detalles de la orden
                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered mb-0">
                        <tbody>
                            <tr><th class="bg-light">Código</th><td id="modalCodigo"></td></tr>
                            <tr><th class="bg-light">Descripción</th><td id="modalDescripcion"></td></tr>
                            <tr><th class="bg-light">Dirección</th><td id="modalDireccion"></td></tr>
                            <tr><th class="bg-light">Fecha solicitud</th><td id="modalFechaSolicitud"></td></tr>
                            <tr><th class="bg-light">Fecha programada</th><td id="modalFechaProgramada"></td></tr>
                            <tr><th class="bg-light">Fecha finalización</th><td id="modalFechaFinalizacion"></td></tr>
                            <tr><th class="bg-light">Estado</th><td id="modalEstado"></td></tr>
                            <tr><th class="bg-light">Prioridad</th><td id="modalPrioridad"></td></tr>
                            <tr><th class="bg-light">Observaciones</th><td id="modalObservaciones"></td></tr>
                        </tbody>
                    </table>
                    <div class="mt-3">
                        <h6>Acciones</h6>
                        <div id="modalActions" class="d-flex flex-wrap gap-2">
                            <form id="changeStatusForm" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="estado" id="newStatus">
                                <button type="submit" class="btn btn-success" data-status="Aceptado">Aceptar</button>
                                <button type="submit" class="btn btn-danger" data-status="Rechazado">Rechazar</button>
                                <button type="submit" class="btn btn-primary" data-status="Completado">Completar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .table-responsive {
        border-radius: 0.5rem;
    }
    
    #workOrdersTable {
        width: 100% !important;
    }
    
    .card {
        border: none;
    }
    
    /* Asegurar que los filtros no se salgan */
    .form-label.small {
        font-size: 0.8rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .form-control-sm, .form-select-sm {
        font-size: 0.875rem;
    }
</style>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Solo el código del modal, sin DataTables
    $(document).on('click', '.ver-mas', function() {
        const workOrder = $(this).data('workorder');
        $('#modalCodigo').text(workOrder.codigo);
        $('#modalDescripcion').text(workOrder.descripcion);
        $('#modalDireccion').text(workOrder.direccion_de_servicio);
        $('#modalFechaSolicitud').text(workOrder.fecha_solicitud);
        $('#modalFechaProgramada').text(workOrder.fecha_programada || '—');
        $('#modalFechaFinalizacion').text(workOrder.fecha_finalizacion || '—');
        $('#modalEstado').text(workOrder.status.name); // Updated to workOrder.status.name
        $('#modalPrioridad').text(workOrder.prioridad);
        $('#modalObservaciones').text(workOrder.observaciones || 'Sin observaciones');

        // Lógica de los botones de acción
        const form = $('#changeStatusForm');
        form.attr('action', '/work-orders/' + workOrder.id + '/estado');

        const buttons = form.find('button');
        buttons.hide();

        if (workOrder.status.name === 'Pendiente de Asignacion') {
            // No actions available, wait for assignment
        } else if (workOrder.status.name === 'Asignado') {
            buttons.filter('[data-status="Aceptado"]').show();
            buttons.filter('[data-status="Rechazado"]').show();
        } else if (workOrder.status.name === 'Aceptado') {
            buttons.filter('[data-status="Completado"]').show();
            buttons.filter('[data-status="Rechazado"]').show();
        }

        $('#modalWorkOrder').modal('show');
    });

    $('#changeStatusForm button').on('click', function(e) {
        e.preventDefault();
        const status = $(this).data('status');
        $('#newStatus').val(status);
        $('#changeStatusForm').submit();
    });
});
</script>
@endpush