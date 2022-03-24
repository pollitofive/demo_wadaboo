var edit_id = false;
var proceso_id;
var info_general = {};

$(function () {
    //Configuración inicial.
    $("[id^='paso2']").hide();
    checkBorrador();
    aplicarDatePicker();

    //Paso 1. Agregar items.
    $('#ItemCantidad').val(1);
    $("#addItem").click(function () {
        addItem();
    });
    //Ir al paso 2.
    $("#paso1_siguiente").click(function () {
        controlItemsBorrador();
    });
    //Publicar
    $("#publicar").click(function () {
        if (!validarInfoGeneral()) {
            topAlert("Para continuar debe completar los campos marcados (*)", "danger");
            return;
        }
        controlItemsBorrador();
    });
    $("#paso2_atras").click(function () {
        $("[id^='paso1']").show();
        $("[id^='paso2']").hide();
        goTop();
    });

    //Acción Editar.  
    $(document).on("click", "[id^='EditItem']", function () {
        edit_id = getNumeric($(this).attr('id'));
        $('#ItemCategoria').select2('destroy'); //para evitar que dispare el change.
        $.get("/items/ajax_get_item/" + edit_id, function (jdata) {
            topAlert("Edita los campos y hacé click en Agregar Item");
            $('#ItemNombre').val(jdata.nombre);
            $('#ItemCategoria').val(jdata.categoria_id).select2();
            $('#ItemEspecificaciones').val(jdata.especificaciones);
            $('#ItemCantidad').val(jdata.cantidad);
            $('#ItemUnidad').val(jdata.unidad);
            change_subcategoria(jdata.categoria_id, jdata.subcategoria_id);
        });
    });
    //Acción Eliminar.
    $(document).on("click", "[id^='DeleteItem']", function () {
        var pk = getNumeric($(this).attr('id'));
        delete_item(pk);
    });


});


var item = {};

function addItem() {
    if (!validarItem()) {
        topAlert("Para agregar un Item debe completar los campos marcados (*)", "danger");
        return;
    }
    item["_token"] = token;
    item["proceso_id"] = proceso_id;
    item["nombre"] = $('#ItemNombre').val();
    item["categoria_id"] = $('#ItemCategoria').val();
    item["categoria"] = $('#ItemCategoria option:selected').text();
    item["subcategoria_id"] = $('#ItemSubcategoria').val();
    item["subcategoria"] = $('#ItemSubcategoria option:selected').text();
    item["especificaciones"] = $('#ItemEspecificaciones').val();
    item["cantidad"] = $('#ItemCantidad').val();
    item["unidad"] = $('#ItemUnidad option:selected').text();
    item["muestra"] = $('#ItemMuestra option:selected').text();

    //UPDATE 
    if (edit_id) {
        item["id"] = edit_id;
        $("[id='EditItem-" + edit_id + "']").closest("tr").find("td:eq(1)").text(item.nombre);
        $("[id='EditItem-" + edit_id + "']").closest("tr").find("td:eq(2)").text(item.categoria);
        $("[id='EditItem-" + edit_id + "']").closest("tr").find("td:eq(3)").text(item.subcategoria);
        $("[id='EditItem-" + edit_id + "']").closest("tr").find("td:eq(4)").text(item.cantidad);
        $("[id='EditItem-" + edit_id + "']").closest("tr").find("td:eq(5)").text(item.unidad);
        $("[id='EditItem-" + edit_id + "']").closest("tr").find("td:eq(6)").text(item.especificaciones);

        $.post("/items/ajax_update_item", item, function () {
            beforeAlert("Edición realizada con éxito!", "#TableItem-vista_previa");
            $("html, body").animate({scrollTop: $('#ItemNombre').offset().top - 150}, "slow");
            edit_id = false;
            limpiarTmpForm();
        });
        return;
    }

    //NEW
    $.post("/items/ajax_add_item", item, function (item_id) {
        var nroItem = $("#items_proceso tbody tr").length;
        var modelPk = "Item-" + item_id;
        var html = "";
        html += "<tr>";
        html += "<td>" + (nroItem + 1) + "</td>";
        html += "<td>" + item.nombre + "</td>";
        html += "<td>" + item.categoria + "</td>";
        html += "<td>" + item.subcategoria + "</td>";
        html += "<td>" + item.cantidad + "</td>";
        html += "<td>" + item.unidad + "</td>";
        html += "<td>" + item.especificaciones + "</td>";
        html += "<td class='acciones'>" + edit_btn(modelPk) + del_btn(modelPk) + "</td>";
        html += "</tr>";

        $("#items_proceso tbody").append(html);
        limpiarTmpForm();
        beforeAlert("Bien hecho! podés seguir agregando items", "#TableItem-vista_previa");
        $("html, body").animate({scrollTop: $('#ItemNombre').offset().top - 150}, "slow");
    });

}


function getRequisitos() {
    var requisitos = [];
    $("[id^=ProcesoRequisitosExcluyentes]").each(function () {
        if ($(this).prop("checked")) {
            console.log($(this).val());
            requisitos.push($(this).val());
        }
    });
    if (requisitos.length > 0) {
        console.log(requisitos);
        return requisitos.toString();
    }
    return "";
}

function validarInfoGeneral() {
    var validate = true;
    if ($('#ProcesoReferencia').val() == '') {
        validate = false;
    }
    if ($('#ProcesoFechaFin').val() == 0) {
        validate = false;
    }
    if ($('#ProcesoFechaEntrega').val() == 0) {
        validate = false;
    }
    return validate;
}

function controlItemsBorrador() {
    //check si existen items antes de continuar
    $.get("/items/ajax_check_items_before_continue", function (r) {
        if (r === "OK") {
            finalizarPublicacion();
            continuarPaso2();
        } else {
            swal("Para continuar, al menos debes agregar 1 ítem a tu compra.");
            return;
        }
    });
}

