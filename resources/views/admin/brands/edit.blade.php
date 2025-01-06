@extends('admin.layouts.app')

@section('navbar')
<div class="navbar-nav pl-2">
    <ol class="breadcrumb p-0 m-0 bg-white">
        <li class="breadcrumb-item"><a href="{{ route('admin.brands.index') }}">Thương hiệu</a></li>
        <li class="breadcrumb-item active">Sửa thương hiệu</li>
    </ol>
</div>
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Cập nhật thương hiệu</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('admin.brands.index') }}" class="btn btn-primary">Quay lại</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">

        <form action="{{ route('admin.brands.update', $brand->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="brand_name">Tên thương hiệu</label>
                                <input value="{{ old('brand_name',  $brand->brand_name) }}" type="text" name="brand_name" id="brand_name" class="form-control" placeholder="Tên thương hiệu">
                                @error('brand_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status">Trạng thái</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="Active" {{ 'Active' == old('status',  $brand->status) ? 'selected' : '' }}>Hoạt động</option>
                                    <option value="Block" {{ 'Block' == old('status',  $brand->status) ? 'selected' : '' }}>Chặn</option>
                                </select>
                                @error('status')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Thêm phần input ảnh -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="image">Ảnh thương hiệu</label>
                                <input type="file" name="image" id="image" class="form-control">
                                <br>
                                <!-- Hiển thị ảnh cũ nếu có -->
                                @if($brand->image)
                                <img src="{{ asset($brand->image) }}" alt="Ảnh thương hiệu" width="100">
                                @endif
                                @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="pb-5 pt-3">
                <button class="btn btn-primary">Cập nhật</button>
                <a href="{{ route('admin.brands.index') }}" class="btn btn-outline-dark ml-3">Hủy</a>
            </div>
        </form>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->

@endsection