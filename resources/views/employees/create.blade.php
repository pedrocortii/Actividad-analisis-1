@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registrar nuevo empleado') }}</div>

                <div class="card-body vh-75 overflow-auto">
                    <form action="{{ route('employees.store') }}" method="POST">
                        @csrf   
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>

                            <label for="apellido">Apellido</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" required>

                            <label for="dni">DNI</label>
                            <input type="text" class="form-control" id="dni" name="dni" required>

                            <label for="telefono">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono">

                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email">

                            <label for="direccion">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion">

                            <label for="rol">Rol</label>
                            <input type="text" class="form-control" id="rol" name="rol">

                            <label for="licencia_conducir">Licencia de Conducir</label>
                            <select class="form-control" id="licencia_conducir" name="licencia_conducir">
                                <option value="1">Sí</option>
                                <option value="0">No</option>
                            </select>

                            <label for="fecha_contratacion">Fecha de Contratación</label>
                            <input type="date" class="form-control" id="fecha_contratacion" name="fecha_contratacion">

                            <label for="estado">Estado</label>
                            <select class="form-control" id="estado" name="estado">
                                <option value="activo">Activo</option>
                                <option value="inactivo">Inactivo</option>
                            </select>

                            <label for="skills">Skills</label>
                            <select name="skills[]" id="skills" class="form-control" multiple>
                                @foreach($skills as $skill)
                                    <option value="{{ $skill->id }}">{{ $skill->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Registrar Empleado</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
