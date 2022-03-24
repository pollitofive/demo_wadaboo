<div class="card chatting-box mb-0" style="display: block;">
    <div class="card-body">
        <div class="chat-meta-user pb-3 border-bottom chat-active">
            <div class="current-chat-user-name">
                <span>
                    <span class="name fw-bold ms-2">
                        @foreach ($preguntas as $pregunta)
                            <a href="{{ route("procesos.view",$pregunta->proceso->id) }}">{{ $pregunta->proceso->titulo }}</a>
                            @include("questions.question")
                        @endforeach
                    </span>
                </span>
            </div>
        </div>
    </div>
</div>
