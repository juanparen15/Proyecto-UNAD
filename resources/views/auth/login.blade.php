@extends('layouts.login')
@section('title','Login Inventario')
@section('content')
<div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="{{route('welcome')}}" class="h1"><b>Inventario Documental <script type="text/javascript">
            document.write(new Date().getFullYear());
        </script></b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Iniciar sesión</p>

      <form action="{{ route('login') }}" method="post">
        @csrf
        <div class="input-group mb-3">
          <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Correo electrónico" required autocomplete="email" autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Contraseña" required required autocomplete="current-password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="row">
          {{-- <div class="col-6">
            <div class="icheck-primary">
              <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
              <label for="remember">
                Recordarme
              </label>
            </div>
          </div> --}}
          <!-- /.col -->
          <div class="col-6">
            <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

       {{-- <div class="social-auth-links text-center mt-2 mb-3">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div>  --}}
      <!-- /.social-auth-links -->

      {{-- <p class="mb-1">
        @if (Route::has('password.request'))
        <a href="{{ route('password.request') }}">Olvidé mi contraseña</a>
        @endif
      </p>
      <p class="mb-0">
        <a href="{{ route('register') }}" class="text-center">Crear cuenta nueva</a>
      </p> --}}
    </div>
    <!-- /.card-body -->
</div>
@endsection