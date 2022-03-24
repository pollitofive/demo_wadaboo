@extends('landing.landing')

@section('content')
    <section class="section_breadcrumb blue_light_bg" data-z-index="1" data-parallax="scroll" data-image-src="assets/images/home_banner_bg.png">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="banner_text text-center">
                        <h1 class="animation" data-animation="fadeInUp" data-animation-delay="1.1s">@lang('landing.prices.section-prices.title')</h1>
                        <ul class="breadcrumb bg-transparent justify-content-center animation m-0 p-0" data-animation="fadeInUp" data-animation-delay="1.3s">
                            <li><a href="{{ url('/') }}">@lang('landing.section-home')</a> </li>
                            <li><span>@lang('landing.prices.section-prices.title')</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="small_pt">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 offset-lg-2 col-md-12 col-sm-12">
                    <div class="title_default_dark title_border text-center">
                        <h4>@lang('landing.prices.section-prices.title-description')</h4>
                        <p class="animation" data-animation="fadeInUp" data-animation-delay="0.4s">
                            @lang('landing.prices.section-prices.description')
                        </p>
                    </div>
                </div>
            </div>
            <div class="row small_space">
                @include('landing.section-price.card-price',[
                    'color' => 'blue_light_bg',
                    'title' => __('landing.prices.section-prices.sections.section1.title'),
                    'percent' => '4%',
                    'description' => __('landing.prices.section-prices.sections.section1.description')
                ])
                @include('landing.section-price.card-price',[
                    'color' => 'pink_bg',
                    'title' => __('landing.prices.section-prices.sections.section2.title'),
                    'percent' => '3.5%',
                    'description' => __('landing.prices.section-prices.sections.section2.description')
                ])
                @include('landing.section-price.card-price',[
                    'color' => 'yellow_bg',
                    'title' => __('landing.prices.section-prices.sections.section3.title'),
                    'percent' => '3%',
                    'description' => __('landing.prices.section-prices.sections.section3.description')
                ])
            </div>
        </div>
    </section>
@endsection





