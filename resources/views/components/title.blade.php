<div class="border-bottom title-part-padding" style="text-align: center">
    <h4 class="card-title mb-0">{{ $title }}</h4>
</div>
@if (isset($subtitle) && is_array($subtitle))
    <ul>
    @foreach($subtitle as $val)
        <li>{{$val}}</li>
    @endforeach
    </ul>
@elseif(isset($subtitle))
    <p>{{ $subtitle }}</p>
@endif
