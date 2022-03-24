<div class="user-profile text-center position-relative pt-4 mt-1">
    <div class="profile-img m-auto">
        <img src="{{ asset(auth()->user()->url_to_image) }}" alt="user" class="w-100 rounded-circle" />
    </div>
    <!-- User profile text-->
    <div class="profile-text py-1">
        <a href="#" class="dropdown-toggle link u-dropdown" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">{{ auth()->user()->getNombreByTipoUsuario() }}<span class="caret"></span>
        </a>
        <div class="dropdown-menu animated flipInY">
            <a class="dropdown-item" href="{{ route('my-accounts-settings') }}">
                <i data-feather="settings" class="feather-sm text-warning me-1 ms-1"></i> @lang('app.menu.profile.configuration')
            </a>
            <a class="dropdown-item" href="{{ route('change-password') }}">
                <i data-feather="credit-card" class="feather-sm text-info me-1 ms-1"></i> @lang('app.menu.profile.change-password')
            </a>
            <a class="dropdown-item" href="{{ route('alerts') }}">
                <i data-feather="mail" class="feather-sm text-success me-1 ms-1"></i> @lang('app.menu.profile.alerts')
            </a>
        </div>
    </div>
</div>
