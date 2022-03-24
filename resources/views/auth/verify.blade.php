@extends('app.master')

@section('content')
<div class="card text-center">
    <div class="card-header">
        {{ __('Por favor, verifica tu dirección de email') }}
    </div>
    <div class="card-block">
        <h4 class="card-title">{{ __('Te hemos enviado un email para que puedas verificar tu cuenta') }}</h4>
        <p class="card-text">{{ __('Antes de continuar, por favor verifica tu email para la verificacion de la cuenta.') }}</p>
        <a href="{{ route('verification.resend') }}" class="btn btn-info">{{ __('Si no lo recibiste, presiona aqui para reenviar') }}</a>
    </div>
</div>
@endsection
