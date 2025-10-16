@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>{{ __('work-group-employees') }}</span>
                        @can('crear work group employees')
                        <a href="{{ route('work-group-employees.create') }}" class="btn btn-success btn-sm">
                            <i class="fa-solid fa-plus"></i> Agregar Grupo de Trabajo
                        </a>
                        @endcan
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table class="table" id="tableDetalle">
                            <thead>
                                <tr>
                                    <th>Identificación</th>
                                    <th>Nombre</th>
                                    <th>Acciones</th>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>ID de vehiculo</th>
                                    <th>ID de empleado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($work-groups as $work-group)
                                    <tr>
                                        <td>{{ $work-group->id }}</td>
                                        <td>{{ $work-group->Nombre }}</td>
                                        <td>{{ $work-group->vehiculo_id }}</td>
                                        <td>{{ $work-group->employee_id }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                @can('editar work group employees')
                                                <a href="{{ route('work-groups.edit', $work-group->id) }}" class="btn btn-warning btn-sm px-3 py-1">
                                                    <i class="fa-solid fa-pen-to-square"></i> Editar
                                                </a>
                                                @endcan
                                                @can('eliminar work group employees')
                                                <form action="{{ route('work-groups.destroy', $work-group->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm px-3 py-1" onclick="return confirm('¿Estás seguro de eliminar este Grupo de Trabajo?')">
                                                        <i class="fa-solid fa-trash"></i> Eliminar 
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