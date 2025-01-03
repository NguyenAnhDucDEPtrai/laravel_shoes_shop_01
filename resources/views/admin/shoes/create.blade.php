@extends('admin.layouts.app')

@section('navbar')
<div class="navbar-nav pl-2">
    <ol class="breadcrumb p-0 m-0 bg-white">
        <li class="breadcrumb-item"><a href="{{ route('admin.shoes.index') }}">Giày</a></li>
        <li class="breadcrumb-item active">Thêm Giày</li>
    </ol>
</div>
@endsection

@section('content')
<!-- Thư viện chọn nhiều item cho select -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/css/multi-select-tag.css">

<form action="{{ route('admin.shoes.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thêm giày</h1>
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
                                        <input value="{{ old('shoe_name') }}" type="text" name="shoe_name" id="title" class="form-control" placeholder="Tên giày">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="description">Mô tả</label>
                                        <textarea name="description" id="description" cols="30" rows="10" class="summernote" placeholder="Mô tả"></textarea>
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

                    </div>

                    <div class="card mb-3">
                        <div class="card-body">
                            <h2 class="h4 mb-3">Giá tiền</h2>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="sku">Giá tiền</label>
                                        <input value="{{ old('price') }}" type="text" name="price" id="sku" class="form-control" placeholder="Giá tiền">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="barcode">Số lượng</label>
                                        <input value="{{ old('quantity') }}" type="text" name="quantity" id="barcode" class="form-control" placeholder="Số lượng">
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
                                    <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Hoạt động</option>
                                    <option value="Block" {{ old('status') == 'Block' ? 'selected' : '' }}>Chặn</option>
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
                                    <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="categories">Danh mục</label>
                                <select name="categories[]" id="categories" multiple>

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
                                    <option value="{{ $size->id }}">{{ $size->size }}</option>
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
    $(function() {
        $('.summernote').summernote({
            height: '300px'
        });
    });
</script>

<script>
    Dropzone.autoDiscover = false;

    let myDropzone = new Dropzone("#image", {
        url: "{{ route('admin.shoes.upload_shoe') }}",
        paramName: "inputFiles",
        autoProcessQueue: false,
        uploadMultiple: true,
        parallelUploads: 100,
        maxFiles: 100,
        acceptedFiles: "image/*",
        dictDefaultMessage: "Bạn có thể kéo ảnh hoặc click để chọn",
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    });

    myDropzone.on("addedfile", function(file) {
        var img_shoes = document.getElementById("shoe-images");
        var newImageDiv = document.createElement("div");
        newImageDiv.className = "col-md-3";
        newImageDiv.innerHTML = `
                <div class="card">
                    <img src="${URL.createObjectURL(file)}" class="card-img-top" alt="Uploaded Image">
                    <div class="card-body">
                        <a href="#" class="btn btn-danger delete-btn">Delete</a>
                    </div>
                </div>
            `;

        img_shoes.appendChild(newImageDiv);

        newImageDiv.querySelector('.delete-btn').addEventListener('click', function(e) {
            e.preventDefault();
            myDropzone.removeFile(file);
            newImageDiv.remove();
        });
    });

    // Submit form trước khi upload ảnh
    $("button[type=submit]").on("click", function(e) {
        e.preventDefault();

        // Gửi form trước khi upload ảnh
        let form = $('form')[0];
        let formData = new FormData(form);

        $.ajax({
            url: "{{ route('admin.shoes.store') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                if ($.isEmptyObject(data.error)) {
                    let shoeId = data.shoe_id;
                    myDropzone.on("sendingmultiple", function(files, xhr, formData) {
                        formData.append("shoe_id", shoeId); // Gửi ID giày lên server cùng ảnh
                    });
                    myDropzone.processQueue(); // Tiến hành upload ảnh

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


    // Xử lý khi upload ảnh thành công
    myDropzone.on("successmultiple", function(files, response) {
        // console.log('Ảnh đã được upload thành công', response);
    });

    myDropzone.on("errormultiple", function(files, response) {
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
                    if (multiSelect) {
                        $('#categories').next('.mult-select-tag').remove();
                    }
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

        let initialBrandId = $('#brand_id').val();
        if (initialBrandId) {
            loadCategories(initialBrandId);
        }

        $('#brand_id').on('change', function() {
            let brandId = $(this).val();
            loadCategories(brandId);
        });
    });
</script>

@endsection