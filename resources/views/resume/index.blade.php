@extends('app.master')

@section('vue')
<script>
    vm = new Vue({
        el: '#resumen',
        data: {
            mes: "{{ $mes_seleccionado }}",
            anio: "{{ $anio_seleccionado }}",
        },
        methods: {
            buscar: function()
            {
                location.href = "{{ route("resume") }}/"+this.mes+"/"+this.anio;
            }
        }
    });

    $(function(){

        $(".meses li a").click(function(){

            $("#btnMeses:first-child").text($(this).text());
            $("#btnMeses:first-child").val($(this).text());
            vm.mes = $(this).attr('data-mes');
        });

        $(".anios li a").click(function(){

            $("#btnAnios:first-child").text($(this).text());
            $("#btnAnios:first-child").val($(this).text());
            vm.anio = $(this).attr('data-anio');

        });

    });

</script>
@endsection

@section('where-am-i')
    @include('components.where-am-i',[
    'ubicacion_actual' => __('resume.resume')
    ])
@endsection

@section('content')
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100" id="resumen">
            <div class="card-body">
                <div class="d-md-flex no-block">
                    <div>
                        <h4 class="card-title">@lang('resume.sales-summary')</h4>
                    </div>
                    <div class="ms-auto">
                        <div class="d-flex">
                            <div class="dropdown me-2">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="btnMeses" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ $meses[$mes_seleccionado] }}
                                </button>
                                <ul class="dropdown-menu meses" aria-labelledby="dropdownMenuButton">
                                    @foreach($meses as $key => $mes)
                                        <li><a class="dropdown-item" href="#" data-mes="{{ $key }}">{{ $mes }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="dropdown me-2">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="btnAnios" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ $anios[$anio_seleccionado] }}
                                </button>
                                <ul class="dropdown-menu anios" aria-labelledby="dropdownMenuButton">
                                    @foreach($anios as $key => $anio)
                                        <li><a class="dropdown-item" href="#" data-anio="{{ $key }}">{{ $anio }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <button @click="buscar()" class="btn pull-right hidden-sm-down btn-success">@lang('resume.search')</button>
                        </div>

                    </div>
                </div>
            </div>
            <div class="card-body bg-light">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="mb-0">@lang('resume.report-of-the-month') <u><strong>{{ $meses[$mes_seleccionado] }} {{ $anio_seleccionado }}</strong></u></h2>
                        <div class="col-md-12 align-self-center display-6 text-info text-start text-md-end" style="margin-top: -30px">${{ $procesos_finalizados->sum('valor_total') }}</div>
                    </div>
                </div>
            </div>
            <div class="table-responsive m-t-40">
                @include('resume.list')
            </div>
        </div>
    </div>
    @include('resume.cards')
@endsection
