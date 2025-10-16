@extends('layouts.admin')
@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="fw-bold text-dark mb-0">
                    <i class="fas fa-car-side nav-icon"></i> Marcas de vehículos
                </h3>
                @can('crear marca vehiculos')
                <a href="{{ route('marcaVehiculos.create') }}" class="btn btn-primary rounded-pill shadow-sm px-3">
                    <i class="fa-solid fa-plus me-1"></i> Añadir marca
                </a>
                @endcan
            </div>

            <div class="table-responsive shadow-sm rounded-4 bg-white p-3">
                @if (session('status'))
                    <div class="alert alert-success mb-3" role="alert">
                        <i class="fa-solid fa-circle-check me-2"></i>{{ session('status') }}
                    </div>
                @endif

                <table class="table table-hover align-middle" id="tableDetalle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($marcaVehiculos as $marcaVehiculo)
                        <tr>
                            <td class="text-muted">{{ $marcaVehiculo->id }}</td>
                            <td class="fw-bold text-dark">{{ $marcaVehiculo->nombre }}</td>
                            <td class="text-center">
                                <div class="d-inline-flex gap-1">
                                    @can('editar marca vehiculos')
                                    <a href="{{ route('marcaVehiculo.edit', $marcaVehiculo->id) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3" title="Editar">
                                        <i class="fa-solid fa-pen-to-square me-1"></i> Editar
                                    </a>
                                    @endcan
                                    @can('eliminar marca vehiculos')
                                    <form action="{{ route('marcaVehiculo.destroy', $marcaVehiculo->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3" title="Eliminar" onclick="return confirm('¿Estás seguro de eliminar esta marca de vehículo?')">
                                            <i class="fa-solid fa-trash me-1"></i> Eliminar
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#tableDetalle').DataTable({
        "language": {
            "info": "_TOTAL_ registros",
            "search": "Buscar",
            "paginate": { "next": "Siguiente", "previous": "Anterior" },
            "lengthMenu": 'Mostrar <select>'+
                '<option value="5">5</option>'+
                '<option value="10">10</option>'+
                '</select> registros',
            "loadingRecords": "Cargando...",
            "Processing": "Procesando...",
            "emptyTable": "No hay datos",
            "zeroRecords": "No hay coincidencias",
            "infoEmpty": "",
            "infoFiltered": ""
        }
    });
});
</script>
@endpush

@push('styles')
<style>
.table-hover tbody tr:hover {
    background-color: #f8f9fa;
    transition: background-color 0.2s ease;
}

.btn-outline-primary, .btn-outline-danger {
    transition: all 0.2s ease;
}

.btn-outline-primary:hover {
    background-color: #007bff;
    color: #fff;
    transform: translateY(-2px);
}

.btn-outline-danger:hover {
    background-color: #dc3545;
    color: #fff;
    transform: translateY(-2px);
}

.alert-success {
    border-left: 5px solid #198754;
}

.dataTables_wrapper .dataTables_filter input {
    border-radius: 20px;
    padding: 6px 12px;
}

.table-responsive {
    background-color: #fff;
    border-radius: 1rem;
    padding: 15px;
}
</style>
@endpush
