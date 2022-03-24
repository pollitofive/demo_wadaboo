@routes
<script type="text/javascript">

    function darRutaLocalidades(provincia_id)
    {
        return route('localidades',provincia_id);
    }
</script>
@endroutes
<script type="text/javascript">

    function cargarLocalidades(selected)
    {
        var url = darRutaLocalidades($("#provincia_id").val());

        $("#localidad_id").empty();
        $(".preloader").fadeIn();
        var request = $.ajax({
            url: url,
            method: 'get',
            dataType: 'json',
        });
        request.done(function (data) {
            var option = "<option value=''>Seleccione</option>";

            $("#localidad_id").append(option);

            $.each(data,function(id,nombre){

                if(selected == id)
                    option = "<option value='"+id+"' selected>"+nombre+"</option>";
                else
                    option = "<option value='"+id+"'>"+nombre+"</option>";

                $("#localidad_id").append(option);
            });
        }).then(() => $(".preloader").fadeOut());
    }


</script>
