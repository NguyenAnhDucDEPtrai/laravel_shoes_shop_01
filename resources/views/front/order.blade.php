@include('front.layouts.header')
<main>
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.home') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('cart.show') }}">Giỏ hàng</a></li>
                    <li class="breadcrumb-item">Đặt hàng</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-9 pt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="sub-title">
                        <h2>Địa chỉ giao hàng</h2>
                    </div>
                    <div class="card shadow-lg border-0">
                        <div class="card-body checkout-form">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="">Tên người dùng</label>
                                        <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="">Email</label>
                                        <input type="text" class="form-control" value="{{ $user->email }}" readonly>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="">Số điện thoại</label>
                                        <input type="text" class="form-control" value="{{ $user->phone_number }}" readonly>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="">Địa chỉ</label>
                                        <textarea cols="30" rows="3" class="form-control" readonly>{{ $user->address }}</textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="sub-title">
                        <h2>Tóm tắt đơn hàng</h3>
                    </div>
                    <div class="card cart-summery">
                        <div class="card-body">

                            @foreach($cart as $item)
                            <div class="d-flex justify-content-between pb-2">
                                <div class="h6">{{ $item['shoe_name'] }} X {{ $item['quantity'] }}</div>
                                <div class="h6">{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} đ</div>
                            </div>
                            @endforeach

                            <div class="d-flex justify-content-between mt-2 summery-end">
                                <div class="h5"><strong>Tổng</strong></div>
                                <div class="h5"><strong>{{ number_format($total, 0, ',', '.') }} đ</strong></div>
                            </div>
                        </div>
                    </div>

                    <div class="card payment-form ">
                        <!-- <h3 class="card-title h5 mb-3">Payment Details</h3> -->
                        <div class="card-body p-0">
                            <!-- <div class="mb-3">
                                <label for="card_number" class="mb-2">Card Number</label>
                                <input type="text" name="card_number" id="card_number" placeholder="Valid Card Number" class="form-control">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="expiry_date" class="mb-2">Expiry Date</label>
                                    <input type="text" name="expiry_date" id="expiry_date" placeholder="MM/YYYY" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="expiry_date" class="mb-2">CVV Code</label>
                                    <input type="text" name="expiry_date" id="expiry_date" placeholder="123" class="form-control">
                                </div>
                            </div> -->
                            <form action="{{ route('front.order.place') }}" method="POST">
                                @csrf
                                <div class="pt-4">
                                    <button type="submit" class="btn-dark btn btn-block w-100">Đặt hàng ngay</button>
                                </div>
                            </form>

                        </div>
                    </div>


                    <!-- CREDIT CARD FORM ENDS HERE -->

                </div>
            </div>
        </div>
    </section>
</main>
@include('front.layouts.footer')