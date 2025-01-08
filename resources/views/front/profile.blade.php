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
                            <h2 class="h5 mb-0 pt-2 pb-2">Thông tin cá nhân</h2>
                        </div>

                        @if(session('success'))
                        <div class="alert alert-success mt-3">
                            {{ session('success') }}
                        </div>
                        @endif

                        <div class="card-body p-4">
                            <form action="{{ route('front.updateProfile') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="mb-3">
                                        <label for="name">Tên người dùng</label>
                                        <input type="text" name="name" id="name" placeholder="Nhập tên" class="form-control" value="{{ old('name', $user->name) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" id="email" placeholder="Nhập Email" class="form-control" value="{{ old('email', $user->email) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone">Số điện thoại</label>
                                        <input type="text" name="phone" id="phone" placeholder="Nhập số điện thoại" class="form-control" value="{{ old('phone', $user->phone_number) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="address">Địa chỉ</label>
                                        <textarea name="address" id="address" class="form-control" cols="30" rows="5" placeholder="Nhập địa chỉ">{{ old('address', $user->address) }}</textarea>
                                    </div>
                                    <div class="d-flex">
                                        <button class="btn btn-dark">Cập nhật</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@include('front.layouts.footer')