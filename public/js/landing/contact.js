
var vm = new Vue({
    el: '#form-contact',
    data:{
        form: {
            nombre: '',
            email: '',
            asunto: '',
            telefono: '',
            mensaje: ''
        }
    },
    methods: {
        enviarEmail: function() {
            console.log(this.form);
        }
    }
});
