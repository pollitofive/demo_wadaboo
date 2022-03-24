<div class="card">
    <div class="card-header bg-info  d-flex align-items-center">
        <h4 class="card-title text-white">
            @include('icons.award')
            @lang('posters.auctions.general-information-about.general-information-about-your-purchase')
        </h4>
        <div class="card-actions ms-auto d-flex button-group">
            <a class="link d-flex text-white align-items-center" data-action="collapse"><i class="ti-minus"></i></a>
            <a class="mb-0 link d-flex text-white align-items-center pe-0" data-action="close">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x feather-sm"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </a>
        </div>
    </div>
    <div class="card-body collapse show">
        <h4 class="card-title">
            <li>@lang('posters.auctions.general-information-about.the-publication-will-have')</li>
            <li>@lang('posters.auctions.general-information-about.you-will-be-able-to-specify')</li>
            <li>@lang('posters.auctions.general-information-about.dont-forget-to-clarify')</li>
        </h4>
    </div>
</div>

