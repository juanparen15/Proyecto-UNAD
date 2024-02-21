@extends('layouts.login')

@section('content')
    <div class="container">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="{{ route('welcome') }}" class="h2"><b>CRC-UNAD
                        <script type="text/javascript">
                            document.write(new Date().getFullYear());
                        </script>
                    </b></a>
            </div>
            {{-- <div class="row justify-content-center"> --}}
            <div class="card-body">
                {{-- <div class="col-md-8"> --}}
                <div class="login-box-msg">
                    <div class="login-box-msg">{{ __('Recuperar Contraseña') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="form-group row">
                                {{-- <label for="email"
                                        class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label> --}}

                                <div class="input-group mb-3">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" placeholder="Correo electrónico" required
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

                                <div class="form-group row mb-0">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Recuperar') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                            {{-- <a href="{{ route('login') }}" class="text-left">Ya tengo una cuenta</a> --}}
                        </form>
                        <div class="row">
                            <p class="mb-0 text-left">
                                <a href="{{ route('login') }}" class="text-left">Lo recordé</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
