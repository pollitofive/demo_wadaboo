<div class="col-lg-4 col-md-6">
    <div class="blog_item animation animated fadeInUp" data-animation="fadeInUp" data-animation-delay="0.2s" style="animation-delay: 0.2s; opacity: 1;">
        <div class="blog_content">
            <div class="blog_text">
                <h6 class="blog_title"><a href="{{ $url }}" target="_blank">{{ $title }}</a></h6>
                <p>{{ $description }}</p>
                <a href="{{ $url }}" target="_blank" class="text-capitalize">{{ __('landing.news.button-read-more') }}</a>
            </div>
            <ul class="list_none blog_meta">
                <li><a href="{{ $url }}" target="_blank"><i class="ion-android-time"></i> {{ $date }}</a></li>
                <li></li>
            </ul>
        </div>
    </div>
</div>
