<section id="news" class="gradient_box2" data-bleed="-40" data-z-index="1" data-parallax="scroll">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 offset-lg-2">
                <div class="title_default_light title_border text-center">
                    <h4 class="animation animated fadeInUp" data-animation="fadeInUp" data-animation-delay="0.2s" style="animation-delay: 0.2s; opacity: 1;">{{ __('landing.news.title') }}</h4>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach(Lang::get('landing.news.list') as $key => $element)
                @include('landing.section-news.new',[
                    'number' => $key,
                    'title' => __("landing.news.list.{$key}.title"),
                    'description' => __("landing.news.list.{$key}.description"),
                    'url' => __("landing.news.list.{$key}.url"),
                    'date' => __("landing.news.list.{$key}.date")
                ])
            @endforeach

        </div>
    </div>
</section>
