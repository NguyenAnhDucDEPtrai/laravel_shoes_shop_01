<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cửa hàng giày</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin-assets/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/css/custom.css') }}">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h3">Quản trị viên</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Đăng ký tài khoản</p>
                <form method="POST" action="{{ route('admin.register') }}">
                    @csrf
                    <div class="input-group mt-3">
                        <input value="{{ old('name') }}" name="name" type="text" class="form-control" placeholder="Tên người dùng" class="@error('name') is-invalid @enderror">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="input-group mt-3">
                        <input value="{{ old('email') }}" name="email" type="text" class="form-control" placeholder="Email" class="@error('email') is-invalid @enderror">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="input-group mt-3">
                        <input value="{{ old('password') }}" name="password" type="password" class="form-control" placeholder="Mật khẩu" class="@error('password') is-invalid @enderror">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="input-group mt-3">
                        <input value="{{ old('password_confirmation') }}" name="password_confirmation" type="password" class="form-control" placeholder="Xác nhận mật khẩu" class="@error('password_confirmation') is-invalid @enderror">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    @error('password_confirmation')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="input-group mt-3">
                        <input value="{{ old('phone_number') }}" name="phone_number" type="text" class="form-control" placeholder="Số điện thoại" class="@error('phone_number') is-invalid @enderror">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    @error('phone_number')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="input-group mt-3">
                        <input value="{{ old('address') }}" name="address" type="text" class="form-control" placeholder="Địa chỉ" class="@error('address') is-invalid @enderror">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    @error('address')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="row mt-3">

                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Đăng ký</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <p class="mb-1 mt-3">
                    <a href="{{ route('admin.view_login') }}">Đăng nhập</a>
                </p>
            </div>
        </div>
    </div>
    <!-- ./wrapper -->
    <!-- jQuery -->
    <script src="{{ asset('admin-assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('admin-assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin-assets/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="{{ asset('js/demo.js') }}"></script> -->
</body>

</html>