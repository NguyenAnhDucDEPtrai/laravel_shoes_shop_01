@extends('admin.layouts.app')

@section('navbar')
<div class="navbar-nav pl-2">
    <ol class="breadcrumb p-0 m-0 bg-white">
        <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Danh mục</a></li>
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
                <h1>Danh mục</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Thêm danh mục</a>
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
                            <th>Mã</th>
                            <th>Tên thương hiệu</th>
                            <th>Tên danh mục</th>
                            <th>Trạng thái</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->brand->brand_name }}</td>
                            <td>{{ $category->category_name }}</td>
                            <td>
                                @if($category->status == 'Active')
                                <span class="badge badge-success">Hoạt động</span>
                                @else
                                <span class="badge badge-danger">Chặn</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="edit"><i class="material-icons">&#xE254;</i></a>
                                <a href="#deleteCategoryModal" data-id="{{ $category->id }}" class="delete" data-toggle="modal"><i class="material-icons text-danger" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->

<!-- Delete Modal HTML -->
<div id="deleteCategoryModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="deleteCategoryForm" method="post">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h4 class="modal-title">Xóa danh mục</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc xóa danh mục này ko ?</p>
                    <p class="text-warning"><small>Khong thể thu hồi!</small></p>
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
            var categoryId = $(this).data('id');
            var actionUrl = "{{ route('admin.categories.destroy', ':id') }}";
            actionUrl = actionUrl.replace(':id', categoryId);
            $('#deleteCategoryForm').attr('action', actionUrl);
        });
    });
</script>

@endsection