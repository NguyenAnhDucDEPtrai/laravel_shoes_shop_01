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

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

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
                                <img src="{{ asset($image->image_url) }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <a class="btn btn-danger delete-image" data-image="imageUrl">Delete</a>
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
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="barcode">Số lượng</label>
                                        <input value="{{ old('quantity', $shoe->quantity) }}" type="text" name="quantity" id="barcode" class="form-control" placeholder="Số lượng">
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
                            <h2 class="h4 mb-3">Cỡ giày</h2>
                            <div class="mb-3">
                                <select name="size_id[]" id="size_id" multiple>
                                    @foreach($sizes as $size)
                                    <option value="{{ $size->id }}" {{ $shoe->sizes->contains('id', $size->id) ? 'selected' : '' }}>
                                        {{ $size->size }}
                                    </option>
                                    @endforeach
                                </select>
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
    Dropzone.autoDiscover = false;
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    var myDropzone = new Dropzone("#image", {
        url: "{{ route('admin.shoes.upload_shoe') }}",
        headers: {
            'X-CSRF-TOKEN': token
        },
        init: function() {
            this.on("success", function(file, response) {
                var imageUrl = response.filePath;
                console.log(imageUrl);
                var uniqueId = file.upload.uuid; // Thêm mã UUID để quản lý các ảnh đã upload

                var cardHtml = '<div class="col-md-3" data-id="' + uniqueId + '">' +
                    '<div class="card">' +
                    '<img src="' + imageUrl + '" class="card-img-top" alt="...">' +
                    '<div class="card-body">' +
                    '<a class="btn btn-danger delete-image" data-image="' + imageUrl + '">Delete</a>' +
                    '</div>' +
                    '</div>' +
                    '</div>';

                document.getElementById('shoe-images').innerHTML += cardHtml;
                this.removeFile(file);
            });
        }
    });

    $(document).on('click', '.delete-image', function(e) {
        e.preventDefault();

        var imageUrl = $(this).data('image');

        $.ajax({
            url: "#", // Đường dẫn xóa ảnh
            type: 'POST',
            data: {
                _token: token,
                image_url: imageUrl
            },
            success: function(response) {
                if (response.success) {
                    $(this).closest('.col-md-3').remove();
                } else {
                    alert('Không thể xóa ảnh');
                }
            }.bind(this),
            error: function() {
                alert('Có lỗi xảy ra!');
            }
        });
    });


    $(function() {
        $('.summernote').summernote({
            height: '300px'
        });
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
        // onChange: function(values) {
        //     console.log(values);
        // },
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