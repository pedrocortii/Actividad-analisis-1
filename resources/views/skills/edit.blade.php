@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Editar nombre de skill</h5>
                    <a href="{{ route('skills.index') }}" class="btn btn-secondary btn-sm">Volver</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('skills.update', $skill->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre de la skill</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $skill->nombre }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <a href="{{ route('skills.index') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection