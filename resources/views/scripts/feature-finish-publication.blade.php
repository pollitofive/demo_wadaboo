<script>
    $(function () {

        $(".eliminar").click(function (e) {
            e.preventDefault();
            var id = $(this).data('id');

            Swal.fire({
                title: "@lang('proceso.messages.confirm-delete-publication')",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: "@lang('common.buttons.cancel')",
                confirmButtonText: "@lang('common.buttons.delete')",
                allowOutsideClick: false
            }).then((result) => {
                if(result.value)
                {
                    var data = new Object();
                    data.proceso_id = id;
                    data._token = $('meta[name="csrf-token"]').attr('content');
                    $(".preloader").fadeIn();
                    $.ajax({
                        method: 'POST',
                        data: data,
                        dataType: 'json',
                        url: "finalizar_publicacion",
                        success: function (data) {
                            Swal.fire({
                                title: "@lang('proceso.messages.validations.deleted')",
                                text: "@lang('proceso.messages.the-publication-has-been-finished')",
                                type: 'success',
                                allowOutsideClick: false
                            });
                            setTimeout(function(){
                            }, 1000);
                            location.reload();
                        },
                        error: function (xhr) {
                            Swal.fire({
                                type: 'error',
                                text: xhr.responseJSON.message
                            });
                        }
                    }).done(function(){
                        $(".preloader").fadeOut();
                    });

                }
            });


        });

    });

</script>
