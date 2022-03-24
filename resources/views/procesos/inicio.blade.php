@extends('app.master')

@section('scripts')
    <script src="{{ asset('js/agregar_quitar_favoritos.js') }}" ></script>
    <script src="{{ asset('js/funcionalidad_finalizar_proceso.js') }}"></script>
    @include('components.datatable',['table_name' => 'tabla_inicio'])
@endsection
@section('style')
    <link href="{{ asset('monster/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('where-am-i')
    @include('components.where-am-i',[
    'ubicacion_actual' => __('components.home')
    ])
@endsection
@section('content')
    @if (session('verified'))
        @include('email-confirmated')
    @endif
    <div class="row">
        <div class="card col-12">
            <div class="card-block">
                @include('components.title',['title' => __('proceso.title-current-publications')])
                @include('procesos.listado-publicaciones', ['publicaciones' => $activas, 'actions' => ['view', 'favoritos']])
            </div>
        </div>
    </div>
@endsection
