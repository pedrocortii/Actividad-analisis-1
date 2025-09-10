<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Asignar Vehículo</title>
</head>
<body>
    <h1>Asignar Vehículo a Móvil</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('movil.asignarVehiculo') }}" method="POST">
        @csrf
        <div>
            <label for="movil_id">Seleccionar Móvil:</label>
            <select name="movil_id" id="movil_id">
                @foreach($moviles as $movil)
                    <option value="{{ $movil->id }}">{{ $movil->nombre }}</option>
                @endforeach
            </select>
        </div>
        <br>
        <div>
            <label for="vehiculo_id">Seleccionar Vehículo:</label>
            <select name="vehiculo_id" id="vehiculo_id">
                @foreach($vehiculosSinAsignar as $vehiculo)
                    <option value="{{ $vehiculo->id }}">{{ $vehiculo->patente }} ({{ $vehiculo->modelo }})</option>
                @endforeach
            </select>
        </div>
        <br>
        <button type="submit">Asignar</button>
    </form>
</body>
</html>