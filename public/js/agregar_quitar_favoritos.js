$(function () {

    $(".favorito").click(function () {
        var id = $(this).attr('id');
        var data = {"proceso_id": getNumeric(id),'_token': $("input:hidden[name=_token]").val()};
        $(".preloader").fadeIn();
        $.post('/procesos/ajax_set_favorito', data, function (data) {
            if (data.action === "remove") {
                $("#"+id).removeClass('btn-secondary');
                $("#"+id).addClass('btn-light-secondary');
            }

            if (data.action === "add") {
                $("#"+id).removeClass('btn-light-secondary');
                $("#"+id).addClass('btn-secondary');
            }

            successWadaboo(data.message,data.title);
            $(".preloader").fadeOut();
        });


    });

});
