@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{__('Añadir nueva marca') }}</h5>
                    <a href="{{ route('marcaVehiculos.index') }}" class="btn btn-secondary btn-sm">Volver</a>
                </div>

                <div class="card-body">
                    <form action="{{ route('marcaVehiculos.store') }}" method="POST">
                        @csrf   
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Añadir marca</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection