@extends('admin.layouts.app')

@section('navbar')
<div class="navbar-nav pl-2">
    <ol class="breadcrumb p-0 m-0 bg-white">
        <li class="breadcrumb-item"><a href="{{ route('admin.sizes.index') }}">Cỡ giày</a></li>
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
                <h1>Cỡ giày</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('admin.sizes.create') }}" class="btn btn-primary">Thêm cỡ giày</a>
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
                    <form action="{{ route('admin.sizes.index') }}" method="GET">
                        <div class="input-group" style="width: 250px;">
                            <input
                                type="text"
                                name="search"
                                class="form-control float-right"
                                placeholder="Tìm kiếm"
                                value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @include('admin.message')
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>Mã</th>
                            <th>Cỡ giày</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($sizes->count() > 0)
                        @foreach($sizes as $size)
                        <tr>
                            <td>{{ $size->id }}</td>
                            <td>{{ $size->size }}</td>
                            <td>
                                @if($size->status == 'Active')
                                <span class="badge badge-success">Hoạt động</span>
                                @else
                                <span class="badge badge-danger">Chặn</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.sizes.edit', $size->id) }}" class="edit"><i class="material-icons">&#xE254;</i></a>
                                <a href="#deleteSizeModal" data-id="{{ $size->id }}" class="delete" data-toggle="modal"><i class="material-icons text-danger" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="4" class="text-center">Không tìm thấy cỡ giày nào phù hợp.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix">
                {{ $sizes->appends(['search' => request('search')])->links() }}
            </div>
        </div>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->

<!-- Delete Modal HTML -->
<div id="deleteSizeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="deleteSizeForm" method="post">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h4 class="modal-title">Xóa Cỡ giày</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Bạn muốn xóa cỡ giày này ?</p>
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
            var sizeId = $(this).data('id');
            var actionUrl = "{{ route('admin.sizes.destroy', ':id') }}";
            actionUrl = actionUrl.replace(':id', sizeId);
            $('#deleteSizeForm').attr('action', actionUrl);
        });
    });
</script>

@endsection