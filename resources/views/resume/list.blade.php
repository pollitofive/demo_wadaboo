<table class="table stylish-table">
    <thead>
    <tr>
        <th>@lang('resume.auction')</th>
        <th>@lang('resume.product')</th>
        <th>@lang('resume.quantity')</th>
        <th>@lang('resume.price')</th>
        <th>@lang('resume.subtotal')</th>
        <th>@lang('resume.name-of-buyer')</th>
    </tr>
    </thead>
    <tbody>
    @forelse($procesos_finalizados as $proceso_finalizado)
        <tr>
            <td style="width:50px;">{{ $proceso_finalizado->proceso_id }}</td>
            <td>
                <h6>{{ $proceso_finalizado->item->nombre }}</h6>
                <a href="{{ route("procesos.view",$proceso_finalizado->proceso_id) }}"><small>{{ $proceso_finalizado->proceso->titulo }}</small></a>
            </td>
            <td>{{ $proceso_finalizado->cantidad }}</td>
            <td><span class="badge bg-light-success text-success">${{ $proceso_finalizado->oferta }}</span></td>
            <td><span class="badge bg-light-primary text-primary">${{ $proceso_finalizado->valor_total }}</span></td>
            <td>{{ $proceso_finalizado->usuario_comprador->getNombreByTipoUsuario() }}</td>
        </tr>
    @empty
        <tr>
            <td>@lang('resume.no-auctions-won')</td>
        </tr>
    @endforelse
    </tbody>
</table>
