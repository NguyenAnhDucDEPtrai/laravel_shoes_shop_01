@extends('admin.layouts.app')

@section('navbar')
<div class="navbar-nav pl-2">
    <ol class="breadcrumb p-0 m-0 bg-white">
        <li class="breadcrumb-item"><a href="{{ route('admin.sizes.index') }}">Cỡ giày</a></li>
        <li class="breadcrumb-item active">Sửa cỡ giày</li>
    </ol>
</div>
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Cập nhật cỡ giày</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('admin.sizes.index') }}" class="btn btn-primary">Quay lại</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">

        <form action="{{ route('admin.sizes.update', $size->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="size">Cỡ giày</label>
                                <input value="{{ old('size',  $size->size) }}" type="text" name="size" id="size" class="form-control" placeholder="Tên thương hiệu">
                                @error('size')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status">Trạng thái</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="Active" {{ 'Active' == old('status',  $size->status) ? 'selected' : '' }}>Hoạt động</option>
                                    <option value="Block" {{ 'Block' == old('status',  $size->status) ? 'selected' : '' }}>Chặn</option>
                                </select>
                                @error('status')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pb-5 pt-3">
                <button class="btn btn-primary">Cập nhật</button>
                <a href="{{ route('admin.sizes.index') }}" class="btn btn-outline-dark ml-3">Hủy</a>
            </div>
        </form>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->

@endsection