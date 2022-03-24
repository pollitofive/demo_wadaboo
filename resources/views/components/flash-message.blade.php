@section('flash-message')

@if ($message = Session::get('success'))
    <script>
        $(function() {
            toastr.success('{{ $message }}', '{{ Session::get('title') ?? '' }}');
        });
    </script>
@endif


@if ($message = Session::get('error'))
    <script>
        $(function() {
            toastr.error('{{ $message }}', '{{ Session::get('title') ?? '' }}');
        });
    </script>
@endif


@if ($message = Session::get('warning'))
    <div class="alert alert-warning alert-block auto-hide">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif


@if ($message = Session::get('info'))
    <div class="alert alert-info alert-block auto-hide">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif
@endsection

