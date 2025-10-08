@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Dashboard') }}</span>
                    @can('crear marca de vehiculos')
                    <a href="{{ route('marcaVehiculos.create') }}" class="btn btn-primary btn-sm">Añadir marca</a>
                    @endcan
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status')}}
                        </div>
                    @endif
                    <table class="table" id="tableDetalle">
                        <thead>
                            <tr>
                                <th>Identificación</th>
                                <th>Nombre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($marcaVehiculos as $marcaVehiculo)
                                <tr>
                                    <td>{{ $marcaVehiculo->id }}</td>
                                    <td>{{ $marcaVehiculo->nombre }}</td>
                                    <td>
                                        @can('editar marca vehiculos')
                                        <a href="{{ route('marcaVehiculo.edit', $marcaVehiculo->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                        @endcan
                                        @can('eliminar marca vehiculos')
                                        <form action="{{ route('marcaVehiculo.destroy', $marcaVehiculo->id) }}" method="POST" style='display:inline-block;'>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estas seguro de eliminar esta marca de vehiculo?')">
                                                Eliminar
                                            </button>
                                        </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
            $('#tableDetalle').DataTable({
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