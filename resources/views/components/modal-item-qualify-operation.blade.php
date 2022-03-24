<div id="ModalItemCalificar" class="modal fade" tabindex="-1" aria-labelledby="primary-header-modalLabel" style="display: none;" aria-hidden="true">
    <input type="hidden" id="item_id">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-primary text-white">
                <h4 class="modal-title text-white" id="exampleModalLabel1">@lang('proceso.modal-qualify.tell-us-about-operation')</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body border-top">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row py-3">
                                <label class="control-label text-end col-md-4 font-weight-medium">@lang('proceso.product-service'):</label>
                                <div class="col-md-8">
                                    <p class="form-control-static" id="nombre_producto"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group row py-3">
                                <label class="control-label text-end col-md-4 font-weight-medium">@lang('proceso.modal-qualify.quantity'):</label>
                                <div class="col-md-8">
                                    <p class="form-control-static" id="cantidad"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row py-3">
                                <label class="control-label text-end col-md-4 font-weight-medium">{{ isset($tipo) ? "{$tipo}:" : '' }}</label>
                                <div class="col-md-8">
                                    <p class="form-control-static" id="comprador"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group row py-3">
                                <label class="control-label text-end col-md-4 font-weight-medium">@lang('proceso.modal-qualify.final-value'):</label>
                                <div class="col-md-8">
                                    <p class="form-control-static" id="valor"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <form>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="form-group fl">
                                            <label for="recipient-name" class="control-label" style="font-weight: 300;">@lang('proceso.modal-qualify.did-the-operation-materialise')</label>
                                            <select id="ConcretaOperacion" class="form-select">
                                                <option value=""></option>
                                                @foreach(trans('selects.sino') as $key => $value)
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 fl">
                                        <div class="form-group">
                                            <label for="recipient-name" class="control-label" style="font-weight: 300;">@lang('proceso.modal-qualify.how-do-you-rate-the-buyer')</label>
                                            <select id="CalificaComprador" class="form-select">
                                                <option value=""></option>
                                                @foreach(trans('selects.como-calificarias') as $key => $value)
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 fl">
                                        <div class="form-group" id="lo_recomendarias">
                                            <label for="recipient-name" class="control-label" style="font-weight: 300;">@lang('proceso.modal-qualify.would-you-recommend-it')</label>
                                            <select id="RecomiendaComprador" class="form-select">
                                                <option value=""></option>
                                                @foreach(trans('selects.recomendarias') as $key => $value)
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 fl">
                                        <div class="form-group">
                                            <label for="message-text" class="control-label" id="label_comentario" style="font-weight: 300;">@lang('proceso.modal-qualify.short-comment')</label>
                                            <textarea class="form-control" id="Comentario"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">@lang('common.buttons.cancel')</button>
                <button type="button" id="CalificarItem" class="btn btn-light-primary text-primary font-weight-medium">@lang('proceso.modal-qualify.qualify')</button>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
