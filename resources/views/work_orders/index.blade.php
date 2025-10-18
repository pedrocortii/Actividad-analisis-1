@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">

    <!-- Encabezado -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">
            <i class="fas fa-clipboard-list me-2"></i>  Órdenes de trabajo
        </h3>
        <button class="btn btn-primary rounded-pill shadow-sm">
            <i class="fas fa-plus me-1"></i> Nueva orden
        </button>
    </div>

    <!-- Tabla -->
    <div class="table-responsive shadow-sm rounded-4 bg-white p-3">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <table class="table table-hover align-middle" id="tableDetalle">
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
                @foreach ($workOrders as $workOrder)
                    <tr>
                        <td>{{ $workOrder->id }}</td>
                        <td>{{ $workOrder->codigo }}</td>
                        <td>{{ $workOrder->descripcion }}</td>
                        <td>{{ $workOrder->fecha_solicitud }}</td>
                        <td>
                            @if($workOrder->estado === 'Completado')
                                <span class="badge bg-success">
                                    <i class="fas fa-check-circle me-1"></i>  Completado
                                </span>
                            @elseif($workOrder->estado === 'Pendiente')
                                <span class="badge bg-warning text-dark">
                                    <i class="fas fa-hourglass-half me-1"></i>  Pendiente
                                </span>
                            @else
                                <span class="badge bg-secondary">
                                    {{ $workOrder->estado }}
                                </span>
                            @endif
                        </td>
                        <td>
                            @if($workOrder->prioridad === 'Alta')
                                <span class="badge bg-danger">
                                    <i class="fas fa-exclamation-triangle me-1"></i>  Alta
                                </span>
                            @elseif($workOrder->prioridad === 'Media')
                                <span class="badge bg-info text-dark">
                                    <i class="fas fa-minus-circle me-1"></i>  Media
                                </span>
                            @else
                                <span class="badge bg-success">
                                    <i class="fas fa-arrow-down me-1"></i>  Baja
                                </span>
                            @endif
                        </td>
                        <td class="text-center">
                            <button 
                                class="btn btn-outline-primary btn-sm ver-mas rounded-pill px-3"
                                data-workorder='@json($workOrder)'>
                                <i class="fas fa-eye me-1"></i> Ver más
                            </button>
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalWorkOrder" tabindex="-1" aria-labelledby="modalWorkOrderLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content rounded-4 shadow-lg">
      <div class="modal-header bg-primary bg-gradient text-white">
        <h5 class="modal-title fw-bold">
            <i class="fas fa-info-circle me-2"></i>Detalles de la orden
        </h5>
        <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Close"></button>
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
                    <div id="modalActions" class="d-flex flex-wrap gap-2"></div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

<!-- Estilos -->
<style>
    body {
        background-color: #f8f9fa;
    }

    h3 i {
        color: #007bff;
    }

    .table-hover tbody tr:hover {
        background-color: #f1f7ff;
        transition: background-color 0.3s ease;
    }

    .btn-outline-primary:hover i {
        transform: scale(1.15);
        transition: transform 0.2s ease;
    }

    .table-responsive {
        background-color: #fff;
        border-radius: 1rem;
    }
</style>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#tableDetalle').DataTable({
        language:{
            info:"_TOTAL_ registros",
            search:"Buscar",
            paginate:{ next:"Siguiente", previous:"Anterior" },
            lengthMenu:'Mostrar <select>'+
                '<option value="5">5</option>'+
                '<option value="10">10</option>'+
                '<option value="25">25</option>'+
                '</select> registros',
            loadingRecords:"Cargando...",
            processing:"Procesando...",
            emptyTable:"No hay datos disponibles",
            zeroRecords:"No hay coincidencias",
        }
    });

        $(document).on('click', '.ver-mas', function() {
            const workOrder = $(this).data('workorder');
            $('#modalCodigo').text(workOrder.codigo);
            $('#modalDescripcion').text(workOrder.descripcion);
            $('#modalDireccion').text(workOrder.direccion_de_servicio);
            $('#modalFechaSolicitud').text(workOrder.fecha_solicitud);
            $('#modalFechaProgramada').text(workOrder.fecha_programada);
            $('#modalFechaFinalizacion').text(workOrder.fecha_finalizacion || '—');
            $('#modalEstado').text(workOrder.estado);
            $('#modalPrioridad').text(workOrder.prioridad);
            $('#modalObservaciones').text(workOrder.observaciones || 'Sin observaciones');

        // Mapa de transiciones (ajustá las etiquetas si tu DB usa minúsculas)
        const transiciones = {
            'Pendiente': ['Aceptado', 'Rechazado'],
            'Aceptado': ['Completado', 'Rechazado'],
            'Completado': [],
            'Rechazado': []
        };

        const accionesContainer = $('#modalActions');
        accionesContainer.empty();

        const opciones = transiciones[workOrder.estado] || [];

        if (opciones.length === 0) {
            accionesContainer.append('<span class="text-muted">No hay acciones disponibles para este estado.</span>');
        } else {
            // Extraemos token CSRF del meta tag (asegurarse que layout lo tenga)
            const token = $('meta[name="csrf-token"]').attr('content') || '';

            opciones.forEach(function(op) {
                // Creamos formulario con campo _token
                const $form = $('<form/>', {
                    method: 'POST',
                    action: '/work-orders/' + workOrder.id + '/estado',
                    css: { display: 'inline-block', marginRight: '6px' }
                });
                $form.append($('<input/>', { type: 'hidden', name: '_token', value: token }));
                $form.append($('<input/>', { type: 'hidden', name: 'estado', value: op }));
                const $btn = $('<button/>', { type: 'submit', class: 'btn btn-sm btn-primary', text: op });
                $form.append($btn);
                accionesContainer.append($form);
            });
        }

        $('#modalWorkOrder').modal('show');
    });
});
</script>
@endpush
