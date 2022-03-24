@extends('app.master')

@section('scripts')
    <script src="{{ asset('js/procesos/view.js') }}" ></script>
    @include('scripts.feature-ask')
    @include('scripts.feature-offer')
    <script src="{{ asset('js/procesos/funcionalidad_countdown.js') }}" ></script>
    <script>
        $(function () {
            generarCountDownDate("{{ $proceso->fecha_completa_finalizacion }}","demo");
            // initDtItemsPropios();
            // initDtItemsNoPropios();
        });
    </script>

@endsection

@section('where-am-i')
    @include('components.where-am-i',[
    'ubicacion_actual' => __('proceso.detail-auction.details-of-the-publication')
    ])
@endsection

@section('content')

    <input type="hidden" id="proceso_id" name="proceso_id" value="{{$proceso->id}}" />

    @include('procesos.view.detail-publication')

    <div class="card col-12">
        <div class="card-block">
            <div class="card-header bg-info  d-flex align-items-center">
                <h4 class="card-title text-white">
                    <i class="ti-layout-list-thumb"></i>
                    @lang('proceso.detail-auction.requested-items')
                </h4>
            </div>
            @if($proceso->esProcesoPropio())
                @include('procesos.list-items-proceso-own', ['items' => $proceso->items])
            @else
                @include('procesos.list-items-not-own-process', ['items' => $proceso->items])
            @endif

            @if (! $proceso->esProcesoPropio() && $proceso->puedeOfertarPorAlgunItem() && !$proceso->estaFinalizado())
                @include('procesos.button-offer')
            @endif

        </div>
    </div>
    @if((!$proceso->estaFinalizado()) || ($proceso->estaFinalizado() && $proceso->preguntas->IsNotEmpty()))
        @include('questions.questions-publications',['preguntas' => $proceso->preguntas])
    @endif



@endsection
