@extends('layouts.login')

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
            <div class="card-header">{{ __('Verifique su dirección de correo electrónico') }}</div>

            <div class="card-body">
                @if (session('resent'))
                    <div class="alert alert-primary" role="alert">
                        {{ __('Se ha enviado un nuevo enlace de verificación a su dirección de correo electrónico.') }}
                    </div>
                @endif


                {{ __('Antes de continuar, consulte su correo electrónico para obtener un enlace de verificación.') }}
                {{ __('Si no recibiste el correo electrónico') }},
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Haga clic aquí') }}</button>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
