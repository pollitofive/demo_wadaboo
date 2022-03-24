<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="canonical" href="https://www.wrappixel.com/templates/monsteradmin/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{URL::to('/')}}/img/landing/favicon.png">
    <!-- Custom CSS -->
    <link href="{{ asset('monster/css/style.min.css') }}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="main-wrapper">
    @include('components.pre-loader')
    <div class="row auth-wrapper gx-0">
        @include('auth.left-information')
        <div class="col-lg-8 col-xl-9 d-flex align-items-center justify-content-center">
            <div class="row justify-content-center w-100 mt-4 mt-lg-0">
                <div class="col-lg-6 col-xl-3 col-md-7">
                    @yield('form')
                </div>
            </div>
        </div>
    </div>
    <!-- -------------------------------------------------------------- -->
    <!-- Login box.scss -->
    <!-- -------------------------------------------------------------- -->
</div>
<script src="{{ asset('monster/js/jquery.min.js') }}" ></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{ asset('monster/js/bootstrap.bundle.min.js') }}" ></script>
<script src="{{ asset('js/functions/hide-errors.js') }}" ></script>
<script src="{{ asset('js/functions/preloader.js') }}" ></script>
</body>

</html>
