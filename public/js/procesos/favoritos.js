$(function () {

    $("[id^='AgregarAFavoritos']").click(function () {
        var id = $(this).attr('id');
        var data = {"proceso_id": getNumeric(id)};

        $.post('/procesos/ajax_set_favorito', data, function (data) {
            console.log("HOLA");
            if (data === "remove") {
                $("#" + id + "").removeClass('active');
            }
            if (data === "add") {
                $("#" + id + "").addClass('active');
            }
        });


    });

});

