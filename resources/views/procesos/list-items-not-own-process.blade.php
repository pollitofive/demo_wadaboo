<div class="card col-12">
    <div class="card-block">
        <div class="table-responsive">
            <table id="TablaItemsNoPropios" class="table table-bordered table-striped" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th class="noVis">@lang('proceso.auction') #</th>
                    <th class="noVis">@lang('proceso.product-service')</th>
                    <th>@lang('proceso.subcategory')</th>
                    <th>@lang('proceso.modal-qualify.quantity')</th>
                    <th>@lang('proceso.unit')</th>
                    <th class="noVis">@lang('proceso.end')</th>
                    <th class="noVis">@lang('proceso.best-offer')</th>
                    <th class="noVis">@lang('proceso.sub-total')</th>
                    <th class="noVis">@lang('proceso.your-offer')</th>
                    @if(isset($actions))
                        <th class="noVis">@lang('proceso.actions')</th>
                    @endif

                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td><a href="{{route("procesos.view",$item->proceso->id)}}">#{{$item->proceso->id}}</a></td>
                        <td>{{ $item->nombre }}</td>
                        <td><small>{{ $item->subcategoria->name }}</small></td>
                        <td><small>{{ $item->cantidad }}</small></td>
                        <td><small>{{ trans('unidades')[$item->unidad] }}</small></td>
                        <td><small>{{ $item->proceso->fecha_hora_fin }}</small></td>
                        @if($item->mejor_oferta)
                            <td><small>{{ $item->mejor_oferta }}</small></td>
                            <td><small>{{ $item->mejor_oferta * $item->cantidad}}</small></td>
                        @else
                            <td><small>@lang('proceso.without-offers')</small></td>
                            <td><small>-</small></td>
                        @endif
                        <td>
                            @include('procesos.functionality-offer')
                        </td>
                        @if(isset($actions))
                            <td>
                                @foreach($actions as $action)
                                    @if ($action == 'eliminar_oferta')
                                        <button id="eliminar_oferta_{{ $item->id }}" data-id="{{ $item->id }}" class="btn btn-danger btn-circle btn-sm d-inline-flex align-items-center justify-content-center eliminar" data-bs-toggle="tooltip" data-toggle="tooltip" data-animation="false"  data-bs-placement="top" data-bs-original-title="@lang('proceso.buttons.delete-offer')">
                                            @include('icons.trash')
                                        </button>
                                    @endif
                                @endforeach

                            </td>
                        @endif
                    </tr>

                @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>

