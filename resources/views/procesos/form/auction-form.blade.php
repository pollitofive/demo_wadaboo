<form id="ProcesoForm" class="form-horizontal">
    <div class="row">
        <div class="col-md-6 mb-3 tal">
            <label>@lang('proceso.create-edit-auction.title-of-the-publication')<span class="text-danger">*</span></label>
            <input name="titulo" v-model="publicacion.titulo" ref="titulo" id="titulo" class="form-control" maxlength="60" >
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label>@lang('proceso.create-edit-auction.end-date')<span class="text-danger">*</span></label>
                <div class="input-group">
                    <input name="fecha_inicio" id="fecha_inicio" ref="fecha_inicio" v-model="publicacion.fecha_inicio" class="form-control" autocomplete="off" >
                    <span class="input-group-text"><i class="icon-calender"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label>@lang('proceso.create-edit-auction.auction-start-time')<span class="text-danger">*</span></label>
                <div class="input-group">
                    <select name="hora_inicio" id="hora_inicio" class="form-select" ref="hora_inicio" id="hora_inicio"  v-model="publicacion.hora_inicio">
                        <option></option>
                        @foreach(trans('horas-subasta') as $hora_inicio)
                            <option value="{{ $hora_inicio }}">{{ $hora_inicio }}</option>
                        @endforeach
                    </select>

                    <span class="input-group-text"><i class="icon-clock"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label>@lang('proceso.create-edit-auction.payment-preference')<span class="text-danger">*</span></label>
                <div class="input-group">
                    <select name="preferencia_pago" id="preferencia_pago" ref="preferencia_pago" class="form-select"  v-model="publicacion.preferencia_pago">
                        <option></option>
                        @foreach(trans('preferencias-pago') as $key => $preferencia_pago)
                            <option value="{{ $key }}">{{ $preferencia_pago }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <label>@lang('proceso.create-edit-auction.details-of-the-publication')<span class="text-danger">*</span></label>
                <textarea name="detalles" id="detalles" ref="detalles" class="form-control" rows="5"  v-model="publicacion.detalles" placeholder="Detalle" cols="30"></textarea>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label>@lang('proceso.create-edit-auction.delivery-date')<span class="text-danger">*</span></label>
                <div class="input-group">
                    <input name="fecha_entrega" id="fecha_entrega" ref="fecha_entrega" class="form-control" v-model="publicacion.fecha_entrega" autocomplete="off" >
                    <span class="input-group-text"><i class="icon-calender"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            @include('components.combo_provincia',['provincia_id' => '','extraClass' => '','label' => __('components.province').'*'])
        </div>
        <div class="col-lg-2">
            @include('components.combo_localidad',['localidad_id' => '','extraClass' => '','label' => __('components.locality').'*'])
        </div>

    </div>
</form>
