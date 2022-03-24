@extends('auth.authentication')

@section('form')
    <div class="card" id="loginform">
        <div class="card-body">
            <h2>@lang('authentication.login.welcome')</h2>
            <p class="text-muted fs-4">@lang('authentication.login.new-here') <a href="{{route('register')}}" id="to-register">@lang('authentication.login.create-an-account')</a></p>
            <form method="POST" class="form-horizontal mt-4 pt-4 needs-validation" id="loginform" action="{{route('login')}}">
                @csrf
                <div class="form-floating mb-3">
                    <input id="username" type="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" placeholder="Nombre de usuario" required autofocus>
                    <label for="username">@lang('authentication.login.username')</label>
                    @if ($errors->has('username'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-floating mb-3">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Contraseña" required>
                    <label for="password">@lang('authentication.login.password')</label>
                    @if ($errors->has('password'))
                        <strong>{{ $errors->first('password') }}</strong>
                    @endif
                </div>
                <div class="d-flex align-items-center mb-3">
                    <div class="form-check">
                        <input class="form-check-input" id="checkbox-signup" type="checkbox">
                        <label class="form-check-label" for="checkbox-signup">
                            @lang('authentication.login.remember-me')
                        </label>
                    </div>
                    <div class="ms-auto">
                        <a href="{{ route('password.request') }}" id="to-recover" class="fw-bold">@lang('authentication.login.forgot-password')</a>
                    </div>
                </div>
                <div class="d-flex align-items-stretch button-group mt-4 pt-2">
                    <button type="submit" class="btn btn-info btn-lg px-4">@lang('authentication.login.sign-in')</button>
                    <a href="{{ url('/') }}" id="to-login2" class="btn btn-lg btn-light-secondary text-secondary font-weight-medium">@lang('authentication.register.back')</a>
                </div>
            </form>
        </div>
    </div>
@endsection
