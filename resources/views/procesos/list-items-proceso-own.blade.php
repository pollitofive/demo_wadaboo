<div class="table-responsive m-t-5">
    <table id="TablaItemsPropios" class="table table-bordered table-striped" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th class="noVis">@lang('proceso.auction') #</th>
            <th class="noVis">@lang('proceso.product-service')</th>
            <th>@lang('proceso.category')</th>
            <th>@lang('proceso.subcategory')</th>
            <th>@lang('proceso.specifications')</th>
            <th>@lang('proceso.modal-qualify.quantity')</th>
            <th>@lang('proceso.unit')</th>
            <th class="noVis">@lang('proceso.end')</th>
            <th class="noVis">@lang('proceso.best-offer')</th>
            <th class="noVis">@lang('proceso.sub-total')<th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                <td>#{{$item->proceso->id}}</td>
                <td>{{ $item->nombre }}</td>
                <td><small>{{ $item->subcategoria->categoria->name }}</small></td>
                <td><small>{{ $item->subcategoria->name }}</small></td>
                <td><small>{{ $item->especificaciones }}</small></td>
                <td><small>{{ $item->cantidad }}</small></td>
                <td><small>{{ $item->unidad }}</small></td>
                <td><small>{{ $item->proceso->fecha_hora_fin }}</small></td>
                @if($item->mejor_oferta)
                    <td><small>{{ $item->mejor_oferta }}</small></td>
                    <td><small>{{ $item->mejor_oferta * $item->cantidad}}</small></td>
                @else
                    <td><small>@lang('proceso.without-offers')</small></td>
                    <td><small>-</small></td>
                @endif
            </tr>

        @endforeach
        </tbody>
    </table>
</div>

