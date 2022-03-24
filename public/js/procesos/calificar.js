var elements = document.getElementsByClassName("calificar-operacion");

var calificarItem = function(){

    var params = {
        item_id: document.getElementById('item_id').value,
        concreta: document.getElementById('ConcretaOperacion').value,
        calificacion: document.getElementById('CalificaComprador').value,
        comentario: document.getElementById('Comentario').value,
        recomendarias: document.getElementById('RecomiendaComprador').value,
        _token: $('meta[name="csrf-token"]').attr('content'),
    };

    if(params.concreta == '' || params.calificacion == '' || params.recomendarias == '') {

    }

    $(".preloader").fadeIn();
    $.post('/items/ajax_calificar_item', params, function (data) {

        Swal.fire({
            title: data.title,
            text: data.message,
            type: 'success',
            allowOutsideClick: false
        });

    }).fail(function(xhr, status, error) {
        Swal.fire({
            type: 'error',
            text: xhr.responseJSON.message
        });
    }).done(function(){
        $(".preloader").fadeOut();
    });

    $('#ModalItemCalificar').modal('toggle');


}



var getDataCalificacion = function() {
    var item_id = this.getAttribute("data-id_item");
    var params = {
        "_token": $('meta[name="csrf-token"]').attr('content'),
        "item_id": item_id
    };

    document.getElementById('item_id').value = item_id;

    $(".preloader").fadeIn();
    $.post("/items/get_calificacion", params, function (data) {
        document.getElementById("CalificarItem").addEventListener('click', calificarItem, false);

        document.getElementById('nombre_producto').innerHTML = data.producto;
        document.getElementById('cantidad').innerHTML = data.cantidad;
        document.getElementById('comprador').innerHTML = data.comprador;
        document.getElementById('valor').innerHTML = data.valor;

        document.getElementById("ConcretaOperacion").value = data.concreto_operacion;
        document.getElementById("CalificaComprador").value = data.como_calificarias;
        document.getElementById("RecomiendaComprador").value = data.recomendarias;
        document.getElementById("Comentario").value = data.comentario;
        $("#ModalItemCalificar").modal();

        if(data.puede_calificar) {
            document.getElementById('CalificarItem').style.visibility = 'visible';
        } else {
            document.getElementById('CalificarItem').style.visibility = 'hidden';
        }

    }).fail(function(xhr, status, error) {
        Swal.fire({
            type: 'error',
            text: xhr.responseJSON.message
        });
    }).done(function(){
        $(".preloader").fadeOut();
    });

};


for (var i = 0; i < elements.length; i++) {
    elements[i].addEventListener('click', getDataCalificacion, false);
}



