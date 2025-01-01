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
                <button class="btn btn-primary">Create</button>
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

    $(function() {
        const dropzone = new Dropzone("#image", {
            url: "{{ route('admin.upload.image') }}",
            maxFiles: 5,
            addRemoveLinks: true,
            acceptedFiles: "image/jpeg,image/png,image/gif",
            paramName: "file",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(file, response) {
                if (response && response.id) {
                    console.log("File uploaded successfully with ID: " + response.id);
                    $("#image_id").val(response.id);
                    file.upload.filename = response.id; // Lưu tên file vào đối tượng file
                } else {
                    console.error("Response không hợp lệ:", response);
                }
            },
            error: function(file, errorMessage) {
                console.error("Lỗi tải ảnh:", errorMessage);
            },
            removedfile: function(file) {
                var filename = file.upload.filename;

                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.delete.image') }}",
                    data: {
                        filename: filename
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.success) {
                            var _ref;
                            if ((_ref = file.previewElement) != null) {
                                _ref.parentNode.removeChild(file.previewElement); // Xóa phần tử hình ảnh khỏi giao diện
                            }
                            console.log("File deleted successfully");
                        } else {
                            console.error(data.message);
                        }
                    },
                    error: function(error) {
                        console.error("Lỗi xóa file:", error);
                    }
                });
            }
        });
    });
</script>


<!-- <script>
    Dropzone.autoDiscover = false;
    $(function() {
        // Summernote
        $('.summernote').summernote({
            height: '300px'
        });

        const dropzone = $("#image").dropzone({
            url: "create-product.html",
            maxFiles: 5,
            addRemoveLinks: true,
            acceptedFiles: "image/jpeg,image/png,image/gif",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            success: function(file, response) {
                // Kiểm tra response từ server
                if (response && response.id) {
                    $("#image_id").val(response.id); // Lưu id của ảnh vào trường ẩn
                    file.uploadedId = response.id; // Lưu id vào đối tượng file của Dropzone
                } else {
                    console.error("Response không hợp lệ:", response);
                }
            },
            error: function(file, errorMessage) {
                console.error("Lỗi tải ảnh:", errorMessage);
            }
        });
    });
</script> -->

<!-- Thư viện chọn nhiều item cho select-->
<script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/js/multi-select-tag.js"></script>
<script>
    new MultiSelectTag('size_id')
</script>

<!-- ajax để hiển thị danh mục khi chọc thương hiệu -->
<script>
    $(document).ready(function() {
        let multiSelect;

        function loadCategories(brandId) {
            $.ajax({
                url: "{{ route('admin.categories.byBrand', '') }}/" + brandId,
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
                        placeholder: 'Search',
                        tagColor: {
                            textColor: '#327b2c',
                            borderColor: '#92e681',
                            bgColor: '#eaffe6',
                        }
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