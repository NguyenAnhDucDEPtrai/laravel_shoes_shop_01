@extends('admin.layouts.app')

@section('navbar')
<div class="navbar-nav pl-2">
    <ol class="breadcrumb p-0 m-0 bg-white">
        <li class="breadcrumb-item"><a href="{{ route('admin.shoes.index') }}">Giày</a></li>
        <li class="breadcrumb-item active">Sửa Giày</li>
    </ol>
</div>
@endsection

@section('content')
<!-- Thư viện chọn nhiều item cho select -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/css/multi-select-tag.css">

<form action="{{ route('admin.shoes.update', $shoe->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" value="{{ $shoe->id }}" id="shoe-id">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sửa giày</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{route('admin.shoes.index')}}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="title">Tên giày</label>
                                        <input value="{{ old('shoe_name', $shoe->shoe_name) }}" type="text" name="shoe_name" id="title" class="form-control" placeholder="Tên giày">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="description">Mô tả</label>
                                        <textarea name="description" id="description" cols="30" rows="10" class="summernote" placeholder="Mô tả">{{ old('description', $shoe->description) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h2 class="h4 mb-3">Ảnh</h2>
                            <div id="image" class="dropzone dz-clickable">
                                <div class="dz-message needsclick">
                                    <br>Thả tập tin vào đây hoặc bấm vào để tải lên.<br><br>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="shoe-images">
                        @foreach($shoe->images as $image)
                        <div class="col-md-3">
                            <div class="card">
                                <img src="{{ asset($image->image_url) }}" class="card-img-top">
                                <div class="card-body">
                                    <a class="btn btn-danger" data-image-id="{{ $image->id }}">Delete</a>
                                </div>
                            </div>
                        </div>

                        @endforeach
                    </div>

                    <div class="card mb-3">
                        <div class="card-body">
                            <h2 class="h4 mb-3">Giá tiền</h2>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="sku">Giá tiền</label>
                                        <input value="{{ old('price', $shoe->price) }}" type="text" name="price" id="sku" class="form-control" placeholder="Giá tiền">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h2 class="h4 mb-3">Trạng thái</h2>
                            <div class="mb-3">
                                <select name="status" id="status" class="form-control">
                                    <option value="Active" {{ old('status', $shoe->status) == 'Active' ? 'selected' : '' }}>Hoạt động</option>
                                    <option value="Block" {{ old('status', $shoe->status) == 'Block' ? 'selected' : '' }}>Chặn</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h2 class="h4  mb-3">Thương hiệu</h2>
                            <div class="mb-3">
                                <label for="brand_id">Thương hiệu</label>
                                <select name="brand_id" id="brand_id" class="form-control">
                                    @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{  $brand_current->id == $brand->id ? 'selected' : '' }}>{{ $brand->brand_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="categories">Danh mục</label>
                                <select name="categories[]" id="categories" multiple>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $shoe->categories->contains('id', $category->id) ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h2 class="h4 mb-3">Cỡ giày & Số lượng tồn kho</h2>
                            <div class="mb-3">
                                <label for="size_id">Cỡ giày</label>
                                <select name="size_id[]" id="size_id" multiple>
                                    @foreach($sizes as $size)
                                    <option data-size="{{ $size->size }}" value="{{ $size->id }}" {{ $shoe->sizes->contains('id', $size->id) ? 'selected' : '' }}>
                                        {{ $size->size }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div id="stock-quantity-section">
                                @foreach($shoe->sizes as $size)
                                <div class="form-group">
                                    <label for="stock_quantity_{{ $size->id }}">Số lượng tồn kho cho size {{ $size->size }}</label>
                                    <input type="number" name="stock_quantity[{{ $size->id }}]" id="stock_quantity_{{ $size->id }}"
                                        class="form-control" min="0" value="{{ $currentStock[$size->id] }}" placeholder="Nhập số lượng tồn kho">
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-primary">Lưu</button>
                <a href="{{ route('admin.shoes.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
        </div>
        <!-- /.card -->
    </section>
</form>
<!-- /.content -->

<!-- mô tả và chọn ảnh cho giày -->
<!-- Summernote -->
<script src="{{ asset('admin-assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admin-assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('admin-assets/plugins/dropzone/dropzone.js') }}"></script>

<script>
    $(function() {
        $('.summernote').summernote({
            height: '300px'
        });
    });
</script>

<script>
    var shoeId = document.getElementById('shoe-id').value;

    //ajax hiển thị danh sách ảnh theo giày
    function loadShoeImages(shoeId) {
        var url = "{{ route('admin.shoes.getImagesByShoe', ':shoe_id') }}";
        url = url.replace(':shoe_id', shoeId);
        $.ajax({
            url: url,
            method: 'GET',
            success: function(response) {
                var imagesContainer = document.getElementById('shoe-images');

                imagesContainer.innerHTML = '';

                response.updatedImages.forEach(function(image) {

                    var imgCard = document.createElement('div');
                    imgCard.classList.add('col-md-3');

                    imgCard.innerHTML = `
                        <div class="card">
                            <img src="{{ asset('${image.image_url}') }}" class="card-img-top">
                            <div class="card-body">
                                <a class="btn btn-danger" data-image-id="${image.id}">Delete</a>
                            </div>
                        </div>
                    `;

                    imagesContainer.appendChild(imgCard);
                });
            },
            error: function() {
                alert('Có lỗi xảy ra!');
            }
        });
    }

    // Xử lý xóa ảnh khi nhấn vào nút "Delete"
    $(document).on('click', '.btn-danger', function() {

        var imageId = $(this).data('image-id'); // Lấy ID ảnh từ data-attribute     
        var url = "{{ route('admin.shoes.deleteImage', ':image_id') }}";
        url = url.replace(':image_id', imageId);

        if (confirm('Bạn có chắc muốn xóa ảnh này?')) {
            $.ajax({
                url: url,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    loadShoeImages(shoeId)
                },

            });
        }
    });

    // cập nhật giày
    $("button[type=submit]").on("click", function(e) {
        e.preventDefault();

        let form = $('form')[0];
        let formData = new FormData(form);

        var url = "{{ route('admin.shoes.update', ':shoe_id') }}";
        url = url.replace(':shoe_id', shoeId);
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                if ($.isEmptyObject(data.error)) {
                    window.location.href = data.redirect_url;
                } else {
                    printErrorMsg(data.error);
                }
            },

        });
    });

    function printErrorMsg(msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display', 'block');
        $.each(msg, function(key, value) {
            $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
        });
    }


    //dropzone upload ảnh
    Dropzone.autoDiscover = false;

    let myDropzone = new Dropzone("#image", {
        url: "{{ route('admin.shoes.update_img_shoes') }}",
        paramName: "inputFiles",
        uploadMultiple: true,
        parallelUploads: 100,
        maxFiles: 100,
        acceptedFiles: "image/*",
        dictDefaultMessage: "Bạn có thể kéo ảnh hoặc click để chọn",
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    });

    myDropzone.on("sending", function(file, xhr, formData) {
        formData.append("shoe_id", shoeId);
    });

    // Xử lý khi upload ảnh thành công
    myDropzone.on("success", function(files, response) {
        loadShoeImages(shoeId)
        myDropzone.removeAllFiles(true);
    });

    myDropzone.on("error", function(files, response) {
        // console.log(response);
    });
