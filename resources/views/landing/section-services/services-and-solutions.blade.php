<!-- START SECTION SERVICES -->
<section class="small_pb">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 offset-lg-2 col-md-12 col-sm-12">
                <div class="title_default_dark title_border text-center">
                    <h4 class="animation" data-animation="fadeInUp" data-animation-delay="0.2s">@lang('landing.services.section-services.services-and-solutions')</h4>
                </div>
            </div>
        </div>
        <div class="row">
            @include('landing.section-services.service',[
                'number' => 1,
                'title' => __('landing.services.section-services.services.service1.title'),
                'description' => __('landing.services.section-services.services.service1.description')
            ])

            @include('landing.section-services.service',[
                'number' => 2,
                'title' => __('landing.services.section-services.services.service2.title'),
                'description' => __('landing.services.section-services.services.service2.description')
            ])

            @include('landing.section-services.service',[
                'number' => 3,
                'title' => __('landing.services.section-services.services.service3.title'),
                'description' => __('landing.services.section-services.services.service3.description')
            ])

            @include('landing.section-services.service',[
                'number' => 4,
                'title' => __('landing.services.section-services.services.service4.title'),
                'description' => __('landing.services.section-services.services.service4.description'),
                'class' => 'offset-lg-2'
            ])

            @include('landing.section-services.service',[
                'number' => 5,
                'title' => __('landing.services.section-services.services.service5.title'),
                'description' => __('landing.services.section-services.services.service5.description')
            ])

        </div>
    </div>
</section>
<!-- END SECTION SERVICES -->



