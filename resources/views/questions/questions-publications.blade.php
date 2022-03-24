<div class="row">
    <div class="col-12">
        <div class="card-header bg-info  d-flex align-items-center">
            <h4 class="card-title text-white">
                <i class="ti-comment"></i>
                @lang('questions.questions')
            </h4>
        </div>
        <div class="card" style="padding: 20px;">
            @if($proceso->preguntas->IsNotEmpty() || !$proceso->esProcesoPropio())
                <div class="card-header bg-primary  d-flex align-items-center">
                    <h4 class="card-title text-white">
                        <i class="ti-comments"></i>
                        @lang('questions.do-not-include-personal-or-contact-details')
                    </h4>
                </div>
            @endif
            @if(!$proceso->esProcesoPropio() && !$proceso->estaFinalizado())
                @include('questions.new-question')
            @endif
            <div class="chat-box">
                @foreach ($preguntas as $pregunta)
                    @include("questions.question")
                @endforeach
            </div>
        </div>
    </div>
</div>
