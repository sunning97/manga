<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <title>Đăng kí</title>

    <!-- Styles -->
    <link href="{{ asset('assets/site/css/page.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/site/css/style.css') }}" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="../assets/img/apple-touch-icon.png">
    <link rel="icon" href="../assets/img/favicon.png">
</head>

<body class="layout-centered bg-img" style="background-image: url(../assets/img/bg/4.jpg);">


<!-- Main Content -->
<main class="main-content">

    <div class="bg-white rounded shadow-7 w-400 mw-100 p-6">
        <h5 class="mb-7">Tạo mới tài khoản</h5>

        <form action="{{ route('register.submit') }}" method="post">
            @csrf
            @method('post')
            <div class="form-group">
                <input type="text" class="form-control {{ $errors->has('f_name') ? 'is-invalid' : '' }}" name="f_name" placeholder="Họ" value="{{ old('f_name') }}">
                @if($errors->has('f_name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('f_name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <input type="text" class="form-control {{ $errors->has('l_name') ? 'is-invalid' : '' }}" name="l_name" placeholder="Tên" value="{{ old('l_name') }}">
                @if($errors->has('l_name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('l_name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid'  : '' }}" name="email" placeholder="Email Address" value="{{ old('email') }}">
                @if($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : ''  }}" name="password" placeholder="Mật khẩu">
                @if($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <input type="password" class="form-control" name="password_confirmation" placeholder="Nhập lại mật khẩu">
            </div>

            <div class="form-group py-3">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input {{ $errors->has('term') ? 'is-invalid' : '' }}" name="agree_term">
                    <label class="custom-control-label">Tôi đồng ý với <a class="ml-1" href="terms.html">điều khoản của hệ thống</a></label>
                    @if($errors->has('term'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('term') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-block btn-primary" type="submit">Đăng kí</button>
            </div>
        </form>

        <hr class="w-30">

        <p class="text-center text-muted small-2">Bạn đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập ngay</a></p>
    </div>

</main><!-- /.main-content -->


<!-- Scripts -->
<script src="{{ asset('assets/site/js/page.min.js') }}"></script>
<script src="{{ asset('assets/site/js/scriptt.js') }}"></script>

</body>

</html>
