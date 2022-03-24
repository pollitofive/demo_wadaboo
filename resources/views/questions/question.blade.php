<ul class="chat-list chat active-chat border-bottom mb-3" data-user-id="1">
    <!--chat Row -->
    <li class="mt-4">
        <div class="chat-img d-inline-block align-top"><img src="{{ url('assets/images/users/default-man.jpg') }}" alt="user" class="rounded-circle"></div>
        <div class="chat-content ps-3 d-inline-block">
            <div class="box mb-2 d-inline-block text-dark message fw-normal fs-3 bg-light-info">{{ $pregunta->pregunta }}</div>
            @if(!$pregunta->respuesta)
                <div class="comment-footer d-md-flex align-items-center mt-2">
                    <span class="badge bg-light-info text-info mb-3" id="pendiente_{{ $pregunta->id }}">@lang('questions.pending')</span>
                </div>
            @endif
        </div>
        <div class="chat-time d-inline-block text-end fs-2 font-weight-medium">{{ $pregunta->created_at }}</div>
    </li>
    @if($pregunta->respuesta)
        <li class="odd mt-4">
            <div class="chat-content ps-3 d-inline-block text-end">
                <div class="box mb-2 d-inline-block text-dark message fw-normal fs-3 bg-light-inverse">{{ $pregunta->respuesta }}</div>
                <br>
            </div>
            <div class="chat-time d-inline-block text-end fs-2 font-weight-medium">{{ $pregunta->updated_at }}</div>
        </li>
    @elseif($pregunta->proceso->esProcesoPropio() && !$pregunta->proceso->estaFinalizado())
        <li class="odd"  style="margin: 0" id="li_{{ $pregunta->id }}">
            <div class="input-group">
                <textarea id="respuesta_{{ $pregunta->id }}" class="form-control"></textarea>
                <button class="btn btn-light-info text-info font-weight-medium responder" type="button" id="btn_responder_{{ $pregunta->id }}" data-content="{{ $pregunta->id }}">@lang('questions.reply')</button>
            </div>
        </li>
    @endif
</ul>
