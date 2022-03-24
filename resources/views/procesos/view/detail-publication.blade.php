<div class="col-lg-12 d-flex align-items-stretch">
    <div class="card w-100">
        <div class="card-header bg-info  d-flex align-items-center">
            <h4 class="card-title text-white">
                <i class="ti-info-alt"></i>
                @lang('proceso.detail-auction.details-of-the-publication') <span class="font-weight-medium">{{ $proceso->titulo }}</span>
            </h4>
        </div>
        <div class="card-body">
            <div class="mt-4">
                <div class="row">
                    @include('components.card-information',['class' => 'bg-inverse','icon' => 'fas fa-calendar-check','title' => __('proceso.detail-auction.the-auction-will-finish'),'description' => "$proceso->fecha_inicio ". __('proceso.detail-auction.at') ." $proceso->hora_inicio"])
                    @include('components.card-information',['class' => 'bg-cyan','icon' => 'ti-truck','title' => __('proceso.detail-auction.requests-delivery-for-the'),'description' => $proceso->fecha_entrega])
                    @include('components.card-information',['class' => 'bg-orange','icon' => 'ti-credit-card','title' => __('proceso.detail-auction.payment-preference'),'description' => trans('preferencias-pago')[$proceso->preferencia_pago]])
                </div>
                <div class="row">
                @if($proceso->localidad_id)
                    @include('components.card-information',['class' => 'bg-info','icon' => 'ti-location-pin','title' => __('proceso.detail-auction.place-of-dispatch'),'description' => $proceso->localidad->nombre . " - " .$proceso->localidad->provincia->nombre])
                @endif
                @include('components.card-information',['class' => 'bg-success','icon' => 'ti-alarm-clock','title' => __('proceso.detail-auction.time-remaining'),'description' => $proceso->tiempo_finalizacion])
                @include('components.card-information',['class' => 'bg-secondary','icon' => 'ti-alert','title' => __('proceso.detail-auction.offer-unit-prices'),'description' => __('proceso.detail-auction.vat-excluded')])
                </div>
                @if(!empty($proceso->detalles))
                    <div class="row">
                        @include('components.card-information',['class' => 'bg-primary','icon' => 'ti-notepad','title' => __('proceso.detail-auction.details-to-consider'),'description' => $proceso->detalles,'size' => 12])
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

