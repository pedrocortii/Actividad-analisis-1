<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registro | AdminLTE</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>Tecno</b>Servi</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Registrar una nueva cuenta</p>

      <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- Nombre --}}
        <div class="input-group mb-3">
          <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                 name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                 placeholder="Nombre completo">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          @error('name')
            <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
          @enderror
        </div>

        {{-- Email --}}
        <div class="input-group mb-3">
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                 name="email" value="{{ old('email') }}" required autocomplete="email"
                 placeholder="Correo electrónico">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          @error('email')
            <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
          @enderror
        </div>

        {{-- Password --}}
        <div class="input-group mb-3">
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                 name="password" required autocomplete="new-password" placeholder="Contraseña">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          @error('password')
            <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
          @enderror
        </div>

        {{-- Confirmar Password --}}
        <div class="input-group mb-3">
          <input id="password-confirm" type="password" class="form-control"
                 name="password_confirmation" required autocomplete="new-password" placeholder="Confirmar contraseña">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        {{-- Checkbox de términos --}}
        <div class="row mb-3">
          <div class="col-12">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>
              <label for="agreeTerms">
                Acepto los <a href="#">términos</a>
              </label>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Registrar</button>
          </div>
        </div>
      </form>

      <p class="mt-3 mb-0 text-center">
        <a href="{{ route('login') }}">Ya tengo una cuenta</a>
      </p>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>
</html>
