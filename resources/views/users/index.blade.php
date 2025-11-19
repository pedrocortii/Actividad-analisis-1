@extends('layouts.admin') {{-- Se cambió a layouts.admin --}}

@section('content')
<div class="container-fluid"> {{-- Cambiado a container-fluid para mejor integración con AdminLTE --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">{{ __('Listado de Usuarios') }}</h3>
                    @can('crear usuarios')
                    <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">{{ __('Crear Nuevo Usuario') }}</a>
                    @endcan               
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table table-hover table-striped"> {{-- Añadido table-striped --}}
                        <thead>
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Nombre') }}</th>
                                <th>{{ __('Correo Electrónico') }}</th>
                                <th>{{ __('Roles') }}</th>
                                <th>{{ __('Acciones') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @foreach($user->roles as $role)
                                        <span class="badge bg-info text-dark">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                <td class="d-flex gap-1">
                                    @can('editar usuarios')
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary">{{ __('Editar') }}</a>
                                    @endcan
                                    @can('eliminar usuarios')
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">{{ __('Eliminar') }}</button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $users->links() }} {{-- Si usas paginación --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
