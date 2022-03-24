<div class="row">
    <!-- Column -->
    <div class="col-md-6 col-lg-3 col-xlg-3">
        <div class="card">
            <div class="box p-2 rounded bg-info text-center">
                <h1 class="fw-light text-white">{{ $procesos_finalizados->unique('proceso_id')->count() }}</h1>
                <h6 class="text-white">@lang('resume.publications-won')</h6>
            </div>
        </div>
    </div>
    <!-- Column -->
    <div class="col-md-6 col-lg-3 col-xlg-3">
        <div class="card">
            <div class="box p-2 rounded bg-primary text-center">
                <h1 class="fw-light text-white">{{ $procesos_finalizados->unique('item_id')->count() }}</h1>
                <h6 class="text-white">@lang('resume.offers-won')</h6>
            </div>
        </div>
    </div>
    <!-- Column -->
    <div class="col-md-6 col-lg-3 col-xlg-3">
        <div class="card">
            <div class="box p-2 rounded bg-success text-center">
                <h1 class="fw-light text-white">{{ $procesos_finalizados->unique('user_comprador_id')->count() }}</h1>
                <h6 class="text-white">@lang('resume.different-buyers')</h6>
            </div>
        </div>
    </div>
    <!-- Column -->
    <div class="col-md-6 col-lg-3 col-xlg-3">
        <div class="card">
            <div class="box p-2 rounded bg-warning text-center">
                <h1 class="fw-light text-white">{{ $procesos_finalizados->sum('cantidad') }}</h1>
                <h6 class="text-white">@lang('resume.number-of-items-sold')</h6>
            </div>
        </div>
    </div>
</div>
