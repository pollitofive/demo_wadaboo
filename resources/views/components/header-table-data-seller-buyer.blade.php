<thead>
<tr>
    <th class="noVis">@lang('proceso.auction') #</th>
    <th class="noVis">@lang('proceso.product-service')</th>
    <th class="noVis">@lang('proceso.quantity-items')</th>
    <th>@lang('proceso.price')</th>
    <th>@lang('proceso.sub-total')</th>
    <th class="noVis">{{ $tipo }} @lang('proceso.name')</th>
    <th>@lang('proceso.buyer-type')</th>
    <th class="noVis">@lang('proceso.email')</th>
    <th class="noVis">@lang('proceso.phone')</th>
    @if(isset($actions))
        <th class="noVis">@lang('proceso.actions')</th>
    @endif
</tr>
</thead>
