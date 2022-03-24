<div id="ModalItemDetalles" class="modal fade" tabindex="-1" aria-labelledby="primary-header-modalLabel" style="display: none;" aria-hidden="true">
    <input type="hidden" id="item_id">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-primary text-white">
                <h4 class="modal-title text-white" id="exampleModalLabel1">@lang('proceso.details-of-the-product')</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>@lang('proceso.product-service')</th>
                                <th>@lang('proceso.specifications')</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td id="producto"></td>
                                <td id="especificaciones"></td>
                            </tr>
                            </tbody>
                        </table><table class="table">
                            <thead>
                            <tr>
                                <th>@lang('proceso.category')</th>
                                <th>@lang('proceso.subcategory')</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td id="categoria"></td>
                                <td id="subcategoria"></td>
                            </tr>
                            </tbody>
                        </table>

                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">@lang('common.buttons.cancel')</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
