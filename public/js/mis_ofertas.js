$(document).ready(function(){

    $('.ListadoItemsDatosComprador').DataTable({
        pageLength: 25,
        aaSorting: [],
        dom: 'Bfrtip',
        columnDefs: [
            // { targets: 3, visible: false},
            // { targets: 4, visible: false},
            // { targets: 12, visible: false},
            // { targets: 13, visible: false},
        ],
        buttons: [{
            extend: 'excel',
            text: 'Bajar a Excel',
        }, {
            extend: 'colvis',
            text: 'Columnas opcionales',
            columns: ':not(.noVis)'
        }],
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
            search: "_INPUT_",
            searchPlaceholder: " ",
        },
        initComplete: function () {
            //FILTROS SELECT.
            this.api().columns([0, 1, 5]).every(function () {
                var column = this;
                var select = $('<select class="form-control"><option value=""></option></select>')
                    .appendTo($(column.footer()).empty())
                    .on('change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                        column
                            .search(val ? '^' + val + '$' : '', true, false)
                            .draw();
                    });

                column.data().unique().sort().each(function (d, j) {
                    select.append('<option value="' + d + '">' + d + '</option>')
                });

                //Pone arriba los filtros.
                var r = $('#TablaItemsResultados tfoot tr');
                r.find('th').each(function () {
                    $(this).css('padding', 8);
                });
                $('#TablaItemsResultados thead').prepend(r);
                $('#search_0').css('text-align', 'center');
            });

        }
    });


    //Para los datos del modal ver detalles.
    $('#ModalItemDetalles').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);// Button that triggered the modal
        var producto = button.data('producto'); // Extract info from data-* attributes
        var especificaciones = button.data('especificaciones'); // Extract info from data-* attributes
        var categoria = button.data('categoria'); // Extract info from data-* attributes
        var subcategoria = button.data('subcategoria'); // Extract info from data-* attributes

        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);
        modal.find('#producto').html(producto);
        modal.find('#especificaciones').html(especificaciones);
        modal.find('#categoria').html(categoria);
        modal.find('#subcategoria').html(subcategoria);
    });

    $("#ConcretaOperacion").change(function(){

        if($("#ConcretaOperacion").val() == "No")
        {
            $("#lo_recomendarias").hide();
            $("#label_comentario").text("Por favor, cuéntanos que pasó");
        }
        else
        {
            $("#lo_recomendarias").show();
            $("#label_comentario").text("Breve comentario (opcional)");
        }

    });
});


