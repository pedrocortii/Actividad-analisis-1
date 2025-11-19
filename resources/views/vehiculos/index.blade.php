@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            
            {{-- Encabezado principal --}}
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="fw-bold text-dark mb-0">
                    <i class="fa-solid fa-truck me-2 text-primary"></i> Vehículos
                </h3>
                @can('crear vehiculos')
                <a href="{{ route('vehiculos.create') }}" class="btn btn-primary rounded-pill shadow-sm px-3">
                    <i class="fa-solid fa-plus me-1"></i> Registrar Vehiculo
                </a>
                @endcan
            </div>

            {{-- Tarjeta principal --}}
            <div class="table-responsive shadow-sm rounded-4 bg-white p-3">
                <div class="card-body bg-white">
                    {{-- Mensaje de éxito --}}
                    @if (session('status'))
                        <div class="alert alert-success mb-3" role="alert">
                            <i class="fa-solid fa-circle-check me-2"></i>{{ session('status') }}
                        </div>
                    @endif

                    {{-- Tabla --}}
                    <div class="table-responsive">
                        <table id="vehiculosTable" class="table table-hover align-middle">
                            <thead class="table-light">
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
                                @foreach ($vehiculos as $vehiculo)
                                    <tr>
                                        <td class="text-muted">{{ $vehiculo->id }}</td>
                                        <td class="fw-bold text-dark">{{ $vehiculo->patente }}</td>
                                        <td>{{ $vehiculo->marca->nombre ?? 'Sin marca' }}</td>
                                        <td>{{ $vehiculo->modelo }}</td>
                                        <td>{{ $vehiculo->año }}</td>
                                        <td>{{ $vehiculo->estado }}</td>
                                        <td>
                                            <span class="badge {{ $vehiculo->vtv ? 'bg-success' : 'bg-danger' }}">
                                                {{ $vehiculo->vtv ?? 'No disponible' }}
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
                                            <div class="d-inline-flex gap-1">
                                                @can('editar vehiculos')
                                                <a href="{{ route('vehiculos.edit', $vehiculo->id) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3" title="Editar">
                                                    <i class="fa-solid fa-pen-to-square me-1"></i> Editar
                                                </a>
                                                @endcan
                                                @can('eliminar vehiculos')
                                                <form action="{{ route('vehiculos.destroy', $vehiculo->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3" title="Eliminar" onclick="return confirm('¿Estás seguro de eliminar este vehículo?')">
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

                        {{-- Si usas paginación --}}
                        {{-- 
                        <div class="d-flex justify-content-center mt-3">
                            {{ $vehiculos->links() }}
                        </div> 
                        --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#vehiculosTable').DataTable({
        "language": {
            "info": "_TOTAL_ registros",
            "search": "Buscar",
            "paginate": { "next": "Siguiente", "previous": "Anterior" },
            "lengthMenu": 'Mostrar <select>'+
                '<option value="5">5</option>'+
                '<option value="10">10</option>'+
                '<option value="20">20</option>'+
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
</style>
@endpush
