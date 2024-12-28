@extends('admin.layouts.app')

@section('navbar')
<div class="navbar-nav pl-2">
    <ol class="breadcrumb p-0 m-0 bg-white">
        <li class="breadcrumb-item"><a href="{{ route('admin.brands.index') }}">Thương hiệu</a></li>
        <li class="breadcrumb-item active">Danh sách</li>
    </ol>
</div>
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Thương hiệu</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('admin.brands.create') }}" class="btn btn-primary">Thêm thương hiệu</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <div class="input-group input-group" style="width: 250px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Tìm kiếm">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            @include('admin.message')
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th width="60">Mã</th>
                            <th>Tên thương hiệu</th>
                            <th width="100">Trạng thái</th>
                            <th width="100">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($brands as $brand)
                        <tr>
                            <td>{{ $brand->id }}</td>
                            <td>{{ $brand->brand_name }}</td>
                            <td>
                                @if($brand->status == 'Active')
                                <span class="badge badge-success">Hoạt động</span>
                                @else
                                <span class="badge badge-danger">Chặn</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.brands.edit', $brand->id) }}" class="edit"><i class="material-icons">&#xE254;</i></a>
                                <a href="#deleteBrandModal" data-id="{{ $brand->id }}" class="delete" data-toggle="modal"><i class="material-icons text-danger" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix">
                {{ $brands->links() }}
            </div>
        </div>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->

<!-- Delete Modal HTML -->
<div id="deleteBrandModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="deleteBrandForm" method="post">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h4 class="modal-title">Xóa thương hiệu</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Bạn muốn xóa thương hiệu này ?</p>
                    <p class="text-warning"><small>Hành động này không thể thu hồi!</small></p>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Hủy">
                    <input type="submit" class="btn btn-danger" value="Xóa">
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.delete').on('click', function() {
            var brandId = $(this).data('id');
            var actionUrl = "{{ route('admin.brands.destroy', ':id') }}";
            actionUrl = actionUrl.replace(':id', brandId);
            $('#deleteBrandForm').attr('action', actionUrl);
        });
    });
</script>

@endsection