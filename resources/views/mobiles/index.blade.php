@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>{{ __('Moviles') }}</span>
                        <a href="{{ route('mobiles.create') }}" class="btn btn-success btn-sm">
                            <i class="fa-solid fa-plus"></i> Agregar móvil
                        </a>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mobiles as $mobile)
                                    <tr>
                                        <td>{{ $mobile->id }}</td>
                                        <td>{{ $mobile->nombre }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('mobiles.edit', $mobile->id) }}" class="btn btn-warning btn-sm px-3 py-1">
                                                    <i class="fa-solid fa-pen-to-square"></i> Editar
                                                </a>
                                                <form action="{{ route('mobiles.destroy', $mobile->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm px-3 py-1" onclick="return confirm('¿Estás seguro de eliminar este movil?')">
                                                        <i class="fa-solid fa-trash"></i> Eliminar 
                                                    </button>
                                                </form>
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
