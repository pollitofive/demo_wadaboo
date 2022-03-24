@extends('landing.landing')

@section('content')
    <section class="section_breadcrumb blue_light_bg" data-z-index="1" data-parallax="scroll" data-image-src="assets/images/home_banner_bg.png">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="banner_text text-center">
                        <h1 class="animation" data-animation="fadeInUp" data-animation-delay="1.1s">Token</h1>
                        <ul class="breadcrumb bg-transparent justify-content-center animation m-0 p-0" data-animation="fadeInUp" data-animation-delay="1.3s">
                            <li><a href="{{ url('/') }}">@lang('landing.section-home')</a> </li>
                            <li><span>Token</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('landing.section-token.token')

@endsection





