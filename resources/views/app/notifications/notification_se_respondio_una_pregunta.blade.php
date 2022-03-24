<a href="{{ route('procesos.view',$notificacion->data['proceso_id']) }}" class="message-item d-flex align-items-center border-bottom px-3 py-2" id="chat_user_1" data-user-id="1">
    <div class="btn btn-warning btn-circle"><i class="fas fa-comment-dots"></i></div>
    <div class="w-75 d-inline-block v-middle ps-3">
        <h5 class="message-title mb-0 mt-1">@include('app.notifications.tipo_notificacion',['tipo' => $notificacion->type])</h5>
        <span class="fs-2 text-nowrap d-block text-muted text-truncate">
            {{ $notificacion->data['respuesta'] }}
        </span>
        <span class="fs-2 text-nowrap d-block text-muted">{{ $notificacion->created_at }}</span>
    </div>
    <div class="notify">
        @if(is_null($notificacion->read_at))
            <span class="heartbit"></span> <span class="point"></span>
        @endif
    </div>
</a>
