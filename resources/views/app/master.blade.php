<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@lang('app.title')</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/monsteradmin/" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{URL::to('/')}}/img/landing/favicon.png">
    <link href="{{ asset('monster/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('monster/css/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('monster/css/sweetalert2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('monster/css/bootstrap-switch.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../assets/libs/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css">
    <link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <style>

    </style>
    @yield('style')

</head>

<body>
@include('components.pre-loader')
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">
    @include('app.menu.menu')
    <div class="page-wrapper" style="margin-top: 0px; padding-top: 0">
        @yield('where-am-i')
        <div class="container-fluid" id="app" style="min-height: calc(120vh - 180px);">
            @include('components.flash-message')
            @yield('content')
        </div>
        @include('app.footer')
    <!-- ============================================================== -->
        <!-- customizer Panel -->
        <!-- ============================================================== -->

    </div>

</div>
@include('app.notifications')
@include('app.scripts')
@yield("scripts")
@yield('vue')
@yield('flash-message')
</body>

</html>
