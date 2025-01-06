@include('front.layouts.header')

<main>
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="#">Home</a></li>
                    <li class="breadcrumb-item active">Shop</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-6 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3 sidebar">
                    <div class="sub-title">
                        <h2>Thương hiệu</h3>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="accordion accordion-flush" id="accordionExample">
                                {{$brand->brand_name}}
                                <img src="{{ asset($brand->image) }}" alt="">
                            </div>
                        </div>
                    </div>

                    <input type="hidden" value="{{ $brand->id }}" id="brand-id">

                    <div class="sub-title mt-5">
                        <h2>Danh mục</h3>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <form id="filterForm">
                                @foreach($categories as $category)
                                <div class="form-check mb-2">
                                    <input name="categories[]" class="form-check-input" type="checkbox" value="{{ $category->id }}" id="flexCheckDefault-{{$category->id}}">
                                    <label class="form-check-label" for="flexCheckDefault-{{$category->id}}">
                                        {{ $category->category_name }}
                                    </label>
                                </div>
                                @endforeach
                            </form>
                        </div>
                    </div>

                    <div class="sub-title mt-5">
                        <h2>Cỡ giày</h3>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <form id="filterForm">
                                @foreach($sizes as $size)
                                <div class="form-check mb-2">
                                    <input name="sizes[]" class="form-check-input" type="checkbox" value="{{ $size->id }}" id="size_flexCheckDefault-{{ $size->id }}">
                                    <label class="form-check-label" for="size_flexCheckDefault-{{ $size->id }}">
                                        {{ $size->size }}
                                    </label>
                                </div>
                                @endforeach
                            </form>
                        </div>
                    </div>


                </div>
                <div class="col-md-9">
                    <div class="row pb-3" id="shoe-list">
                        <!-- <div class="col-12 pb-1">
                            <div class="d-flex align-items-center justify-content-end mb-4">
                                <div class="ml-2">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-bs-toggle="dropdown">Sorting</button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">Latest</a>
                                            <a class="dropdown-item" href="#">Price High</a>
                                            <a class="dropdown-item" href="#">Price Low</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                        @include('front.partials.shoe-list', ['shoes' => $shoes])

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@include('front.layouts.footer')

<script>
    var brandId = document.getElementById('brand-id').value;
    // Sử dụng jQuery để gửi AJAX khi thay đổi checkbox
    var url = "{{ route('front.filterShoes', ':brand_id') }}";
    url = url.replace(':brand_id', brandId);
    $(document).ready(function() {
        $('#filterForm input').on('change', function() {
            var selectedCategories = $('#filterForm input[name="categories[]"]:checked').map(function() {
                return this.value;
            }).get();

            var selectedSizes = $('#filterForm input[name="sizes[]"]:checked').map(function() {
                return this.value;
            }).get();

            $.ajax({
                url: url,
                method: 'GET',
                data: {
                    categories: selectedCategories,
                    sizes: selectedSizes
                },
                success: function(response) {
                    $('#shoe-list').html(response);
                }
            });
        });
    });
</script>