</script>


<!-- Thư viện chọn nhiều item cho select-->
<script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/js/multi-select-tag.js"></script>
<script>
    new MultiSelectTag("size_id", {
        rounded: true,
        shadow: false,
        placeholder: "Search",
        tagColor: {
            textColor: "#327b2c",
            borderColor: "#92e681",
            bgColor: "#eaffe6",
        },
        onChange: function(values) {
            let stockSection = $('#stock-quantity-section');
            stockSection.empty();

            values.forEach(function(sizeId) {
                let sizeText = $('#size_id option[value="' + sizeId.value + '"]').text();
                stockSection.append(`
                <div class="form-group">
                    <label for="stock_quantity_${sizeId.value}">Số lượng tồn kho cho size ${sizeText}</label>
                    <input type="number" name="stock_quantity[${sizeId.value}]" id="stock_quantity_${sizeId.value}" 
                           class="form-control" min="0" value="0" placeholder="Nhập số lượng tồn kho">
                </div>
            `);
            });
        }
    });

    new MultiSelectTag("categories", {
        rounded: true,
        shadow: false,
        placeholder: "Search",
        tagColor: {
            textColor: "#327b2c",
            borderColor: "#92e681",
            bgColor: "#eaffe6",
        },
        // onChange: function(values) {
        //     console.log(values);
        // },
    });
</script>

<!-- ajax để hiển thị danh mục khi chọc thương hiệu -->
<script>
    $(document).ready(function() {
        let multiSelect;

        function loadCategories(brandId) {
            let url = "{{ route('admin.categories.byBrand', ':brandId') }}".replace(':brandId', brandId);

            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    $('#categories').next('.mult-select-tag').remove();
                    $('#categories').empty();
                    response.forEach(function(category) {
                        $('#categories').append(new Option(category.category_name, category.id));
                    });

                    multiSelect = new MultiSelectTag('categories', {
                        rounded: true,
                        shadow: false,
                        placeholder: "Search",
                        tagColor: {
                            textColor: "#327b2c",
                            borderColor: "#92e681",
                            bgColor: "#eaffe6",
                        },
                        // onChange: function(values) {
                        //     console.log(values);
                        // },
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error loading categories:', error);
                }
            });
        }

        // let initialBrandId = $('#brand_id').val();
        // if (initialBrandId) {
        //     loadCategories(initialBrandId);
        // }

        $('#brand_id').on('change', function() {
            let brandId = $(this).val();
            loadCategories(brandId);
        });
    });
</script>

@endsection