@extends('landing.landing')

@section('content')
    <section class="section_breadcrumb blue_light_bg" data-z-index="1" data-parallax="scroll" data-image-src="assets/images/home_banner_bg.png">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="banner_text text-center">
                        <h1 class="animation" data-animation="fadeInUp" data-animation-delay="1.1s">@lang('landing.services.title')</h1>
                        <ul class="breadcrumb bg-transparent justify-content-center animation m-0 p-0" data-animation="fadeInUp" data-animation-delay="1.3s">
                            <li><a href="{{ url('/') }}">@lang('landing.section-home')</a> </li>
                            <li><span>@lang('landing.services.title')</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('landing.section-services.services-and-solutions')

    @include('landing.section-services.services')

    <section class="small_pt small_pb">
        <div class="row">
            <div class="col-lg-5 col-md-2 offset-lg-5">
                <div class="video_box animation" data-animation="fadeInRight" data-animation-delay="0.2s">
                    <a href="https://www.youtube.com/watch?v=FWwcHsmWryk" class="btn btn-primary video animation animated fadeInUp" data-animation="fadeInUp" data-animation-delay="1s" style="animation-delay: 1s; opacity: 1;"><span class="ion-play"></span>@lang('landing.services.section-services.button-lets-started')  </a>
                </div>
            </div>
        </div>
    </section>

    @include('landing.section-faq.faq')

@endsection





