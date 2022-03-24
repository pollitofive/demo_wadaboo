@extends('app.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body border-bottom">
                    <h4 class="card-title">{{ __('authentication.change-password.title') }}</h4>
                </div>
                <form class="form-horizontal" method="POST" action="{{ route('change-password') }}">
                    @csrf
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-3 text-end control-label col-form-label">{{ __('authentication.change-password.old-password') }}</label>
                            <div class="col-sm-9">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{__('authentication.change-password.old-password-placeholder') }}" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="new_password" class="col-sm-3 text-end control-label col-form-label">{{ __('authentication.change-password.new-password') }}</label>
                            <div class="col-sm-9">
                                <input id="new_password" type="password" class="form-control{{ $errors->has('new_password') ? ' is-invalid' : '' }}" name="new_password"  placeholder="{{__('authentication.change-password.new-password-placeholder') }}"  required>
                                @if ($errors->has('new_password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('new_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="new_password_confirmation" class="col-sm-3 text-end control-label col-form-label">{{ __('authentication.change-password.confirmation-password') }}</label>
                            <div class="col-sm-9">
                                <input id="new_password-confirm" type="password" class="form-control" name="new_password_confirmation" placeholder="{{ __('authentication.change-password.confirmation-password-placeholder') }}" required>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('authentication.change-password.title') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
