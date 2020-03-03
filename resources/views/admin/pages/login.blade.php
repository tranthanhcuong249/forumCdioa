<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Đăng Nhập</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="{{asset('')}}" >
    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="{{asset('libraries/admin/vendors/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('libraries/admin/vendors/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('libraries/admin/vendors/themify-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('libraries/admin/vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{asset('libraries/admin/vendors/selectFX/css/cs-skin-elastic.css')}}">
    <link rel="stylesheet" href="{{asset('libraries/admin/assets/css/style.css')}}">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>

<body class="bg-dark">


<div class="sufee-login d-flex align-content-center flex-wrap">
    <div class="container">
        <div class="login-content">
            <div class="login-logo">
                <a href="#">
                    <img class="align-content" src="{{asset('libraries/admin/images/logo.png')}}" alt="">
                </a>
            </div>
            <div class="login-form">
                <form action="{{ route('admin.login') }}" method="POST" >
                    @csrf
                    <div class="form-group">
                        <label>Email address</label>
                        <input type="email" name="email" class="form-control" placeholder="Nhập email Admin">
                        @error('email')
                        <span style="color: red; font-weight: 600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu Admin">
                        @error('password')
                        <span style="color: red; font-weight: 600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember"> Ghi nhớ đăng nhập
                        </label>
                        <label class="pull-right">
                            <a href="#">Forgotten Password?</a>
                        </label>

                    </div>
                    <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
                    <div class="register-link m-t-15 text-center">
                        <p>Don't have account ? <a href="#"> Sign Up Here</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="{{asset('libraries/admin/vendors/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('libraries/admin/vendors/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{asset('libraries/admin/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('libraries/admin/assets/js/main.js')}}"></script>


</body>
@if(session('thongbao'))
    <script type="text/javascript">
        toastr.success('{{session('thongbao')}}','Thông báo', {timeOut:5000})
    </script>
@endif

</html>
@if(session('thongbaoloi'))
    <script type="text/javascript">
        {{--function() {--}}
        {{--    this.toastr.error('{{session('thongbaoloi')}}','Thông báo', {timeOut:5000})--}}
        {{--}--}}
        alert("{{ session('thongbaoloi') }}");

    </script>
@endif
