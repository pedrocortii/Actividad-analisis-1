@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center rounded-top">
                    <h4 class="mb-0 fw-semibold">Vehículos</h4>
                    @can('crear vehiculos')
                    <a href="{{ route('vehiculos.create') }}" class="btn btn-outline-light btn-sm" title="Agregar vehículo">
                        <i class="fa-solid fa-plus"></i> Nuevo
                    </a>
                    @endcan
                </div>
                <div class="card-body bg-white">
                    @if (session('status'))
                        <div class="alert alert-success mb-3" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table id= "vehiculosTable" class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Patente</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Año</th>
                                    <th>VTV</th>
                                    <th>Foto</th>
                                    <th class="text-end">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vehiculos as $vehiculo)
                                    <tr>
                                        <td>{{ $vehiculo->id }}</td>
                                        <td class="fw-bold text-dark">{{ $vehiculo->patente }}</td>
                                        <td>{{ $vehiculo->marca->nombre ?? 'Sin marca' }}</td>
                                        <td>{{ $vehiculo->modelo }}</td>
                                        <td>{{ $vehiculo->año }}</td>
                                        <td>
                                            {{ $vehiculo->vtv }}
                                        </td>
                                        <td>
                                            @if($vehiculo->foto)
                                                <img src="{{ asset('images/vehiculo' . $vehiculo->foto) }}" alt="Foto" class="img-thumbnail" style="max-width: 70px; border-radius: 6px;">
                                            @else
                                                <span class="text-muted fst-italic">Sin foto</span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <div class="d-inline-flex gap-1">
                                                @can('editar vehiculos')
                                                <a href="{{ route('vehiculos.edit', $vehiculo->id) }}" class="btn btn-outline-primary btn-sm" title="Editar">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                @endcan
                                                @can('borrar vehiculos')
                                                <form action="{{ route('vehiculos.destroy', $vehiculo->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm" title="Eliminar" onclick="return confirm('¿Estás seguro de eliminar este vehículo?')">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{-- Si tienes paginación --}}
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
            console.log("jQuery listo!");
        });
        
        $(document).ready(function() {
            $('#vehiculosTable').DataTable({
                "language":{
                    "info":"_TOTAL_ registros",
                    "search":"Buscar",
                    "paginate":{
                        "next":"Siguiente",
                        "previous":"Anterior"
                    },
                    "lengthMenu":'Mostrar <select>'+
                        '<option value="5">5</option>'+
                        '<option value="10">10</option>'+
                        '</select> registros',
                    "loadingRecords":"Cargando...",
                    "Processing":"Procesando...",
                    "emptyTable":"No hay datos",
                    "zeroRecords":"No hay coincidencias",
                    "infoEmpty":"",
                    "infoFiltered":""
                }
            });
        } );
    </script>
@endpush

@push('styles')
<style>
    .table-hover tbody tr:hover {
        background-color: #f5f5f5;
    }
    .badge {
        font-size: 0.8em;
        padding: 0.3em 0.55em;
    }
</style>
@endpush
