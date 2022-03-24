<div class="card animation" data-animation="fadeInUp" data-animation-delay="1s">
    <div class="card-header" id="heading{{ $number }}">
        <h6 class="mb-0"> <a class="collapsed" data-toggle="collapse" href="#collapse{{ $number }}" aria-expanded="false" aria-controls="collapse{{ $number }}">{{ $number }}. {{ $question }}</a> </h6>
    </div>
    <div id="collapse{{ $number }}" class="collapse" aria-labelledby="heading{{ $number }}" data-parent="#accordion">
        <div class="card-body"> {{ $answer }}</div>
    </div>
</div>


