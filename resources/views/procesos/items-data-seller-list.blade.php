<div class="card col-12">
    <div class="card-block">
        <div class="table-responsive">
            <table id="tablaListadoItemsDatosVendedor" class="ListadoItemsDatosVendedor table table-bordered table-striped" cellspacing="0" width="100%">
                @include('components.header-table-data-seller-buyer',['tipo' => __('proceso.seller')])
                <tbody>
                @foreach($finalizadas as $proceso_finalizado)
                    <tr {{ (in_array('calificar',$actions) ? "id=item_".$proceso_finalizado->item->id : '') }} >
                        <td>#{{$proceso_finalizado->proceso->id}}</td>
                        <td>{{ $proceso_finalizado->item->nombre }}</td>
                        <td><small>{{ $proceso_finalizado->item->cantidad }}</small></td>
                        @if($proceso_finalizado->oferta != null)
                            <td><small>${{ $proceso_finalizado->oferta }}</small></td>
                            <td><small>${{ $proceso_finalizado->oferta * $proceso_finalizado->item->cantidad }}</small></td>
                            <td>{{ $proceso_finalizado->usuario_vendedor->getNombreByTipoUsuario() }}</td>
                            <td><small>{{ trans('tipos-usuarios.tipos-usuarios')[$proceso_finalizado->usuario_vendedor->tipo_usuario] ?? '' }}</small></td>
                            <td><small>{{ $proceso_finalizado->usuario_vendedor->email }}</small></td>
                            <td><small>{{ $proceso_finalizado->usuario_vendedor->getTelefonoByTipoUsuario() }}</small></td>
                        @else
                            <td colspan="6" style="text-align: center;font-weight: bold;">@lang('proceso.without-offers')</td>
                        @endif
                        @if(isset($actions))
                            <td style="width: 155px !important;">
                                @foreach($actions as $action)
                                    @if ($action == 'ver_detalles')
                                        <button id='{{ $proceso_finalizado->item->id }}' data-target="#ModalItemDetalles" data-producto="{{ $proceso_finalizado->item->nombre }}" data-especificaciones="{{ $proceso_finalizado->item->especificaciones}}" data-categoria="{{ $proceso_finalizado->item->subcategoria->categoria->nombre }}" data-subcategoria="{{ $proceso_finalizado->item->subcategoria->nombre }}" class='btn btn-secondary btn-circle btn-sm d-inline-flex align-items-center justify-content-center calificar' data-bs-toggle="tooltip" data-toggle="tooltip" data-animation="false"  data-bs-placement="top" data-bs-original-title="Ver Detalles">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-check feather-sm"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline></svg>
                                        </button>
                                    @endif
                                    @if ($action == 'calificar' && $proceso_finalizado->oferta != null)
                                        @if($proceso_finalizado->item->puedeCalificar() || !in_array('calificar',$actions))
                                            <span  data-toggle="tooltip" data-animation="false"  data-bs-placement="top" data-bs-original-title="@lang('proceso.buttons.qualify-operation')"  data-bs-toggle="tooltip">
                                                <button data-id_item='{{ $proceso_finalizado->item->id }}' class='btn btn-primary btn-circle btn-sm d-inline-flex align-items-center justify-content-center calificar-operacion' data-bs-target="#ModalItemCalificar"  data-bs-toggle="modal">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit feather-sm"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                                </button>
                                            </span>
                                        @else
                                            <span  data-toggle="tooltip" data-animation="false"  data-bs-placement="top" data-bs-original-title="@lang('proceso.buttons.watch-qualification')"  data-bs-toggle="tooltip">
{{--                                                <button data-id_item='{{ $proceso_finalizado->item->id }}' class='btn btn-success btn-circle btn-sm d-inline-flex align-items-center justify-content-center calificar-operacion'  data-bs-target="#ModalItemCalificar"  data-bs-toggle="tooltip" data-toggle="tooltip" data-animation="false"  data-bs-placement="top" data-bs-original-title="Ver calificación">--}}
{{--                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-check feather-sm"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline></svg>--}}
{{--                                                </button>--}}
                                                <button data-id_item='{{ $proceso_finalizado->item->id }}' class='btn btn-success btn-circle btn-sm d-inline-flex align-items-center justify-content-center calificar-operacion' data-bs-target="#ModalItemCalificar"  data-bs-toggle="modal" >
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-check feather-sm"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline></svg>
                                                </button>
                                            </span>
                                        @endif
                                    @endif
                                @endforeach
                            </td>
                        @endif
                    </tr>
                @endforeach
                @include('components.modal-item-qualify-operation',['tipo' => __('proceso.seller')])
                </tbody>
            </table>
        </div>
    </div>
</div>

