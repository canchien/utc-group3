<!-- jQuery 3 -->
<script src="{{ asset('backend/js/jquery-3.3.1.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('backend/js/fastclick/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend/js/adminlte.js') }}"></script>
<!-- Sparkline -->
<!-- <script src="{{ asset('backend/js/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script> -->
<!-- jvectormap  -->
<script src="{{ asset('backend/js/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('backend/js/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ asset('backend/js/jquery.slimscroll.min.js') }}"></script>
<!-- ChartJS -->
<!-- <script src="{{ asset('backend/js/chart.js/Chart.js') }}"></script> -->

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="{{ asset('backend/js/dashboard2.js') }}"></script>     -->

<script src="{{ asset('backend/js/sweetalert2.js') }}"></script>
<script src="{{ asset('backend/js/sweetalert.min.js') }}"></script>
<script src="{{ asset('backend/js/validator/jquery.form-validator.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('backend/js/demo.js') }}"></script>
<script src="{{ asset('backend/js/mainFunc.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
</script>
@yield('js')