@extends('auth.authentication')

@section('form')
    <div class="card" id="recover">
        <div class="card-body">
            <div class="logo">
                <h3>@lang('authentication.recover-password.recover-password')</h3>
                <p class="text-muted fs-4">@lang('authentication.recover-password.instructions')</p>
            </div>
            <div class="mt-4 pt-4">
                <!-- Form -->
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <!-- email -->
                    <div class="mb-4 pb-2">
                        <div class="form-floating">
                            <input id="email" type="text"  placeholder="Email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"  required >
                            <label for="email">@lang('authentication.register.email')</label>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                    </div>
                    <div class="d-flex align-items-stretch button-group">
                        <button type="submit" class="btn btn-info btn-lg px-4">@lang('authentication.recover-password.submit')</button>
                        <a href="{{ url('/') }}" id="to-login2" class="btn btn-lg btn-light-secondary text-secondary font-weight-medium">@lang('authentication.register.back')</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
