<!-- START HEADER -->
<header class="header_wrap fixed-top">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand animation" href="{{ url('/') }}" data-animation="fadeInDown" data-animation-delay="1s">
                <img class="logo_light" src="{{URL::to('/')}}/img/landing/logo.png" alt="logo" />
                <img class="logo_dark" src="{{URL::to('/')}}/img/landing/logo_dark.png" alt="logo" />
            </a>
            <button class="navbar-toggler animation" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" data-animation="fadeInDown" data-animation-delay="1.1s">
                <span class="ion-android-menu"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav m-auto">
                    <li class="animation" data-animation="fadeInDown" data-animation-delay="1.2s"><a class="nav-link nav_item" href="{{ route('about') }}">@lang('landing.header.about')</a></li>
                    <li class="animation" data-animation="fadeInDown" data-animation-delay="1.2s"><a class="nav-link nav_item" href="{{ route('service') }}">@lang('landing.header.service')</a></li>
                    <li class="animation" data-animation="fadeInDown" data-animation-delay="1.2s"><a class="nav-link nav_item" href="{{ route('price') }}">@lang('landing.header.price')</a></li>
{{--                    <li class="animation" data-animation="fadeInDown" data-animation-delay="1.2s"><a class="nav-link nav_item" href="#">Blog</a></li>--}}
                    <li class="animation" data-animation="fadeInDown" data-animation-delay="1.2s"><a class="nav-link nav_item" href="{{ route('faq') }}">@lang('landing.header.faq')</a></li>
                    <li class="animation" data-animation="fadeInDown" data-animation-delay="1.2s"><a class="nav-link nav_item" href="{{ route('news') }}">@lang('landing.header.news')</a></li>
                </ul>
                <ul class="navbar-nav nav_btn align-items-center">
                    <li class="animation" data-animation="fadeInDown" data-animation-delay="2s">
                        <select name="countries" id="lng_select2" style="background-color: inherit;color: white;cursor: pointer;width: 75px;border: 0;">
                            <option value="es" {{ (\App::getLocale() == 'es') ? 'selected' : '' }} style="background-color: #5957CD">ES</option>
                            <option value="en" {{ (\App::getLocale() == 'en') ? 'selected' : '' }} style="background-color: #5957CD">EN</option>
                        </select>
                    </li>
                    <li class="animation" data-animation="fadeInDown" data-animation-delay="1.8s"><a class="btn btn-default nav_item" href="{{ route('register') }}">@lang('landing.header.button-register')</a></li>
                    <li class="animation" data-animation="fadeInDown" data-animation-delay="1.8s"><a class="btn btn-default nav_item" href="{{ route('login') }}">@lang('landing.header.button-login')</a></li>
                </ul>
            </div>
        </nav>
    </div>
</header>
<!-- END HEADER -->
