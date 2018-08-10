<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
    <title>Không tìm thấy trang</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('assets/admin/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/plugin/bootstrap-extension/css/bootstrap-extension.css') }}" rel="stylesheet">
    <!-- animation CSS -->
    <link href="{{ asset('assets/admin/css/animate.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('assets/admin/css/style.css') }}" rel="stylesheet">
    <!-- color CSS -->
    <link href="css/colors/default.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<section id="wrapper" class="error-page">
    <div class="error-box">
        <div class="error-body text-center">
            <h1>404</h1>
            <h3 class="text-uppercase">Không tìm thấy trang !</h3>
            <p class="text-muted m-t-30 m-b-30">Có vẻ bạn đang cố gắng truy cập một trang không tồn tại</p>
            <a href="{{ route('home') }}" class="btn btn-info btn-rounded waves-effect waves-light m-b-40">Quay về trang chủ</a> </div>
        <footer class="footer text-center"></footer>
    </div>
</section>
<!-- jQuery -->
<script src="{{ asset('assets.admin/plugins/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('assets/admin/bootstrap/dist/js/tether.min.js') }}"></script>
<script src="{{ asset('assets/admin/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugin/bootstrap-extension/js/bootstrap-extension.min.js') }}"></script>
<!-- Custom Theme JavaScript -->
<script src="{{ asset('assets/admin/js/custom.min.js') }}"></script>
</body>

</html>
