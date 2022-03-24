<div class="col-lg-{{ $size ?? '4' }} col-md-6">
    <div class="card {{ $class }} text-white">
        <div class="card-body">
            <div class="d-flex no-block align-items-center">
                    <i class="display-6 {{ $icon }}"></i>
                <div class="ms-3 mt-2">
                    <h4 class="font-weight-medium mb-0 text-white">{{ $title }}</h4>
                    <h5 class="text-white">{{ $description }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>
