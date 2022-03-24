<div class="col-lg-4 col-md-6 col-sm-12 {{ (isset($class)) ? $class : '' }}">
    <div class="box_wrap bg-white text-center animation" data-animation="fadeInUp" data-animation-delay="0.6s" style="height: 350px">
        <div class="rounded_border_icon blue_light_bg">
            <img src="{{URL::to('/')}}/img/landing/service_icon{{ $number }}.png" alt="service_icon1"/>
        </div>
        <h4>{{ $title }}</h4>
        <p>{{ $description }}</p>
    </div>
</div>
