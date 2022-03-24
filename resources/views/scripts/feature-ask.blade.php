<script>
    $(function () {
        var pk = $("#ModelPk").val();

        $("#preguntar").click(function () {
            var pregunta = $.trim($("#pregunta").val());
            var palabras = $.trim($("#pregunta").val()).split(' ');


            if (palabras.length < 3) {

                Swal.fire({
                    title: "@lang('common.attention')",
                    text: "@lang('questions.your-question-does-not-seem-valid')",
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
            $.post("/questions/new-question", params, function (data) {

                $(".preloader").fadeOut();
                Swal.fire({
                    title: "@lang('common.attention')",
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
                    title: "@lang('common.attention')",
                    text: "@lang('questions.your-answer-does-not-seem-valid')",
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
            $.post("/questions/answer-question", params, function (data) {
                $(".preloader").fadeOut();
                Swal.fire({
                    title: "@lang('common.attention')",
                    text: data,
                    type: 'success'
                });
                $("#pendiente_"+pregunta_id).hide();
                $("#li_"+pregunta_id).html('        <div class="chat-content ps-3 d-inline-block text-end">\n' +
                    '            <div class="box mb-2 d-inline-block text-dark message fw-normal fs-3 bg-light-inverse">'+respuesta+'</div>\n' +
                    '        <br></div>\n' +
                    '        <div class="chat-time d-inline-block text-end fs-2 font-weight-medium">@lang('common.now')</div>\n');


            });

        });

    });


</script>
