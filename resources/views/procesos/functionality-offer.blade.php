@if(!$item->proceso->estaFinalizado() && !$item->soyGanador())
    <div class="controls">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">$</span>
            </div>
            <input type="text" class="form-control ofertar" id="text_item_{{$item->id}}" data-content="{{ $item->id }}" style="width: 75px" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Ingresa tu oferta"  />
        </div>
        @if($item->tengoOfertaPrevia() && !$item->soyGanador())
            <span class="badge bg-light-warning text-info mb-3">@lang('proceso.your-offer-was-beaten')</span>
        @endif
    </div>
@elseif(!$item->proceso->estaFinalizado() && $item->soyGanador())
    <span class="badge bg-light-info text-info mb-3">@lang('proceso.winning')</span>
@elseif($item->proceso->estaFinalizado())
    @if($item->ganoLaSubasta())
        <span class="badge bg-light-success text-info mb-3">@lang('proceso.you-won')</span>
    @elseif($item->realizoOferta())
        <small class="label label-danger" style="display: inline-block;" data-toggle="tooltip" title="Tu oferta fue de ${{ optional($item->realizoOferta())->oferta }}">
            @lang('proceso.you-lost')
        </small>
    @else
        <span class="badge bg-light-info text-info mb-3">@lang('proceso.without-offers')</span>
    @endif
@endif
