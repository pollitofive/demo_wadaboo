@extends('app.master')

@section('scripts')
    <script src="{{ asset('js/categorias_change.js') }}" ></script>
    <script src="{{ asset('js/functions/update-tooltip.js') }}" ></script>
    <style>
        .fade-enter-active, .fade-leave-active {
            transition: opacity .5s;
        }
        .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
            opacity: 0;
        }
    </style>
    @include('procesos.form.scripts')
@endsection

@section('style')
@endsection

@section('where-am-i')
    @include('components.where-am-i',[
    'ubicacion_actual' => __('components.create-publicacion'),
    'sin_crear' => true
    ])
@endsection

@section('content')
    @include('posters.auctions.general-information-about-your-purchase')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-info  d-flex align-items-center">
                    <h4 class="card-title text-white">
                        @include('icons.layers')
                        @lang('proceso.create-edit-auction.publication-details')
                    </h4>
                </div>
                <div class="card-body">
                    @include('procesos.form.auction-form')
                </div> <!-- /paso 1 -->
            </div>
        </div>
    </div>
    @include('posters.auctions.what-do-you-need-to-buy')

    <div class="col-md-12 justify-content-end align-self-center d-none d-md-flex mb-3">
        <div class="d-flex">
            <button class="pull-right btn waves-effect waves-light btn-rounded btn-primary" id="agregarItem" :disabled="haCargado15Items" data-bs-target="#form-item"  data-bs-toggle="modal">
                @include('icons.plus-square')
                @lang('proceso.create-edit-auction.add-item')
            </button>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-dark-danger d-flex align-items-center">
            <h4 class="card-title text-white">
                @include('icons.tv')
                @lang('proceso.create-edit-auction.preview')
            </h4>
        </div>
        <div class="card-body">
            @include('procesos.form.list-items')
        </div> <!-- /paso 1 -->
    </div>

    @include('procesos.form.modal')
    <div class="col-md-12 justify-content-end align-self-center d-none d-md-flex">
        <div class="d-flex">
            <button id="publicar" @click.prevent="guardar()" class="pull-right btn waves-effect waves-light btn-rounded btn-primary" type="button">
                @include('icons.save')
                @lang('proceso.create-edit-auction.save')!
            </button>
        </div>
    </div>

@endsection
