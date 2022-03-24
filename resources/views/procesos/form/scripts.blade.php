@section('vue')
    @include('scripts.localidades')

    <script>

        var vm = new Vue({
            el: '#app',
            data:{
                publicacion:{
                    id: '',
                    titulo: '',
                    fecha_inicio: '',
                    hora_inicio: '',
                    detalles: '',
                    fecha_entrega: '',
                    preferencia_pago: '',
                    provincia_id: '',
                    localidad_id: ''

                },
                item: {
                    id: '',
                    nombre: '',
                    categoria_id: null,
                    categoria: '',
                    subcategoria_id: null,
                    desc_subcategoria: '',
                    especificaciones: '',
                    cantidad: '',
                    unidad: '',
                    estado: '',
                    requiere_muestra: '',
                    precio_maximo: ''
                },
                solo_ver: false,
                items: [],
                _token: ''
            },
            watch:{
                items:function(){
                    updateTooltip();
                }
            },
            computed:{
                haCargado15Items: function()
                {
                    if(this.items.length == 15)
                    {
                        return true;
                    }

                    return false;
                }
            },
            methods:{
                darError:function (message,field,name) {
                    errorWadaboo(message,"@lang('proceso.messages.attention')");
                    this.$refs[name].classList = this.$refs[name].classList + ' is-invalid'
                    field.focus();
                    setTimeout(function() {
                        document.querySelector("#"+name).classList.remove('is-invalid');
                    },3000);

                },
                faltanCompletarDatos: function () {
                    if(this.publicacion.titulo == '') {
                        this.darError("@lang('proceso.messages.validations.title-required')",this.$refs.titulo,"titulo");
                        return true;
                    }

                    if(this.publicacion.fecha_inicio == '') {
                        this.darError("@lang('proceso.messages.validations.end-date-required')",this.$refs.fecha_inicio,"fecha_inicio");
                        return true;
                    }

                    if(this.publicacion.hora_inicio == '') {
                        this.darError("@lang('proceso.messages.validations.start-time-required')",this.$refs.hora_inicio,"hora_inicio");
                        return true;
                    }

                    if(this.publicacion.preferencia_pago == '') {
                        this.darError("@lang('proceso.messages.validations.payment-preference-required')",this.$refs.preferencia_pago,"preferencia_pago");
                        return true;
                    }

                    if(this.publicacion.detalles == '') {
                        this.darError("@lang('proceso.messages.validations.detail-publication-required')",this.$refs.detalles,"detalles");
                        return true;
                    }

                    if(this.publicacion.fecha_entrega == '') {
                        this.darError("@lang('proceso.messages.validations.delivery-date-required')",this.$refs.fecha_entrega,"fecha_entrega");
                        return true;
                    }

                    if(this.publicacion.provincia_id == '') {
                        this.darError("@lang('proceso.messages.validations.province-required')",this.$refs.provincia_id,"provincia_id");
                        return true;
                    }

                    if(this.publicacion.localidad_id == '') {
                        this.darError("@lang('proceso.messages.validations.locality-required')",this.$refs.localidad_id,"localidad_id");
                        return true;
                    }

                    if(this.items.length == 0)
                    {
                        errorWadaboo("@lang('proceso.messages.validations.items-required')","@lang('proceso.messages.attention')");
                        return true;
                    }

                    return false;
                },

                agregarItem: function()
                {
                    if(this.validarCampos())
                    {
                        this.item.categoria = $("#ItemCategoria option:selected").text();
                        this.item.desc_subcategoria = $("#ItemSubcategoria option:selected").text();
                        // console.log($("#ItemSubcategoria option:selected").text());


                        var data = new Object();
                        data = {
                            ...this.item
                        };
                        this.item.unidad = $("#ItemUnidad option:selected").text();

                        data._token = $('meta[name="csrf-token"]').attr('content');
                        data.proceso_id = this.publicacion.id;
                        vm.errors = [];
                        $(".preloader").fadeIn();
                        $.ajax({
                            url: "{{ Route('items/store') }}",
                            method: 'POST',
                            data: data,
                            dataType: 'json',
                            success: function (id) {
                                vm.item.id = id;
                                var nuevo = true;
                                $.each(vm.items, function(key, object) {
                                    if(object.id == id)
                                    {
                                        Vue.set(vm.items, key, vm.item);
                                        nuevo = false;
                                    }
                                });

                                if(nuevo)
                                {
                                    vm.items.push(_.cloneDeep(vm.item));
                                }
                            },
                        }).done(function( msg ) {
                            $(".preloader").fadeOut();
                        });

                        $("#form-item").modal('hide');
                        //this.limpiarItem();

                        if(this.items.length < 15)
                        {
                            successWadaboo("@lang('proceso.messages.well-done-you-can-keep')", "@lang('proceso.messages.attention')");
                            $("html, body").animate({scrollTop: $('#ItemNombre').offset().top - 150}, "slow");
                        }
                        else
                        {
                            successWadaboo("@lang('proceso.messages.well-done-the-item-limit')", "@lang('proceso.messages.attention')");
                            $("html, body").animate({scrollTop: $('#ItemNombre').offset().top - 150}, "slow");
                        }




                    }
                    else{
                        Swal.fire({
                            type: 'error',
                            text: "@lang('proceso.messages.validations.complete-all-fields')"
                        });

                    }
                },
                eliminarItem: function(item)
                {
                    Swal.fire({
                        title: "@lang('proceso.messages.validations.confirm-delete-item')",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: "@lang('common.buttons.delete')",
                        cancelButtonText: "@lang('common.buttons.cancel')",
                        allowOutsideClick: false
                    }).then((result) => {
                        if(result.value)
                        {
                            var data = new Object();
                            vm.item.id = item.id;
                            data.item_id = item.id;
                            data._token = $('meta[name="csrf-token"]').attr('content');
                            $(".preloader").fadeIn();
                            $.ajax({
                                url: "{{ Route('items/eliminar_item') }}",
                                method: 'POST',
                                data: data,
                                dataType: 'json',
                                success: function (data) {
                                    var id = 0;
                                    $.each(vm.items, function(key, object) {

                                        if(object.id == vm.item.id)
                                        {
                                            id = key;
                                        }
                                    });
                                    vm.$delete(vm.items,id);
                                    Swal.fire({
                                        title: "@lang('proceso.messages.validations.deleted')",
                                        text: "@lang('proceso.messages.validations.the-item-was-deleted')",
                                        type: 'success',
                                        allowOutsideClick: false
                                    });
                                },
                                error: function (jqXHR) {
                                }
                            }).done(function(){
                                $(".preloader").fadeOut();
                            });

                        }
                    });
                },
                limpiarItem: function()
                {
                    this.item.id = '';
                    this.item.nombre = '';
                    this.item.categoria_id = null;
                    this.item.subcategoria_id = null;
                    this.item.especificaciones = '';
                    this.item.cantidad = '';
                    this.item.unidad = '';
                    this.item.requiere_muestra = '';
                    this.item.precio_maximo = '';
                },
                validarCampos: function()
                {
                    if(this.item.nombre == "" || this.item.categoria_id == "" ||
                        this.item.subcategoria_id == ""  ||
                        this.item.cantidad == "" ||  this.item.unidad == "" ||  this.item.requiere_muestra == "")
                    {
                        return false;
                    }

                    if(this.item.cantidad == 0)
                    {
                        return false;
                    }

                    return true;
                },
                modificarItem: function(item)
                {
                    //console.log(item);
                    //var unidad = "";
                    //console.log(unidad);
                    this.item.id = item.id;
                    this.item.nombre = item.nombre;
                    this.item.categoria_id = item.categoria_id;
                    this.item.subcategoria_id = item.subcategoria_id;
                    this.item.especificaciones = item.especificaciones;
                    this.item.cantidad = item.cantidad;
                    this.item.unidad = item.unidad;
                    this.item.requiere_muestra = item.requiere_muestra;
                    this.item.precio_maximo = item.precio_maximo;
                    change_subcategoria(item.categoria_id,item.subcategoria_id);
                    var element = "";
                    $("#ItemUnidad > option").each(function() {
                        if ($(this).text() == item.unidad) {
                            element = $(this).val();
                        }
                    });
                    if(element != "") {
                        this.item.unidad = element;
                    }

                    $("#form-item").modal(function(){show:true});

                },
                guardar: function()
                {
                    if(this.faltanCompletarDatos()) {
                        return;
                    }


                    Swal.fire({
                        title: "@lang('proceso.messages.validations.confirm-save-publication')",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: "@lang('proceso.messages.validations.yes-save')",
                        cancelButtonText: "@lang('proceso.messages.validations.cancel')",
                        allowOutsideClick: false
                    }).then((result) => {
                        if(result.value)
                        {
                            var data = new Object();
                            data.id = this.publicacion.id;
                            data.titulo = this.publicacion.titulo;
                            data.fecha_inicio = this.publicacion.fecha_inicio;
                            data.hora_inicio = this.publicacion.hora_inicio;
                            data.detalles = this.publicacion.detalles;
                            data.fecha_entrega = this.publicacion.fecha_entrega;
                            data.preferencia_pago = this.publicacion.preferencia_pago;
                            data.provincia_id = this.publicacion.provincia_id;
                            data.localidad_id = this.publicacion.localidad_id;
                            data._token = $('meta[name="csrf-token"]').attr('content');
                            vm.errors = [];
                            $(".preloader").fadeIn();

                            $.ajax({
                                url: "{{ Route('procesos.store') }}",
                                method: 'POST',
                                data: data,
                                dataType: 'json',
                                success: function (data) {
                                    Swal.fire({
                                        title: "@lang('proceso.messages.validations.saved')",
                                        text: "@lang('proceso.messages.validations.publication-saved')",
                                        type: 'success',
                                        allowOutsideClick: false
                                    }).then(() => {
                                        window.location = "{{ url('/home') }}";
                                    });
                                }
                            }).done(function(){
                                $(".preloader").fadeOut();
                            });
                        }
                    });
                }
            }
        });

        @if(isset($proceso))
            vm.publicacion.id = "{{ $proceso->id }}";
            vm.publicacion.titulo = "{{ $proceso->titulo }}";
            vm.publicacion.fecha_inicio = "{{ $proceso->fecha_inicio }}";
            vm.publicacion.hora_inicio = "{{ $proceso->hora_inicio }}";
            vm.publicacion.detalles = "{{ $proceso->detalles }}";
            vm.publicacion.fecha_entrega = "{{ $proceso->fecha_entrega }}";
            vm.publicacion.preferencia_pago = "{{ $proceso->preferencia_pago }}";
            vm.publicacion.punto_entrega = "{{ $proceso->punto_entrega }}";
            vm.items = JSON.parse(@json($proceso->items->toJson()));
            @if(is_object($proceso->localidad))
                vm.publicacion.provincia_id = "{{ $proceso->localidad->provincia_id }}";
                vm.publicacion.localidad_id = "{{ $proceso->localidad_id }}";
            @else
                vm.publicacion.provincia_id = "{{ auth()->user()->provincia_id }}";
                vm.publicacion.localidad_id = "{{ auth()->user()->localidad_id }}";
            @endif
        @else

            vm.publicacion.provincia_id = "{{ auth()->user()->provincia_id }}";
            vm.publicacion.localidad_id = "{{ auth()->user()->localidad_id }}";

        @endif

        $("document").ready(function(){
            cargarLocalidades(vm.publicacion.localidad_id);

            var hoy = moment().format('DD/MM/YYYY');
            var dateToday = new Date();
            var inicio_subasta = new Date(dateToday.setDate(dateToday.getDate() + 3));
            var fecha_inicio;

            if ($("#ProcesoFechaInicio1").val()) {
                fecha_inicio = $("#ProcesoFechaInicio1").val();
            }

            $("#fecha_inicio").datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'dd/mm/yyyy',
                daysOfWeekDisabled: [0, 6],
                weekStart: [1],
                language: "@lang('proceso.create-edit-auction.language')",
                orientation: "bottom",
                startDate: inicio_subasta
            });

            $("#fecha_inicio").datepicker().on('changeDate', function (e) {
                vm.publicacion.fecha_inicio = $('#fecha_inicio').val()

                var fechaEntrega = new Date(e.date.setDate(e.date.getDate() + 1));
                $("#fecha_entrega").val('');
                $("#fecha_entrega").datepicker('destroy');
                $("#fecha_entrega").datepicker({
                    autoclose: true,
                    format: 'dd/mm/yyyy',
                    daysOfWeekDisabled: [0, 6],
                    weekStart: [1],
                    language: "@lang('proceso.create-edit-auction.language')",
                    orientation: "bottom",
                    startDate: fechaEntrega
                });
            });

            $("#fecha_entrega").datepicker().on('changeDate', function (e) {

                vm.publicacion.fecha_entrega = $('#fecha_entrega').val()

            });




            $("#agregarItem").click(function(){
                vm.limpiarItem();
                $("#form-item").modal(function(){show:true});
            });

            $("#provincia_id").change(function(){
                cargarLocalidades();
            });

            minimizarMensajesCards();


        });



    </script>
@endsection
