@extends('landing.landing')

@section('content')
    <section class="section_breadcrumb blue_light_bg" data-z-index="1" data-parallax="scroll" data-image-src="assets/images/home_banner_bg.png">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="banner_text text-center">
                        <h1 class="animation" data-animation="fadeInUp" data-animation-delay="1.1s">@lang('landing.about.title')</h1>
                        <ul class="breadcrumb bg-transparent justify-content-center animation m-0 p-0" data-animation="fadeInUp" data-animation-delay="1.3s">
                            <li><a href="{{ url('/') }}">@lang('landing.section-home')</a> </li>
                            <li><span>@lang('landing.about.title')</span></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- END SECTION BANNER -->

    <!-- START SECTION ABOUT -->
    <section class="small_pb">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="res_md_mb_30 res_sm_mb_20">
                        <div class="title_default_dark title_border">
                            @include('landing.section-about.main-message')
                        </div>
                        <a href="https://www.youtube.com/watch?v=FWwcHsmWryk" class="btn btn-primary video animation" data-animation="fadeInUp" data-animation-delay="1s"><span class="ion-play"></span>@lang('landing.about.section-about.lets-start')</a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="text-center">
                        <img class="animation" data-animation="zoomIn" data-animation-delay="0.2s" src="{{URL::to('/')}}/img/landing/about.png" alt="aboutimg2"/>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END SECTION ABOUT -->

    <!-- START SECTION WHY CHOOSE US -->
    <section class="small_pt">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 offset-lg-2 col-md-12 col-sm-12">
                    <div class="title_default_dark title_border text-center">
                        <h4 class="animation" data-animation="fadeInUp" data-animation-delay="0.2s">@lang('landing.about.section-about.why-choose-us.title')</h4>
                        <p class="animation" data-animation="fadeInUp" data-animation-delay="0.4s">@lang('landing.about.section-about.why-choose-us.description')</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="box_wrap radius_box bg-white text-center animation" data-animation="fadeInUp" data-animation-delay="0.6s">
                        <img src="{{URL::to('/')}}/img/landing/wc_icon1.png" alt="wc_icon1"/>
                        <h4>@lang('landing.about.section-about.why-choose-us.message1.title')</h4>
                        <p>@lang('landing.about.section-about.why-choose-us.message1.description')</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="box_wrap radius_box bg-white text-center animation" data-animation="fadeInUp" data-animation-delay="0.8s">
                        <img src="{{URL::to('/')}}/img/landing/wc_icon2.png" alt="wc_icon2"/>
                        <h4>@lang('landing.about.section-about.why-choose-us.message2.title')</h4>
                        <p>@lang('landing.about.section-about.why-choose-us.message2.description')</p>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-0 col-md-6 offset-md-3 col-sm-12">
                    <div class="box_wrap radius_box bg-white text-center animation" data-animation="fadeInUp" data-animation-delay="1s">
                        <img src="{{URL::to('/')}}/img/landing/wc_icon3.png" alt="wc_icon3"/>
                        <h4>@lang('landing.about.section-about.why-choose-us.message3.title')</h4>
                        <p>@lang('landing.about.section-about.why-choose-us.message3.description')</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END SECTION WHY CHOOSE US -->

    <!-- START SECTION COUNTER -->
    <section class="counter_wrap overlay background_bg counter_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="box_counter text-center res_sm_mb_20">
                        <i class="ion-ios-book animation" data-animation="fadeInUp" data-animation-delay="0.8s"></i>
                        <h3 class="counter animation" data-animation="fadeInUp" data-animation-delay="0.3s">155</h3>
                        <p class="animation" data-animation="fadeInUp" data-animation-delay="0.4s">@lang('landing.about.section-about.counters.subtitle1')</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="box_counter text-center res_sm_mb_20">
                        <i class="ion-ios-alarm animation" data-animation="fadeInUp" data-animation-delay="0.5s"></i>
                        <h3 class="counter animation" data-animation="fadeInUp" data-animation-delay="0.6s">5</h3>
                        <p class="animation" data-animation="fadeInUp" data-animation-delay="0.7s">@lang('landing.about.section-about.counters.subtitle2')</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="box_counter text-center res_xs_mb_20">
                        <i class="ion-android-contacts animation" data-animation="fadeInUp" data-animation-delay="1.1s"></i>
                        <h3 class="counter animation" data-animation="fadeInUp" data-animation-delay="0.9s">700</h3>
                        <p class="animation" data-animation="fadeInUp" data-animation-delay="1s">@lang('landing.about.section-about.counters.subtitle3')</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="box_counter text-center">
                        <i class="ion-ios-pie animation" data-animation="fadeInUp" data-animation-delay="0.2s"></i>
                        <h3 class="animation" data-animation="fadeInUp" data-animation-delay="1.2s" style="font-size: 40px;font-weight: 600;margin-top: 20px; color: white">15%</h3>
                        <p class="animation" data-animation="fadeInUp" data-animation-delay="1.3s">@lang('landing.about.section-about.counters.subtitle4')</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END SECTION COUNTER -->
    @include('landing.section-team.team')

    @include('landing.section-contact.contact')

    @include('landing.section-faq.faq')
@endsection
