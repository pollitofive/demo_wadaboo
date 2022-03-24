<!-- START SECTION BANNER -->
<section class="section_banner blue_light_bg banner_shape" data-z-index="1" data-bleed="-40" data-parallax="scroll" data-image-src="assets/images/home_banner_bg.png">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-12 col-sm-12 order-lg-first">
                <div class="banner_text text_md_center">

                    <h1 class="animation" data-animation="fadeInUp" data-animation-delay="1.1s">@lang('landing.start-banner.title')</h1>
                    <p class="animation" data-animation="fadeInUp" data-animation-delay="1.2s">@lang('landing.start-banner.subtitle')</p>
                    <div class="btn_group animation" data-animation="fadeInUp" data-animation-delay="1.3s">
                        <a href="{{ route('login') }}" class="btn btn-default">@lang('landing.start-banner.button-login') <i class="ion-ios-arrow-thin-right"></i></a>
                        <a href="{{ route('register') }}" class="btn btn-border">@lang('landing.start-banner.button-register') <i class="ion-ios-arrow-thin-right"></i></a>
                    </div>
                    <div id="whitepaper" class="team_pop mfp-hide">
                        <div class="row m-0">
                            <div class="col-md-5">
                                <img class="pt-3 pb-3" src="{{URL::to('/')}}assets/img/landing/whitepaper.png" alt="whitepaper"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 order-first">
                <div class="banner_image_right res_md_mb_50 res_xs_mb_20 animation" data-animation-delay="1.5s" data-animation="fadeInRight">
                    <img alt="banner_vector1" src="{{URL::to('/')}}/img/landing/start-banner.png">
                </div>
            </div>
        </div>
        <div class="divider small_divider"></div>
        @include('landing.section-start-banner.numbers')
    </div>
    <div class="angle_bottom"></div>
</section>
<!-- END SECTION BANNER -->
