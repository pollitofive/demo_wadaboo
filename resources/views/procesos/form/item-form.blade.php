<form id="ItemForm" class="form-horizontal">
    <div class="row">
        <div class="col-md-12 mb-3 tal">
            <label>@lang('item.modal.product-or-service-name')<span class="text-danger">*</span></label>
            <input name="nombre" id="ItemNombre" class="form-control" maxlength="60"  v-model="item.nombre">
        </div>
        <div class="col-md-6 mb-3 tal">
            <label>@lang('item.modal.max-price')</label>
            <input name="precio_maximo" id="precio_maximo" type="number" class="form-control" min="1" value="" type="number" v-model="item.precio_maximo">
        </div>
        <div class="col-md-6 mb-3 tal">
            <label>@lang('item.list.quantity')<span class="text-danger">*</span></label>
            <input name="cantidad" id="ItemCantidad" type="number" class="form-control" min="1" value="" type="number" v-model="item.cantidad">
        </div>
        <div class="col-lg-6 col-sm-6 mb-3">
            <div class="form-group">
                <label>@lang('item.list.category')<span class="text-danger">*</span></label>
                <select name="categoria_id" id="ItemCategoria" class="form-select" v-model="item.categoria_id">
                    <option></option>
                    @foreach($categorias as $id => $categoria)
                        <option value="{{ $id }}">{{ $categoria }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 mb-3">
            <div class="form-group">
                <label>@lang('item.list.subcategory')<span class="text-danger">*</span></label>
                <select name="subcategoria_id" id="ItemSubcategoria" class="form-select" v-model="item.subcategoria_id">
                </select>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-12 mb-3">
                    <div class="form-group">
                        <label>@lang('item.list.unit')<span class="text-danger"></span></label>
                        <select name="unidad" id="ItemUnidad" class="form-select" v-model="item.unidad">
                            @foreach(trans('unidades') as $key => $unidad)
                                <option value="{{ $key }}">{{$unidad}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-12 mb-3">
                    <div class="form-group">
                        <label>@lang('item.modal.sample-required')<span class="text-danger"></span></label>
                        <select name="requiere_muestra" id="ItemMuestra" class="form-select" v-model="item.requiere_muestra">
                            @foreach(trans('sino') as $key => $sino)
                                <option value="{{ $key }}">{{$sino}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-3">
            <div class="form-group">
                <label>@lang('item.modal.special-product-specifications-or-details')<span class="text-danger"></span></label>
                <textarea name="especificaciones" id="ItemEspecificaciones" class="form-control" rows="5" placeholder="(opcional)" cols="30" v-model="item.especificaciones"></textarea>
            </div>
        </div>

    </div>
    <div class="col-md-12 justify-content-end align-self-center d-none d-md-flex mt-3">
        <div class="d-flex">
            <button id="" class="pull-right btn waves-effect waves-light btn-rounded btn-primary" type="button" @click="agregarItem">
                @include('icons.save')
                @lang('item.modal.save-item')
            </button>
        </div>
    </div>
</form>
