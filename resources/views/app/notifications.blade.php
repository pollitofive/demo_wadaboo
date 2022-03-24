<aside class="customizer">
    <a href="javascript:void(0)" class="service-panel-toggle">
        <i class="mdi mdi-message">
        </i>
        <div class="notify" style="top: -12px">
            @if(auth()->user()->unReadNotifications->count() > 0 || auth()->user()->no_tiene_alertas_cargadas)
                <span class="heartbit"></span> <span class="point"></span>
            @endif
        </div>
    </a>
    <div class="customizer-body">
        <ul class="nav customizer-tab" role="tablist">
            <li class="nav-item" style="width: 100%">
                <a class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" href="#pills-home" role="tab"
                   aria-controls="pills-home" aria-selected="true">
                    <span style="color: black;font-weight: bold;">@lang('notifications.events.title')</span>
                    <i class="mdi mdi-message-reply fs-6"></i>
                </a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <!-- Tab 1 -->
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                @if(auth()->user()->no_tiene_alertas_cargadas)
                    @include('app.notifications.sin_alerta_cargada')
                @endif
                @foreach(auth()->user()->notifications->take(20) as $notificacion)
                    @include('app.notifications.'.\Str::snake(class_basename($notificacion->type)),['notificacion' => $notificacion])
                @endforeach
            </div>

        </div>
        <div class="tab-pane fade show" style="text-align: center" role="tabpanel" aria-labelledby="pills-home-tab">
            <form method="POST" action="{{ route('markAllAsRead') }}">
                {!! csrf_field() !!}
                <button type="submit" class="btn waves-effect waves-light btn-rounded btn-info" style="margin-top: 10px">
                    @lang('notifications.events.mark-all-as-read')
                </button>
            </form>
        </div>

        <div class="tab-pane fade show" style="text-align: center; margin-top: 20px"  role="tabpanel" aria-labelledby="pills-home-tab">
            <a href="{{ route('notifications') }}" class="btn waves-effect waves-light btn-rounded btn-secondary">@lang('notifications.events.see-all')</a>
        </div>

    </div>
</aside>
