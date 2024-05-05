<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">Contribute by SS5 Semester 2</div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
{{-- Dashboard report today --}}
<script src="{{asset('backend/assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset('backend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
{{--<script src="{{asset('backend/assets/vendor/chart.js/chart.umd.js')}}"></script>--}}
<script src="{{asset('backend/assets/vendor/echarts/echarts.min.js')}}"></script>
{{--<script src="{{asset('backend/assets/vendor/quill/quill.min.js')}}"></script>--}}
{{--<script src="{{asset('backend/assets/vendor/simple-datatables/simple-datatables.js')}}"></script>--}}
{{--<script src="{{asset('backend/assets/vendor/tinymce/tinymce.min.js')}}"></script>--}}
<script src="{{asset('backend/assets/vendor/php-email-form/validate.js')}}"></script>
<!-- Template Main JS File -->
{{--<script src="{{asset('backend/assets/js/main.js')}}"></script>--}}
<script src="{{asset('backend/assets/vendor/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('backend/assets/vendor/DataTables/datatables.js')}}"></script>
{{--  Import function validate input number  --}}
<script src="{{ asset('func_utils/ValidateNumber.js') }}"></script>
@yield('myScript')
</body>

</html>
