@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Editar datos del empleado</div>
                <div class="card-body">
                    <form action="{{ route('employees.update', $employee->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre del empleado</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $employee->nombre) }}">

                            <label for="apellido" class="form-label">Apellido del empleado</label>
                            <input type="text" name="apellido" id="apellido" class="form-control" value="{{ old('apellido', $employee->apellido) }}">

                            <label for="dni" class="form-label">DNI del empleado</label>
                            <input type="text" name="dni" id="dni" class="form-control" value="{{ old('dni', $employee->dni) }}">

                            <label for="telefono" class="form-label">Teléfono del empleado</label>
                            <input type="text" name="telefono" id="telefono" class="form-control" value="{{ old('telefono', $employee->telefono) }}">

                            <label for="email" class="form-label">Email del empleado</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $employee->email) }}">

                            <label for="direccion" class="form-label">Dirección del empleado</label>
                            <input type="text" name="direccion" id="direccion" class="form-control" value="{{ old('direccion', $employee->direccion) }}">

                            <label for="rol" class="form-label">Rol del empleado</label>
                            <input type="text" name="rol" id="rol" class="form-control" value="{{ old('rol', $employee->rol) }}">

                            <label for="licencia_conducir" class="form-label">Licencia de conducir</label>
                            <select class="form-control" id="licencia_conducir" name="licencia_conducir">
                                <option value="1" {{ old('licencia_conducir', $employee->licencia_conducir) == 1 ? 'selected' : '' }}>Sí</option>
                                <option value="0" {{ old('licencia_conducir', $employee->licencia_conducir) == 0 ? 'selected' : '' }}>No</option>
                            </select>

                            <label for="fecha_contratacion" class="form-label">Fecha de contratación</label>
                            <input type="date" name="fecha_contratacion" id="fecha_contratacion" class="form-control" value="{{ old('fecha_contratacion', $employee->fecha_contratacion) }}">

                            <label for="estado" class="form-label">Estado del empleado</label>
                            <select class="form-control" id="estado" name="estado">
                                <option value="activo" {{ old('estado', $employee->estado) == 'activo' ? 'selected' : '' }}>Activo</option>
                                <option value="inactivo" {{ old('estado', $employee->estado) == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                            </select>

                            <!-- Skills -->
                            <label for="skills" class="form-label mt-3">Skills</label>
                            <select name="skills[]" id="skills" class="form-control" multiple>
                                @foreach($skills as $skill)
                                    <option value="{{ $skill->id }}"
                                        {{ $employee->skills->contains($skill->id) ? 'selected' : '' }}>
                                        {{ $skill->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
