<div class="page-breadcrumb">
    <div class="row">
        <div class="col-md-5 align-self-center">
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Wadaboo</a></li>
                        @if(isset($niveles))
                            @foreach($niveles as $route => $nivel)
                                <li class="breadcrumb-item active"><a href="{{ route($route) }}">{{ $nivel }}</a></li>
                            @endforeach
                        @endif
                        <li class='breadcrumb-item'>{{ $ubicacion_actual }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        @if(! isset($sin_crear))
            <div class="col-md-7 justify-content-end align-self-center d-none d-md-flex">
                <div class="d-flex">
                    <a href="{{ route("procesos/create") }}" class="btn pull-right hidden-sm-down btn-success">
                        @include('icons.plus')
                        @lang('proceso.new-publication')
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

