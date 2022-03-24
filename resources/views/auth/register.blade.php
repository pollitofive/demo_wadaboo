@extends('auth.authentication')

@section('form')
    <div class="card" id="register">
        <div class="card-body">
            <h2>@lang('authentication.register.create-your-free-account')</h2>
            <div class="d-flex align-items-stretch button-group">
                <p>@lang('authentication.register.are-you-registered') <a href="{{ route('login') }}" id="to-recover" class="fw-bold"> @lang('authentication.login.welcome')</a></p>
            </div>
            <form method="POST"  class="form-horizontal mt-4 pt-4 needs-validation" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control form-input-bg" id="username" name="username" placeholder="john deo" value="{{ old('username') }}" required>
                    <label for="username">@lang('authentication.register.username')</label>
                    @if ($errors->has('username'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-floating mb-3">
                    <input id="email" type="text"  placeholder="Email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"  required >
                    <label for="email">@lang('authentication.register.email')</label>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-floating mb-3">
                    <input id="password" type="password" placeholder="Contraseña" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                    <label for="password">@lang('authentication.register.password')</label>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-floating mb-3">
                    <input id="password_confirmation" type="password" placeholder="Confirmar contraseña" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" required>
                    <label for="password_confirmation">@lang('authentication.register.confirm-password')</label>
                    @if ($errors->has('password_confirmation'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-check mb-4 pb-2">
                    <input type="checkbox" name="acepto_terminos" id="acepto_terminos" class="form-check-input" value="1" required {{ (! empty(old('acepto_terminos')) ? 'checked' : '') }}>
                    <label for="acepto_terminos"><span class="custom-control-description">@lang('authentication.register.terms-and-conditions-part1')<a href="/download/Terminos.pdf" class="text-info m-l-5" target="_blank"><b>@lang('authentication.register.terms-and-conditions-part2')</b></a></span></label>
                </div>
                <div class="d-flex align-items-stretch button-group">
                    <button type="submit" class="btn btn-info btn-lg px-4">@lang('authentication.register.register')</button>
                    <a href="{{ url('/') }}" id="to-login2" class="btn btn-lg btn-light-secondary text-secondary font-weight-medium">@lang('authentication.register.back')</a>
                </div>
            </form>
        </div>
    </div>

@endsection
