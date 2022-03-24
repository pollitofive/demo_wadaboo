@switch($tipo)
    @case('App\Notifications\NotificationSeHizoUnaPregunta')
        <a href="{{ route('procesos.view',$notificacion->data['proceso_id']) }}">{{ $notificacion->data['pregunta'] }}</a>
    @break
    @case('App\Notifications\NotificationSeRespondioUnaPregunta')
        <a href="{{ route('procesos.view',$notificacion->data['proceso_id']) }}">{{ $notificacion->data['respuesta'] }}</a>
    @break
    @case('App\Notifications\NotificationSeSuperoUnaOferta')
        <a href="{{ route('procesos.view',$notificacion->data['item']['proceso_id']) }}">En la publicación {{ $notificacion->data['item']['proceso']['titulo'] }}</a>
    @break
    @case('App\Notifications\NotificationUnProcesoHaSidoPublicado')
        <a href="{{ route('procesos.view',$notificacion->data['proceso']['id']) }}">Una publicación con el titulo {{ $notificacion->data['proceso']['titulo'] }}</a>
    @break
    @case('App\Notifications\NotificationUnProcesoHaFinalizado')
        <a href="{{ url('mis_ofertas/'.$notificacion->data['id']) }}">La publicación con el título {{ $notificacion->data['titulo'] }}</a>
    @break
@endswitch
