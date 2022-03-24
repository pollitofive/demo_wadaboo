@extends('app.master')
@section('scripts')
    @include('scripts.feature-finish-publication')
    @include('scripts.feature-ask')
    <script src="{{ asset('js/procesos/calificar.js') }}" ></script>
    <script src="{{ asset('monster/js/prism.js') }}" ></script>
    @include('components.datatable',['table_name' => ['tabla_inicio','tabla_finalizados']])

@endsection

@section('style')
    <link href="{{ asset('monster/css/prism.css') }}" rel="stylesheet">
    <link href="{{ asset('monster/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('where-am-i')
    @include('components.where-am-i',[
    'ubicacion_actual' => __('components.purchases')
    ])
@endsection

@section('content')
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link d-flex {{  $mostrar_finalizadas === false ? "active" : "" }}" data-bs-toggle="tab" href="#in-progress" role="tab">
            <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart feather-sm"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
            </span>
                <span class="d-none d-md-block ms-2">@lang('proceso.my-purchases.in-progress')</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex {{  $mostrar_finalizadas === true  ? "active" : "" }}" data-bs-toggle="tab" href="#finished" role="tab">
            <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle feather-sm"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
            </span>
                <span class="d-none d-md-block ms-2">@lang('proceso.my-purchases.finished')</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex" data-bs-toggle="tab" href="#questions" role="tab">
            <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-inbox feather-sm"><polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline><path d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path></svg>
            </span>
                <span class="d-none d-md-block ms-2">@lang('proceso.my-purchases.questions-asked')</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex" data-bs-toggle="tab" href="#qualify-operations" role="tab">
            <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-award feather-sm"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
            </span>
                <span class="d-none d-md-block ms-2">@lang('proceso.my-purchases.qualify-operations')</span>
            </a>
        </li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane active" id="in-progress" role="tabpanel">
            <div class="p-3">
                @include('posters.my-purchases.follow-your-offers')
                @include('procesos.listado-publicaciones', ['publicaciones' => $activas, 'actions' => ['view', 'edit', 'eliminar']])
            </div>
        </div>
        <div class="tab-pane  p-3" id="finished" role="tabpanel">
            @include('posters.my-purchases.look-at-your-finalised-publications')
            @include('procesos.listado-publicaciones', ['table_name' => 'tabla_finalizados','publicaciones' => $finalizadas, 'actions' => ['resultados']])
        </div>
        <div class="tab-pane p-3" id="questions" role="tabpanel">
            @include('questions.div-questions-list')
        </div>
        <div class="tab-pane p-3" id="qualify-operations" role="tabpanel">
            @include('posters.auction-qualifications')
            @include('procesos.items-data-seller-list', ['finalizadas' => $publicaciones_calificables,'actions' => ['calificar']])
{{--            @include('components.modal-item-qualify-operation',['tipo' => 'Comprador'])--}}
        </div>
    </div>
@endsection
