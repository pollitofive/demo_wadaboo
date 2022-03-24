@extends('app.master')

@section('where-am-i')
    @include('components.where-am-i',[
    'ubicacion_actual' => __('components.notifications')
    ])
@endsection

@section('content')
    <div class="card">
        <form method="POST" action="{{ route('markAllAsRead') }}" style="margin-bottom: 20px" class="col-md-12 justify-content-end align-self-center d-none d-md-flex">
            {!! csrf_field() !!}
            <button type="submit" class="btn waves-effect waves-light btn-rounded btn-info">
                @lang('notifications.events.mark-all-as-read')
            </button>
        </form>
        <div class="table-responsive">
            <table class="table customize-table v-middle">
                <thead class="table-dark">
                <tr>
                    <th>@lang('notifications.events.date')</th>
                    <th>@lang('notifications.events.type')</th>
                    <th>@lang('notifications.events.message')</th>
                    <th>@lang('notifications.events.has-been-read')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($notificaciones as $notificacion)

                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <span class="ms-3 fw-normal">{{ $notificacion->created_at }}</span>
                            </div>
                        </td>
                        <td>@include('app.notifications.tipo_notificacion',
                                [
                                'tipo' => $notificacion->type,
                                'notificacion' => $notificacion
                                ])</td>
                        <td>
                            @include('app.notifications.tipo_mensaje',
                                [
                                'tipo' => $notificacion->type,
                                'notificacion' => $notificacion
                                ])
                        </td>
                        @if(is_null($notificacion->read_at))
                            <td><span class="badge bg-light-danger text-danger fw-normal">@lang('notifications.events.unread')</span></td>
                        @else
                            <td><span class="badge bg-light-success text-success fw-normal">@lang('notifications.events.read')</span></td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
