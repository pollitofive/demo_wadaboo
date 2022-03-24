<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-block" id="TableItem-vista_previa">
                <div class="table-responsive">
                    <table class="table " id="items_proceso">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('item.list.title')</th>
                            <th>@lang('item.list.category')</th>
                            <th>@lang('item.list.subcategory')</th>
                            <th>@lang('item.list.maximum-price')</th>
                            <th>@lang('item.list.quantity')</th>
                            <th>@lang('item.list.unit')</th>
                            <th>@lang('item.list.specifications')</th>
                            <th>@lang('item.list.item-status')</th>
                            <th v-if="!solo_ver">@lang('item.list.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(item,index) in items" :key="index">
                            <td>@{{ index + 1}}</td>
                            <td>@{{ item.nombre }}</td>
                            <td>@{{ item.categoria }}</td>
                            <td>@{{ item.desc_subcategoria }}</td>

                            <td v-if="item.precio_maximo">$@{{ item.precio_maximo }}</td>
                            <td v-else></td>

                            <td>@{{ item.cantidad }}</td>
                            <td>@{{ item.unidad }}</td>
                            <td>@{{ item.especificaciones }}</td>
                            <td v-if="item.estado == 'En Proceso'">
                                @lang('item.list.saved-confirmed')
                            </td>
                            <td v-else>
                                @lang('item.list.saved-unconfirmed')
                            </td>
                            <td v-if="!solo_ver" class="acciones" style="text-align: center; width: 10%">
                                <span data-toggle="tooltip" data-animation="false"  data-bs-placement="top" data-bs-original-title="@lang('item.list.edit')"  data-bs-toggle="tooltip">
                                    <button @click="modificarItem(item)" class="btn btn-info btn-circle btn-sm d-inline-flex align-items-center justify-content-center" data-bs-target="#form-item" data-bs-toggle="modal">
                                        @include('icons.edit')
                                    </button>
                                </span>
                                <span data-toggle="tooltip" data-animation="false"  data-bs-placement="top" data-bs-original-title="@lang('item.list.delete')"  data-bs-toggle="tooltip">
                                    <button @click="eliminarItem(item)" class="btn btn-danger btn-circle btn-sm d-inline-flex align-items-center justify-content-center">
                                        @include('icons.trash')
                                    </button>
                                </span>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
