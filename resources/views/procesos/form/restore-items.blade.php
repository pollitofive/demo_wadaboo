@extends("app.master")
@section("scripts")
    <script src="{{ asset('js/categorias_change.js') }}" ></script>
    {{--<script src="{{ asset('js/procesos/create.js') }}" ></script>--}}


@endsection

@section("content")
    <div class="col-md-12 col-xl-2 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-header bg-secondary">
                <h4 class="mb-0 text-white">@lang('proceso.continue-publication.you-have-unfinished-publications')</h4>
            </div>
            <div class="card-body">
                <h3 class="card-text">@lang('proceso.continue-publication.you-can-continue-it-or-start-a-publication')</h3>
                <div class="col-md-12 justify-content-end align-self-center d-none d-md-flex">
                    <div class="d-flex">
                        <a href="{{ route("eliminar_borrador",$proceso->id) }}">
                            <button id="NuevaPublicacion" class="pull-right btn waves-effect waves-light btn-rounded btn-info" type="button">
                                @include('icons.plus')
                                @lang('proceso.new-publication')
                            </button>
                        </a>
                        <a href="{{ route("edit-publication",$proceso->id) }}">
                            <button id="ContinuarPublicacion" class="pull-right btn waves-effect waves-light btn-rounded btn-success" type="button">
                                @include('icons.rotate-ccw')
                                @lang('common.buttons.continue')
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('procesos.form.list-items')

@endsection
@section('vue')

    <script>

        var vm = new Vue({
            el: '#app',
            data: {
                items: [],
                solo_ver: true,
            }
        });
        vm.items = JSON.parse(@json($proceso->items->toJson()));
    </script>

@endsection
