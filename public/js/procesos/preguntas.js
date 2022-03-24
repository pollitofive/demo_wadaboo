$(function () {
    var pk = $("#ModelPk").val();

    $("#preguntar").click(function () {
        var pregunta = $.trim($("#pregunta").val());
        var palabras = $.trim($("#pregunta").val()).split(' ');


        if (palabras.length < 3) {

            Swal.fire({
                title: 'Atención',
                text: 'Tu pregunta no parece válida',
                type: 'warning'
            });
            return;
        }

        var params = {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            "pregunta": pregunta,
            "proceso_id": $("#proceso_id").val()
        };
        $(".preloader").fadeIn();
        $.post("/preguntas/nueva_pregunta", params, function (data) {

            $(".preloader").fadeOut();
            Swal.fire({
                title: 'Atención',
                text: data,
                type: 'success'
            }).then(() => {
                location.reload();
            });
            $("#pregunta").val("");

        });

    });

    $(".responder").click(function (){

        var id = this.id;
        var pregunta_id = $("#"+id).data('content');

        var respuesta = $("#respuesta_"+pregunta_id).val();

        if (respuesta.length < 3) {

            Swal.fire({
                title: 'Atención',
                text: 'Tu respuesta no parece válida',
                type: 'warning'
            });
            return;
        }

        var params = {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            "respuesta": respuesta,
            "pregunta_id": pregunta_id
        };

        $(".preloader").fadeIn();
        $.post("/preguntas/respuesta_pregunta", params, function (data) {
            $(".preloader").fadeOut();
            Swal.fire({
                title: 'Atención',
                text: data,
                type: 'success'
            });
            $("#pendiente_"+pregunta_id).hide();
            $("#li_"+pregunta_id).html('        <div class="chat-content ps-3 d-inline-block text-end">\n' +
                '            <div class="box mb-2 d-inline-block text-dark message fw-normal fs-3 bg-light-inverse">'+respuesta+'</div>\n' +
                '        <br></div>\n' +
                '        <div class="chat-time d-inline-block text-end fs-2 font-weight-medium">Ahora</div>\n');


            /*

            <li class="odd mt-4">
                <div class="chat-content ps-3 d-inline-block text-end">
                    <div class="box mb-2 d-inline-block text-dark message fw-normal fs-3 bg-light-inverse">{{ $pregunta->respuesta }}</div>
                    <br>
                </div>
                <div class="chat-time d-inline-block text-end fs-2 font-weight-medium">{{ $pregunta->updated_at }}</div>
            </li>
             */

        });

    });

});

