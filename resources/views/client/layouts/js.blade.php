<script src="assets/client/js/jquery-2.2.3.min.js"></script>
<script src="assets/client/js/jquery.magnific-popup.js"></script>
<script src="assets/client/js/minicart.js"></script>
<script src="assets/client/js/scroll.js"></script>
<script src="assets/client/js/SmoothScroll.min.js"></script>
<script src="assets/client/js/move-top.js"></script>
<script src="assets/client/js/easing.js"></script>
<script src="assets/client/js/bootstrap.js"></script>
<script src="{{asset('libraries/admin/js/toastr.min.js')}}"></script>
<script src="{{asset('assets/client/js/custom.js')}}"></script>
<script src="{{asset('assets/client/js/ajax.js')}}"></script>
@if(session('thongbao'))
    <script type="text/javascript">
        toastr.success('{{session('thongbao')}}','Thông báo', {timeOut:5000})
    </script>
@endif
@if(session('error'))
    <script type="text/javascript">
        toastr.errors('{{session('error')}}','Thông báo', {timeOut:5000})
    </script>
@endif
