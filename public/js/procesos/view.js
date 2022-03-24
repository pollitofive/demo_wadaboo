$(document).ready(function(){

    $(".subasta_ganada").click(function () {
        var id = $(this).attr('id');
        var data = {"item_id": getNumeric(id),'_token': $("input:hidden[name=_token]").val()};

        $.post('/items/get_data_vendedor', data, function (data) {
            $("#nombre").text(data.user.nombre);
            $("#cargo").text(data.user.cargo);
            $("#direccion").text(data.user.direccion);
            $("#telefono").text(data.user.telefono);
            $("#email").text(data.user.email);
            $("#form-contacto").modal(function(){show:true});

        }).fail(function(jqxhr, settings, ex) {
            Swal.fire({
                type: 'error',
                text: "Acceso denegado"
            });
        });
    });


});
