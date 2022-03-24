$(document).ready(function () {
    //$(".select2").select2();

    //CATEGORIA - SUBCATEGORIAS
    $("#ItemCategoria").change(function () {
        var categoria_id = this.value;
        change_subcategoria(categoria_id);
    });
    /*
    $(document).on('focus', '.select2', function (e) {
        $(this).siblings('select').select2('open');
    });
    */
});

function change_subcategoria(categoria_id, subcategoria_id = null) {
    $(".preloader").fadeIn();
    $.get(WWW + "categorias/ajax-get-subcategorias/" + categoria_id, function (jdata) {
        $('#ItemSubcategoria').empty();
        var options = "";
        options += "<option value=''></option>";
        $.each(jdata, function (key) {
            if (subcategoria_id) {
                if (subcategoria_id == jdata[key].id) {
                    options += "<option value='" + jdata[key].id + "' selected='selected'>" + jdata[key].nombre + "</option>";
                } else {
                    options += "<option value='" + jdata[key].id + "'>" + jdata[key].nombre + "</option>";
                }
            } else {
                options += "<option value='" + jdata[key].id + "'>" + jdata[key].nombre + "</option>";
            }
        });
        $('#ItemSubcategoria').append(options);
        //auto-open solo cuando no es edit.
        if (subcategoria_id == null) {
            $('#ItemSubcategoria').focus();
        }
    }).done(function(){
        $(".preloader").fadeOut();
    });
}
