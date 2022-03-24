<div class="col-lg-4 col-md-4">
    <div class="pricing_box text-center res_sm_mt_20">
        <div class="pr_title {{ $color }}">
            <h3>{{ $title }}</h3>
            <div class="price_tage">
                <h3>{{ $percent }}</h3>
            </div>
        </div>
        <div class="pr_content">
            <ul class="list_none">
                <li>{{ $description }}</li>
            </ul>
        </div>
        <div class="pr_footer">
            <a href="{{ route('register') }}" class="btn btn-default btn-radius">@lang('landing.header.button-register')</a>
        </div>
    </div>
</div>
