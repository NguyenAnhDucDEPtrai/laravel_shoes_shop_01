@include('front.layouts.header')
<main>
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="#">Tài khoản</a></li>
                    <li class="breadcrumb-item">Cài đặt</li>
                </ol>
            </div>
        </div>
    </section>

    <section class=" section-11 ">
        <div class="container  mt-5">
            <div class="row">
                <div class="col-md-3">
                    @include('front.layouts.account-panel')
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="h5 mb-0 pt-2 pb-2">Đổi mật khẩu</h2>
                        </div>

                        @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif

                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                        <div class="card-body p-4">
                            <div class="row">
                                <form action="{{ route('changePassword') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="current_password">Mật khẩu cũ</label>
                                        <input type="password" id="current_password" name="current_password" placeholder="Mật khẩu cũ" class="form-control">
                                        @error('current_password')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="new_password">Mật khẩu mới</label>
                                        <input type="password" id="new_password" name="new_password" placeholder="Mật khẩu mới" class="form-control">
                                        @error('new_password')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="new_password_confirmation">Xác nhận mật khẩu mới</label>
                                        <input type="password" id="new_password_confirmation" name="new_password_confirmation" placeholder="Xác nhận mật khẩu mới" class="form-control">
                                        @error('new_password_confirmation')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="d-flex">
                                        <button type="submit" class="btn btn-dark">Lưu</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@include('front.layouts.footer')