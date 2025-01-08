@include('front.layouts.header')

<main>
    <section class="section-1">
        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="false">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <!-- <img src="images/carousel-1.jpg" class="d-block w-100" alt=""> -->

                    <picture>
                        <source media="(max-width: 799px)" srcset="{{ asset('front-assets/images/carousel-1-m.jpg') }}" />
                        <source media="(min-width: 800px)" srcset="{{ asset('front-assets/images/carousel-1.jpg') }}" />
                        <img src="{{ asset('front-assets/images/carousel-1.jpg') }}" alt="" />
                    </picture>

                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3">
                            <h1 class="display-4 text-white mb-3">Thời Trang Cho Trẻ Em</h1>
                            <p class="mx-md-5 px-5">Khám phá bộ sưu tập thời trang đa dạng và phong cách cho trẻ em. Với những thiết kế đáng yêu và chất lượng vượt trội, giúp các bé luôn cảm thấy thoải mái và tự tin trong mỗi dịp đi chơi hoặc đến trường.</p>
                            <a class="btn btn-outline-light py-2 px-4 mt-3" href="{{ route('front.shopByBrand', $brands->first()->id) }}">Mua ngay</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">

                    <picture>
                        <source media="(max-width: 799px)" srcset="{{ asset('front-assets/images/carousel-2-m.jpg') }}" />
                        <source media="(min-width: 800px)" srcset="{{ asset('front-assets/images/carousel-2.jpg') }}" />
                        <img src="{{ asset('front-assets/images/carousel-2.jpg') }}" alt="" />
                    </picture>

                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3">
                            <h1 class="display-4 text-white mb-3">Thời Trang Nữ</h1>
                            <p class="mx-md-5 px-5">Khám phá những bộ sưu tập thời trang nữ đầy phong cách và xu hướng mới. Từ những bộ trang phục công sở thanh lịch đến những bộ váy đầm quyến rũ cho các buổi tiệc, tất cả đều mang lại sự tự tin và cuốn hút cho phái đẹp.</p>
                            <a class="btn btn-outline-light py-2 px-4 mt-3" href="{{ route('front.shopByBrand', $brands->first()->id) }}">Mua ngay</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <!-- <img src="images/carousel-3.jpg" class="d-block w-100" alt=""> -->

                    <picture>
                        <source media="(max-width: 799px)" srcset="{{ asset('front-assets/images/carousel-3-m.jpg') }}" />
                        <source media="(min-width: 800px)" srcset="{{ asset('front-assets/images/carousel-3.jpg') }}" />
                        <img src="{{ asset('front-assets/images/carousel-3.jpg') }}" alt="" />
                    </picture>

                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3">
                            <h1 class="display-4 text-white mb-3">Mua Sắm Online Giảm Giá 70% Trên Quần Áo Thương Hiệu</h1>
                            <p class="mx-md-5 px-5">Chỉ trong thời gian giới hạn, bạn có thể mua sắm những món đồ thời trang yêu thích với mức giá cực kỳ hấp dẫn lên đến 70% từ các thương hiệu nổi tiếng. Đừng bỏ lỡ cơ hội này để sở hữu những sản phẩm chất lượng với giá ưu đãi nhất!</p>
                            <a class="btn btn-outline-light py-2 px-4 mt-3" href="{{ route('front.shopByBrand', $brands->first()->id) }}">mua ngay</a>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    <section class="section-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="box shadow-lg">
                        <div class="fa icon fa-check text-primary m-0 mr-3"></div>
                        <h2 class="font-weight-semi-bold m-0">Sản phẩm chất lượng</h5>
                    </div>
                </div>
                <div class="col-lg-3 ">
                    <div class="box shadow-lg">
                        <div class="fa icon fa-shipping-fast text-primary m-0 mr-3"></div>
                        <h2 class="font-weight-semi-bold m-0">Miễn phí vận chuyển</h2>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="box shadow-lg">
                        <div class="fa icon fa-exchange-alt text-primary m-0 mr-3"></div>
                        <h2 class="font-weight-semi-bold m-0">Trong 14 ngày</h2>
                    </div>
                </div>
                <div class="col-lg-3 ">
                    <div class="box shadow-lg">
                        <div class="fa icon fa-phone-volume text-primary m-0 mr-3"></div>
                        <h2 class="font-weight-semi-bold m-0">Hỗ trợ 24/7</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-3">
        <div class="container">
            <div class="section-title">
                <h2>Thương hiệu</h2>
            </div>
            <div class="row pb-3">
                @foreach($brands as $brand)
                <div class="col-lg-3">
                    <div class="cat-card" style="min-height: 73px; ">
                        <div class="left">
                            <img src="{{ asset($brand->image) }}" alt="" class="img-fluid">
                        </div>
                        <div class="right">
                            <div class="cat-data">
                                <h2>{{ $brand->brand_name }}</h2>
                                <p>100 Products</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-4 pt-5">
        <div class="container">
            <div class="section-title">
                <h2>Sản phẩm tiêu biểu</h2>
            </div>
            <div class="row pb-3">

                @foreach ($shoes_random as $shoe)
                <div class="col-md-3">
                    <div class="card product-card">
                        <div class="product-image position-relative">
                            <a href="{{ route('front.shoeDetail', $shoe->id) }}" class="product-img">
                                <img class="card-img-top" src="{{ asset( $shoe->images->first()->image_url) }}" alt="">
                            </a>
                        </div>
                        <div class="card-body text-center mt-3">
                            <a class="h6 link" href="{{ route('front.shoeDetail', $shoe->id) }}">{{ $shoe->shoe_name }}</a>
                            <div class="price mt-2">
                                <span class="h5"><strong>{{ number_format($shoe->price, 0, ',', '.') }} đ</strong></span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section>

    <section class="section-4 pt-5">
        <div class="container">
            <div class="section-title">
                <h2>Sản phẩm mới nhất</h2>
            </div>
            <div class="row pb-3">
                @foreach ($shoes_last as $shoe)
                <div class="col-md-3">
                    <div class="card product-card">
                        <div class="product-image position-relative">
                            <a href="{{ route('front.shoeDetail', $shoe->id) }}" class="product-img">
                                <img class="card-img-top" src="{{ asset( $shoe->images->first()->image_url) }}" alt="">
                            </a>
                        </div>
                        <div class="card-body text-center mt-3">
                            <a class="h6 link" href="{{ route('front.shoeDetail', $shoe->id) }}">{{ $shoe->shoe_name }}</a>
                            <div class="price mt-2">
                                <span class="h5"><strong>{{ number_format($shoe->price, 0, ',', '.') }} đ</strong></span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</main>

@include('front.layouts.footer')