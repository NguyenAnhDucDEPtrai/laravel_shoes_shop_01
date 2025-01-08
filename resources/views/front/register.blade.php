@include('front.layouts.header')
<main>
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.home') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item">Đăng ký</li>
                </ol>
            </div>
        </div>
    </section>

    <section class=" section-10">
        <div class="container">
            <div class="login-form">
                <form method="POST" action="{{ route('front.auth.register') }}">
                    @csrf
                    <h4 class="modal-title">Đăng ký ngay</h4>
                    <div class="form-group">
                        <input value="{{ old('name') }}" name="name" type="text" class="form-control" placeholder="Tên người dùng" class="@error('name') is-invalid @enderror">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input value="{{ old('email') }}" name="email" type="text" class="form-control" placeholder="Email" class="@error('email') is-invalid @enderror">
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input value="{{ old('password') }}" name="password" type="password" class="form-control" placeholder="Mật khẩu" class="@error('password') is-invalid @enderror">
                        @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input value="{{ old('password_confirmation') }}" name="password_confirmation" type="password" class="form-control" placeholder="Xác nhận mật khẩu" class="@error('password_confirmation') is-invalid @enderror">
                        @error('password_confirmation')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input value="{{ old('phone_number') }}" name="phone_number" type="text" class="form-control" placeholder="Số điện thoại" class="@error('phone_number') is-invalid @enderror">
                        @error('phone_number')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input value="{{ old('address') }}" name="address" type="text" class="form-control" placeholder="Địa chỉ" class="@error('address') is-invalid @enderror">
                        @error('address')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-dark btn-block btn-lg" value="Register">Đăng ký</button>
                </form>
                <div class="text-center small">Bạn đã có tài khoản? <a href="{{ route('front.auth.showLogin') }}">Đăng nhập ngay</a></div>
            </div>
        </div>
    </section>
</main>
@include('front.layouts.footer')