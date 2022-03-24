<div class="card">
    <div class="card-header bg-dark-danger d-flex align-items-center">
        <h4 class="card-title text-white">
            @include('icons.shopping-cart')
            @lang('posters.auctions.what-do-you-need-to-buy.what-do-you')
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
            <li>@lang('posters.auctions.what-do-you-need-to-buy.you-can-add')</li>
            <li>@lang('posters.auctions.what-do-you-need-to-buy.specify-the-details')</li>
            <li>@lang('posters.auctions.what-do-you-need-to-buy.when-you-are-ready')</li>
        </h4>
    </div>
</div>
