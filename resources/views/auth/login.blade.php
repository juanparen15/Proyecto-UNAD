@extends('layouts.login')
@section('title', 'Login CRC-UNAD')
@section('content')
<script>
const Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 5000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.onmouseenter = Swal.stopTimer;
    toast.onmouseleave = Swal.resumeTimer;
  }
});
Toast.fire({
  icon: "info",
  title: "Debe registrarse para acceder al Sistema"
});
</script>    

    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="{{ route('welcome') }}" class="h2"><b>CRC-UNAD
                    <script type="text/javascript">
                        document.write(new Date().getFullYear());
                    </script>
                </b></a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Iniciar sesión</p>

            {!! Form::open(['route' => 'login', 'method' => 'POST']) !!}
            @csrf
            <div class="input-group mb-3">
                <input type="email" name="email" value="{{ old('email') }}"
                    class="form-control @error('email') is-invalid @enderror" placeholder="Correo electrónico" required
                    autocomplete="email" autofocus>
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
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    placeholder="Contraseña" required required autocomplete="current-password">
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
                        </div> --}}
            </div>
            <!-- /.col -->
            <div class="col-6">
                <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
            </div>
            <!-- /.col -->
            <p class="mb-0 text-right">
                {{-- @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">Olvidé mi contraseña</a>
                @endif --}}
            </p>
            <p class="mb-0 text-right">
                {{-- <a href="{{ route('register') }}" class="text-center">Crear cuenta nueva</a> --}}
                <a href="{{ route('register') }}" class="text-center">¿No tienes una cuenta? Regístrate aquí.</a>

            </p>
        </div>

        {!! Form::close() !!}
    </div>    
@endsection
