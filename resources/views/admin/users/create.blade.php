@extends('admin.layouts.app')

@section('navbar')
<div class="navbar-nav pl-2">
    <ol class="breadcrumb p-0 m-0 bg-white">
        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Người dùng</a></li>
        <li class="breadcrumb-item active">Thêm người dùng</li>
    </ol>
</div>
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Thêm người dùng</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Quay lại</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">

        <form action="{{ route('admin.users.store') }}" method="post">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name">Tên người dùng</label>
                                <input value="{{ old('name') }}" type="text" name="name" id="name" class="form-control" placeholder="Tên người dùng">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input value="{{ old('email') }}" type="text" name="email" id="email" class="form-control" placeholder="Email">
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="password">Mật khẩu</label>
                                <input value="{{ old('password') }}" type="password" name="password" id="password" class="form-control" placeholder="Mật khẩu">
                                @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="phone_number">Số điện thoại</label>
                                <input value="{{ old('phone_number') }}" type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Số điện thoại">
                                @error('phone_number')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="address">Địa chỉ</label>
                                <input value="{{ old('address') }}" type="text" name="address" id="address" class="form-control" placeholder="Địa chỉ">
                                @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="role">Vai trò</label>
                                <select name="role" id="role" class="form-control">
                                    <option value="User" {{ 'User' == old('role') ? 'selected' : '' }}>Người dùng</option>
                                    <option value="Admin" {{ 'Admin' == old('role') ? 'selected' : '' }}>Quản trị viên</option>
                                </select>
                                @error('role')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pb-5 pt-3">
                <button class="btn btn-primary">Thêm</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-dark ml-3">Hủy</a>
            </div>
        </form>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->

@endsection