function continuarPaso2() {
    if ($("[id^='paso1']").is(":visible")) {
        $("[id^='paso1']").hide();
        $("[id^='paso2']").show();
        goTop();
    }
}
function finalizarPublicacion() {
    if ($("[id^='paso2']").is(":visible")) {
        info_general["_token"] = token;
        info_general["id"] = proceso_id;
        info_general["titulo"] = $("#ProcesoTitulo").val();
        info_general["fecha_inicio"] = $("#ProcesoFechaInicio").val();
        info_general["hora_inicio"] = $("#ProcesoHoraInicio").val();
        info_general["detalles"] = $("#ProcesoDetalles").val();
        info_general["fecha_entrega"] = $("#ProcesoFechaEntrega").val();
        info_general["preferencia_pago"] = $("#ProcesoPreferenciaPago").val();
        info_general["punto_entrega_id"] = $("#ProcesoPuntoEntrega").val();

        $.post("/procesos/ajax_set_info_general", info_general, function () {
            swal("Felicitaciones!");
            $(location).attr('href', "/mis_compras");
            return;
        });
    }
}

function checkBorrador() {
    //si es borrador, muestro alerta al usuario.
    if ($("#borradorId").val() > 0) {
        $("[id^='paso1']").hide();
        $("#ContinuarPublicacion").click(function () {
            proceso_id = $("#borradorId").val();
            $("[id='check_borrador']").closest(".row").remove();
            $("[id^='paso1']").show();
            $("#items_proceso tbody tr").each(function () {
                var item_id = $(this).find("[id^='itemPk']").val();
                var modelPk = "Item-" + item_id;
                $(this).find(".acciones").append(edit_btn(modelPk));
                $(this).find(".acciones").append(del_btn(modelPk));
            });
        });
        $("#NuevaPublicacion").click(function () {
            var params = {
                "_token": token,
                "id": $("#borradorId").val()
            };
            $.post("/procesos/eliminar_borrador/", params, function (r) {
                if (r == "ERROR") {
                    alert("ERROR");
                    return;
                }
                location.reload();
            });
        });
    } else {
        proceso_id = $("#nuevoId").val();
    }
}
function aplicarDatePicker() {
    var hoy = moment().format('DD/MM/YYYY');
    var dateToday = new Date();
    var inicio_subasta = new Date(dateToday.setDate(dateToday.getDate() + 3));
    var fecha_inicio;

    if ($("#ProcesoFechaInicio").val()) {
        fecha_inicio = $("#ProcesoFechaInicio").val();
    }

    $("#ProcesoFechaInicio").datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'dd/mm/yyyy',
        daysOfWeekDisabled: [0, 6],
        weekStart: [1],
        language: 'es',
        orientation: "bottom",
        startDate: inicio_subasta
    });

    $("#ProcesoFechaInicio").datepicker().on('changeDate', function (e) {
        var fechaEntrega = new Date(e.date.setDate(e.date.getDate() + 1));
        $("#ProcesoFechaEntrega").val('');
        $("#ProcesoFechaEntrega").datepicker('destroy');
        $("#ProcesoFechaEntrega").datepicker({
            autoclose: true,
            format: 'dd/mm/yyyy',
            daysOfWeekDisabled: [0, 6],
            weekStart: [1],
            language: 'es',
            orientation: "bottom",
            startDate: fechaEntrega
        });
    });
}

function validarItem() {
    var validate = true;
    if ($('#ItemNombre').val() == '') {
        validate = false;
    }
    if ($('#ItemCategoria').val() == 0) {
        validate = false;
    }
    if ($('#ItemSubcategoria').val() == 0) {
        validate = false;
    }
    if ($('#ItemCantidad').val() == '' || $('#ItemCantidad').val() <= 0) {
        $('#ItemCantidad').val('1');
    }
    return validate;
}
function limpiarTmpForm() {
    $('#ItemNombre').val("");
    $('#ItemCantidad').val(1);
    $('#ItemEspecificaciones').val("");
}

function edit_btn(modelPk) {
    var html = "<button title='Editar' class='btn btn-info fa fa-edit pull-right' type='button' id='Edit" + modelPk + "'></button>";
    return html;
}
function del_btn(modelPk) {
    var html = "<button title='Eliminar' class='btn btn-danger fa fa-trash-alt pull-right' type='button' id='Delete" + modelPk + "'></button>";
    return html;
}

function finalizar_btn(event) {
    event.preventDefault();
    swal({
        title: "Atención",
        text: 'Desea finalizar la publicación?',
        type: "warning",
        buttons: true,
        dangerMode: true,
        showCancelButton: true,
        confirmButtonText: 'Ok!',
        cancelButtonText: "Cancelar",
    }, function () {
        $.post(event.target.href, function (data) {
            if (data == "OK") {
                swal("Publicación Finalizada!", "success");
                $(location).attr('href', WWW + "mis_compras");
                return;
            } else {

            }
        });
    });
}
function delete_item(id) {
    var params = {
        "_token": token,
        "id": id
    };
    swal({
        title: "Atención",
        text: "Está seguro que desea eliminar?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        showCancelButton: true,
        confirmButtonText: 'Ok!',
        cancelButtonText: "Cancelar"
    }, function () {
        $.post("/items/eliminar_borrador", params, function (r) {
            if (r == "OK") {
                topAlert('Registro eliminado.', 'danger');
                $("[id='DeleteItem-" + id + "']").closest('tr').remove();
                reindexTable();
            }
        });
    });
}
function reindexTable() {
    $("table tbody tr").each(function (i) {
        $(this).find("td:eq(0)").text("" + (i + 1) + "");
    });
}