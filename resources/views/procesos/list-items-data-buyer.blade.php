<div class="card col-12">
    <div class="card-block">
        <div class="table-responsive">
            <table id="tablaListadoItemsDatosComprador" class="table table-bordered table-striped" cellspacing="0" width="100%">
                @include('components.header-table-data-seller-buyer',['tipo' => __('proceso.buyer')])
                <tbody>
                @foreach($finalizadas as $proceso_finalizado)
                    <tr {{ (in_array('calificar',$actions) ? "id=item_".$proceso_finalizado->item->id : '') }} >
                        <td>#{{$proceso_finalizado->proceso->id}}</td>
                        <td>{{ $proceso_finalizado->item->nombre }}</td>
                        <td><small>{{ $proceso_finalizado->item->cantidad }}</small></td>
                        <td><small>{{ $proceso_finalizado->oferta }}</small></td>
                        <td><small>${{ $proceso_finalizado->oferta * $proceso_finalizado->item->cantidad }}</small></td>
                        <td>{{ $proceso_finalizado->usuario_comprador->getNombreByTipoUsuario() ?? ''}}</td>
                        <td><small>{{ trans('tipos-usuarios.tipos-usuarios')[$proceso_finalizado->usuario_comprador->tipo_usuario] }}</small></td>
                        <td><small>{{ $proceso_finalizado->usuario_comprador->email }}</small></td>
                        <td><small>{{ $proceso_finalizado->usuario_comprador->getTelefonoByTipoUsuario() }}</small></td>
                        @if(isset($actions))
                            <td>
                                @foreach($actions as $action)
                                    @if ($action == 'ver_detalles')
                                        <span  data-toggle="tooltip" data-animation="false"  data-bs-placement="top" data-bs-original-title="@lang('proceso.buttons.see-details')"  data-bs-toggle="tooltip">
                                            <button id='{{ $proceso_finalizado->item->id }}' data-producto="{{ $proceso_finalizado->item->nombre }}" data-especificaciones="{{ $proceso_finalizado->item->especificaciones}}" data-categoria="{{ $proceso_finalizado->item->subcategoria->categoria->name }}" data-subcategoria="{{ $proceso_finalizado->item->subcategoria->name }}" class='btn btn-primary btn-circle btn-sm d-inline-flex align-items-center justify-content-center calificar' data-bs-target="#ModalItemDetalles"  data-bs-toggle="modal">
                                                @include('icons.eye')
                                            </button>
                                        </span>
                                    @endif
                                    @if ($action == 'calificar')
                                        @if($proceso_finalizado->item->puedeCalificar() || !in_array('calificar',$actions))
                                                <span  data-toggle="tooltip" data-animation="false"  data-bs-placement="top" data-bs-original-title="@lang('proceso.buttons.qualify-operation')"  data-bs-toggle="tooltip">
                                                <button data-id_item='{{ $proceso_finalizado->item->id }}' class='btn btn-primary btn-circle btn-sm d-inline-flex align-items-center justify-content-center calificar-operacion' data-bs-target="#ModalItemCalificar"  data-bs-toggle="modal">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit feather-sm"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                                </button>
                                            </span>
                                        @else
                                            <span  data-toggle="tooltip" data-animation="false"  data-bs-placement="top" data-bs-original-title="Ver calificación"  data-bs-toggle="tooltip">
                                                <button data-id_item='{{ $proceso_finalizado->item->id }}'  class='btn btn-primary btn-circle btn-sm d-inline-flex align-items-center justify-content-center calificar-operacion' data-bs-target="#ModalItemCalificar"  data-bs-toggle="modal">
                                                    @include('icons.eye')
                                                </button>
                                            </span>
                                        @endif
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

