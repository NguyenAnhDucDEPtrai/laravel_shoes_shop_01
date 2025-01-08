@include('front.layouts.header')
<main>
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.home') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item">Đăng nhập</li>
                </ol>
            </div>
        </div>
    </section>

    <section class=" section-10">
        <div class="container">
            <div class="login-form">

                @if(session('error'))
                <div class="alert alert-danger mt-3">
                    {{ session('error') }}
                </div>
                @endif
                @if(session('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
                @endif
                <form action="{{ route('front.auth.login') }}" method="POST">
                    @csrf
                    <h4 class="modal-title">Đăng nhập vào tài khoản cuản bạn</h4>
                    <div class="form-group">
                        <input value="{{ old('email') }}" name="email" type="text" class="form-control" placeholder="Email">
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input name="password" type="password" class="form-control" placeholder="Mật khẩu">
                        @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <input type="submit" class="btn btn-dark btn-block btn-lg" value="Đăng nhập">
                </form>
                <div class="text-center small">Bạn chưa có tài khoản? <a href="{{ route('front.auth.showRegister') }}">Đăng ký</a></div>
            </div>
        </div>
    </section>
</main>
@include('front.layouts.footer')