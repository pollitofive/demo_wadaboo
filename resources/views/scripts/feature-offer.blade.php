<script>
    $(function () {


        $("#ofertar").click(function(){

            Swal.fire({
                title: '@lang("proceso.messages.confirm-offer")',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '@lang("common.buttons.offer")',
                cancelButtonText: '@lang("common.buttons.cancel")',
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

        $("[id^='eliminar_oferta']").click(function(){
            var row = $(this).closest('tr');
            var id = $(this).data('id');

            Swal.fire({
                title: '@lang("proceso.messages.confirm-delete-publication")',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: '@lang("common.buttons.cancel")',
                confirmButtonText: '@lang("common.buttons.delete")',
                allowOutsideClick: false
            }).then((result) => {
                if(result.value)
                {
                    var data = new Object();
                    data.item_id = id;
                    data._token = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        method: 'POST',
                        data: data,
                        dataType: 'json',
                        url: "ajax_eliminar_oferta",
                        success: function (data) {
                            Swal.fire({
                                title: 'Oferta eliminada!',
                                type: 'success',
                                allowOutsideClick: false
                            });
                            //reover fila
                            row.remove();
                        },
                        error: function (xhr) {
                            Swal.fire({
                                type: 'error',
                                text: xhr.responseJSON.message
                            });
                        }
                    });

                }
            });
        });


    });

</script>
