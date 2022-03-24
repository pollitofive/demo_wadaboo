<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="WADABOO- Sistema de compas" />
    <!-- SITE TITLE -->
    @include('landing.title')
    <!-- Favicon Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{URL::to('/')}}/img/landing/favicon.png">
    <!-- Animation CSS -->
    @include('landing.css')
</head>

<body class="bg_light">
@include('components.chat-facebook')
<!-- START LOADER -->
<div id="loader-wrapper">
    <div id="loading-center-absolute">
        <div class="object" id="object_four"></div>
        <div class="object" id="object_three"></div>
        <div class="object" id="object_two"></div>
        <div class="object" id="object_one"></div>
    </div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>

</div>
<!-- END LOADER -->

@include('landing.header')

@yield('content')

@include('landing.footer')

<a href="#" class="scrollup btn-default"><i class="ion-ios-arrow-up"></i></a>

@include('landing.scripts')
</body>
</html>
