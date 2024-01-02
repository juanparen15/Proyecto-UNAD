@extends('layouts.login')
@section('title', 'Registro')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="{{ route('welcome') }}" class="h2"><b>CRC-UNAD
                    <script type="text/javascript">
                        document.write(new Date().getFullYear());
                    </script>
                </b></a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Registrarte</p>

            <form action="{{ route('register') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input id="username" name="username" value="{{ old('username') }}" type="text"
                        class="form-control @error('username') is-invalid @enderror" placeholder="Nombre de Usuario"
                        required autocomplete="username" autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input id="name" name="name" value="{{ old('name') }}" type="text"
                        class="form-control @error('name') is-invalid @enderror" placeholder="Nombre" required
                        autocomplete="name" autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input id="lastname" name="lastname" value="{{ old('lastname') }}" type="text"
                        class="form-control @error('lastname') is-invalid @enderror" placeholder="Apellido" required
                        autocomplete="lastname" autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    @error('lastname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                        class="form-control @error('email') is-invalid @enderror" placeholder="Correo electrónico" required
                        autocomplete="email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input id="password" type="password" name="password"
                        class="form-control @error('password') is-invalid @enderror" placeholder="Contraseña" required
                        autocomplete="new-password">
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
                {{-- <div class="col-md-6">
                    <div class="form-group">
                        <label for="role">Rol</label>
                        <select id="role" name="role"
                            class="form-control custom-select @error('role') is-invalid @enderror">
                            <option selected disabled>Selecciona un rol</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ old('role') == $role->id ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('role')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div> --}}
                <div class="input-group mb-3">
                    <input id="password-confirm" type="password" class="form-control" placeholder="Confirma contraseña"
                        name="password_confirmation" required autocomplete="new-password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="icheck-primary">
                            <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>
                            <label for="agreeTerms">
                                Acepto los <a href="#">términos</a>
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary btn-block">Registrarse</button>
                    </div>
                    @if (Session::has('registro_exitoso'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('registro_exitoso') }}
                        </div>
                    @endif
                    <!-- /.col -->
                </div>
            </form>

            {{-- <div class="social-auth-links text-center">
                <a href="#" class="btn btn-block btn-primary">
                    <i class="fab fa-facebook mr-2"></i>
                    Sign up using Facebook
                </a>
                <a href="#" class="btn btn-block btn-danger">
                    <i class="fab fa-google-plus mr-2"></i>
                    Sign up using Google+
                </a>
            </div> --}}

            <a href="{{ route('login') }}" class="text-center">Ya tengo una cuenta</a>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->

@endsection
