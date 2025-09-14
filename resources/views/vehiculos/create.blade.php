@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{__('Crear Nueva Tarea') }}</div>

                <div class="card-body">
                    <form action="{{ route('vehiculos.store') }}" method="POST">
                        @csrf   
                        <div class="form-group">
                            <label for="Patente">Patente</label>
                            <input type="text" class="form-control" id="patente" name="patente" required>
                            <label for="Marca">Marca</label>
                            <input type="text" class="form-control" id="marca" name="marca" required>
                            <label for="Modelo">Modelo</label>
                            <input type="text" class="form-control" id="modelo" name="modelo" required>
                            <label for="Año">Año</label>
                            <input type="number" class="form-control" id="año" name="año" required>
                            <label for="VTV">VTV</label>
                            <input type="date" class="form-control" id="vtv" name="vtv" required>
                            <label for="Foto">Foto</label>
                            <input type="file" class="img-responsive" id="foto" name="foto">
                        </div>
                        <button type="submit" class="btn btn-primary">Crear vehiculo</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection