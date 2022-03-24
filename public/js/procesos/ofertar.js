$(function () {


    $("#ofertar").click(function(){

        Swal.fire({
            title: '¿Confirma que desea ofertar?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si! Ofertar!',
            cancelButtonText: 'Cancelar',
            allowOutsideClick: false
        }).then((result) => {
            if (result.value) {

                var data = [];
                $(".ofertar").each(function(index,object){

                    data.push({
                        item_id: $("#"+object.id).data('content'),
                        oferta: $("#"+object.id).val()
                    });
                });

                var params = {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "data": JSON.stringify(data)
                };
                $(".preloader").fadeIn();
                $.post("/ofertasxitems/ofertar", params, function (data) {
                    $(".preloader").fadeOut();
                    Swal.fire({
                        title: data.title,
                        text: data.message,
                        type: 'success',
                        allowOutsideClick: false
                    }).then(() => {
                        location.reload();
                    });

                }).fail(function(xhr, status, error) {
                    Swal.fire({
                        type: 'error',
                        text: xhr.responseJSON.message
                    });
                });
            }
        });

    });

});
