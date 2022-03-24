@extends('app.master')
@section('scripts')
    <script src="{{ asset('js/procesos/calificar.js') }}" ></script>
    <script>
        $(function () {
            initDtTablaItemsResultados();
        });
    </script>
    @include('components.datatable',['table_name' => ['TablaItemsNoPropios','tablaListadoItemsDatosComprador']])

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

    @include('procesos.view.detail-publication',['proceso' => $proceso_finalizado->first()->proceso])

    <div class="card-body">
        <div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link d-flex active" data-bs-toggle="tab" href="#items-ofertados" role="tab">
                        <span><i class="fas fa-list-ol"></i>
                        </span>
                        <span class="d-none d-md-block ms-2">@lang('proceso.see-only-the-items-offered')</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex" data-bs-toggle="tab" href="#items-todos" role="tab">
                        <span><i class="fas fa-list-ul"></i>
                        </span>
                        <span class="d-none d-md-block ms-2">@lang('proceso.see-all-items')</span>
                    </a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane p-3 active" id="items-ofertados" role="tabpanel">
                    @include('procesos.items-data-seller-list', ['finalizadas' => $proceso_finalizado, 'solo_ofertados' => true, 'actions' => ['calificar'] ])
                </div>
                <div class="tab-pane p-3" id="items-todos" role="tabpanel">
                    <table id="tablaListadoItemsDatosVendedor" class="ListadoItemsDatosVendedor table table-bordered table-striped" cellspacing="0" width="100%">
                        @include('components.header-table-data-seller-buyer-without-offers',['tipo' => __('proceso.seller')])
                        <tbody>
                            @foreach($proceso_finalizado->first()->proceso->items as $item)
                                <tr>
                                    <td>#{{$proceso_finalizado->first()->proceso->id}}</td>
                                    <td>{{ $item->nombre }}</td>
                                    <td><small>{{ $item->cantidad }}</small></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12 justify-content-end align-self-center d-none d-md-flex">
                <div class="d-flex">
                    <a href="{{ route("my-purchases") }}" class="btn pull-right hidden-sm-down btn-success">
                        @include('icons.arrow-left-circle')
                        @lang('proceso.buttons.back-to-my-purchases')
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
