<!-- Latest jQuery -->
<script src="{{ asset('js/landing/jquery-3.6.0.min.js') }}"></script>
<!-- Latest compiled and minified Bootstrap -->
<script src="{{ asset('js/landing/bootstrap.min.js') }}"></script>
<!-- owl-carousel min js  -->
<script src="{{ asset('js/landing/owl.carousel.min.js') }}"></script>
<!-- magnific-popup min js  -->
<script src="{{ asset('js/landing/magnific-popup.min.js') }} "></script>
<!-- waypoints min js  -->
<script src="{{ asset('js/landing/waypoints.min.js') }}"></script>
<!-- parallax js  -->
<script src="{{ asset('js/landing/parallax.js') }}"></script>
<!-- countdown js  -->
<script src="{{ asset('js/landing/jquery.countdown.min.js') }}"></script>
<!-- scripts js -->
<script src="{{ asset('js/landing/jquery.dd.min.js') }}"></script>
<!-- jquery.counterup.min js -->
<script src="{{ asset('js/landing/jquery.counterup.min.js') }}"></script>
<!-- scripts js -->
<script src="{{ asset('js/landing/scripts.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

<script src="{{ asset('js/landing/contact.js') }}"></script>

<script>
    $("#lng_select2").change(function(){
        window.location.replace("setlocale/" + $("#lng_select2").val());
    });
</script>
