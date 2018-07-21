
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/admin/plugins/images/favicon.png') }}">
    <title>Đặt lại mật khẩu Admin</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('assets/admin/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/plugin/bootstrap-extension/css/bootstrap-extension.css') }}" rel="stylesheet">

    <!--toast CSS-->
    <link href="{{ asset('assets/admin/plugin/toast-master/css/jquery.toast.css') }}" rel="stylesheet">

    <!-- animation CSS -->
    <link href="{{ asset('assets/admin/plugin/toast-master/css/jquery.toast.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/admin/css/animate.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('assets/admin/css/style.css') }}" rel="stylesheet">
    <!-- color CSS -->
    <link href="{{ asset('assets/admin/css/colors/blue.css') }}" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<!-- Preloader -->
<div class="preloader">
    <div class="cssload-speeding-wheel"></div>
</div>
<section id="wrapper" class="login-register">
    <div class="login-box">
        <div class="white-box">
            <form class="form-horizontal form-material" id="loginform" method="POST" action="{{ route('admin.password.reset') }}">
                @csrf()
                @method('post')
                <h3 class="box-title m-b-20">Đặt lại mật khẩu</h3>
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input class="form-control" id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required autofocus placeholder="E-mail">
                    </div>
                </div>
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input class="form-control" id="password" type="password" name="password" required placeholder="Mật khẩu">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" id="password-confirm" type="password" name="password_confirmation" required placeholder="Nhập lại mật khẩu">
                    </div>
                </div>
                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Xác nhận</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- jQuery -->
<script src="{{ asset('assets/admin/plugin/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('assets/admin/bootstrap/dist/js/tether.min.js') }}"></script>
<script src="{{ asset('assets/admin/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugin/bootstrap-extension/js/bootstrap-extension.min.js') }}"></script>
<!-- Menu Plugin JavaScript -->
<script src="{{ asset('assets/admin/plugin/sidebar-nav/dist/sidebar-nav.min.js') }}"></script>
<!--slimscroll JavaScript -->
<script src="{{ asset('assets/admin/js/jquery.slimscroll.js') }}"></script>
<!--toast-->
<script src="{{ asset('assets/admin/plugin/toast-master/js/jquery.toast.js') }}"></script>
<!--Wave Effects -->
<script src="{{ asset('assets/admin/js/waves.js') }}"></script>
<!-- Custom Theme JavaScript -->
<script src="{{ asset('assets/admin/js/custom.min.js') }}"></script>
<!--Style Switcher -->
<script src="{{ asset('assets/admin/plugin/styleswitcher/jQuery.style.switcher.js') }}"></script>
@include('admin.notice.error')
</body>

</html>
