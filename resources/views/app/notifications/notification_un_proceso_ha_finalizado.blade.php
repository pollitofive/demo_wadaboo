@if($notificacion->data['user_id'] == auth()->user()->id)
    <a href="{{ url('my-purchases/'.$notificacion->data['id']) }}" class="message-item d-flex align-items-center border-bottom px-3 py-2">
@else
    <a href="{{ url('my-offers/'.$notificacion->data['id']) }}" class="message-item d-flex align-items-center border-bottom px-3 py-2">
@endif
    <div class="btn btn-secondary btn-circle">
        <i class="far fa-share-square"></i>
    </div>
    <div class="w-75 d-inline-block v-middle ps-3">
        <h5 class="message-title mb-0 mt-1">@include('app.notifications.tipo_notificacion',
                                [
                                'tipo' => $notificacion->type,
                                'notificacion' => $notificacion
                                ])
        </h5>

        <span class="fs-2 text-nowrap d-block text-muted text-truncate">Puedes ver los resultados aquí</span>
        <span class="fs-2 text-nowrap d-block text-muted">{{ $notificacion->created_at }}</span>
    </div>
    <div class="notify">
        @if(is_null($notificacion->read_at))
        <span class="heartbit"></span> <span class="point"></span>
        @endif
    </div>
</a>
