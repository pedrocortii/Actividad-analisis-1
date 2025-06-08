@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{__('Crear Nueva Tarea') }}</div>

                <div class="card-body">
                    <form action="{{ route('tareas.store') }}" method="POST">
                        @csrf   
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Crear Tarea</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection