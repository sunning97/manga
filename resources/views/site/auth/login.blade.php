
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <title>Đăng nhập</title>

    <!-- Styles -->
    <link href="{{ asset('assets/site/css/page.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/site/css/style.css') }}" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="../assets/img/apple-touch-icon.png">
    <link rel="icon" href="../assets/img/favicon.png">
</head>

<body class="layout-centered bg-img" style="background-image: url({{ asset('') }});">


<!-- Main Content -->
<main class="main-content">

    <div class="bg-white rounded shadow-7 w-400 mw-100 p-6">
        <h5 class="mb-7">Đăng nhập vào tài khoản của bạn</h5>
        @if($errors->has('user-inactive'))
            <span style="color: red;"><strong>{{ $errors->first('user-inactive') }}</strong></span>
        @endif
        @if($errors->has('no-account'))
            <span style="color: red;"><strong>{{ $errors->first('no-account') }}</strong></span>
        @endif
        @if($errors->has('user-banned'))
            <span style="color: red;"><strong>{{ $errors->first('user-banned') }}</strong></span>
        @endif
        <form action="{{ route('login.submit') }}" method="post">
            @csrf
            @method('post')
            <div class="form-group">
                <input type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }} {{ $errors->has('invalid-account') ? 'is-invalid' : '' }}" name="email" placeholder="Email" value="{{ old('email') }}">
                @if ($errors->has('email') || $errors->has('invalid-account'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') ? $errors->first('email') : $errors->first('invalid-account') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : ''}}" name="password" placeholder="Mật khẩu">
                @if($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group flexbox py-3">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="remember">
                    <label class="custom-control-label">Nhơ mật khẩu</label>
                </div>

                <a class="text-muted small-2" href="user-recover.html">Quên mật khẩu?</a>
            </div>

            <div class="form-group">
                <button class="btn btn-block btn-primary" type="submit">Đăng nhập</button>
            </div>
        </form>
        <hr class="w-30">

        <p class="text-center text-muted small-2">Bạn chưa có tài khoản? <a href="{{ route('register') }}">Đăng kí ngay</a></p>
    </div>

</main><!-- /.main-content -->


<!-- Scripts -->
<script src="{{ asset('assets/site/js/page.min.js') }}"></script>
<script src="{{ asset('assets/site/js/scriptt.js') }}"></script>

</body>

<!-- Mirrored from thetheme.io/thesaas/page/user-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 05 Aug 2018 03:51:41 GMT -->
</html>
