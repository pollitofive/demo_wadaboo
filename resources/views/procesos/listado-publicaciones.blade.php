@csrf
<div class="card col-12">
    <div class="card-block">
        <div class="table-responsive">
            <table id="{{ ($table_name ?? 'tabla_inicio') }}" class="table table-bordered table-striped initDt" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>@lang('proceso.auction') #</th>
                    <th>@lang('proceso.title-reference')</th>
                    <th>@lang('proceso.details')</th>
                    <th>@lang('proceso.end')</th>
                    <th>@lang('proceso.delivery')</th>
                    <th>@lang('proceso.payment-reference')</th>
                    <th>@lang('proceso.quantity-items')</th>
                    <th>@lang('proceso.offers')</th>
                    <th style="text-align: center;width: 150px !important;">@lang('proceso.actions')</th>
                </tr>
                </thead>
                <tbody>
                @forelse($publicaciones as $publicacion)
                    <tr>
                        <td>#{{ $publicacion->id }}</td>
                        <td><a href="{{ route("procesos.view",$publicacion->id) }}" >{{ $publicacion->titulo }}</a></td>
                        <td>{{ $publicacion->detalles }}</td>
                        <td>{{ $publicacion->fecha_hora_fin }}</td>
                        <td>{{ $publicacion->fecha_entrega }}</td>
                        <td>{{ trans('preferencias-pago')[$publicacion->preferencia_pago] ?? '' }}</td>
                        @if(is_a($publicacion->items, 'Illuminate\Database\Eloquent\Collection'))
                            <td>{{ $publicacion->items->count() }}</td>
                        @else
                            <td></td>
                        @endif
                        <td>{{ $publicacion->cantidad_ofertas }}</td>
                        <td style="width: 155px !important;">
                            @if(isset($actions))
                                @foreach($actions as $action)
                                    @if ($action == 'view')
                                        <a href="{{ route("procesos.view",$publicacion->id) }}" class="btn btn-success btn-circle btn-sm d-inline-flex align-items-center justify-content-center" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="@lang('proceso.buttons.see-publication')">
                                            @include('icons.eye')
                                        </a>
                                    @endif
                                    @if ($action == 'edit')
                                        <a href="{{ route("edit-publication",$publicacion->id) }}" class="btn btn-info btn-circle btn-sm d-inline-flex align-items-center justify-content-center" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="@lang('proceso.buttons.edit-publication')">
                                            @include('icons.edit')
                                        </a>
                                    @endif
                                    @if ($action == 'resultados' && $publicacion->cantidad_ofertas > 0)
                                           <a href="{{ route("watch-results",$publicacion->id) }}" class="btn btn-warning btn-circle btn-sm d-inline-flex align-items-center justify-content-center" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="@lang('proceso.buttons.see-results')">
                                               @include('icons.zoom-in')
                                           </a>
                                    @elseif($action == 'resultados')
                                        <i class="badge badge-info">@lang('proceso.without-offers')Sin ofertas</i>
                                    @endif
                                    @if ($action == 'eliminar' && $publicacion->sePuedeEliminar())
                                        <button id="eliminar_{{ $publicacion->id }}" data-id="{{ $publicacion->id }}" class="btn btn-danger btn-circle btn-sm d-inline-flex align-items-center justify-content-center eliminar" data-bs-toggle="tooltip" data-toggle="tooltip" data-animation="false"  data-bs-placement="top" data-bs-original-title="@lang('proceso.buttons.delete-publication')">
                                            @include('icons.trash')
                                        </button>
                                    @endif
                                    @if ($action == 'favoritos')
                                        <a id='fav-{{ $publicacion->id }}' class='btn {{ $publicacion->esFavorito() ? 'btn-secondary' : 'btn-light-secondary' }} btn-circle btn-sm d-inline-flex align-items-center justify-content-center favorito' data-bs-toggle="tooltip" data-toggle='button' aria-pressed='true'  data-bs-placement="top" data-bs-original-title="@lang('proceso.buttons.add-fav')">
                                            @include('icons.heart')
                                        </a>
                                    @endif
                                @endforeach
                            @endif
                            </td>
                    </tr>
                @empty
                    <tr>
                        <td>@lang('proceso.no-values')</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
