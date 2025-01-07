@extends('admin.layouts.app')

@section('navbar')
<div class="navbar-nav pl-2">
    <ol class="breadcrumb p-0 m-0 bg-white">
        <li class="breadcrumb-item"><a href="{{ route('admin.shoes.index') }}">Giày</a></li>
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
                <h1>Giày</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('admin.shoes.create') }}" class="btn btn-primary">Thêm Giày</a>
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
                    <form action="{{ route('admin.shoes.index') }}" method="GET">
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
                            <th>Ảnh</th>
                            <th>Tên giày</th>
                            <th>Giá tiền</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($shoes->count() > 0)
                        @foreach($shoes as $shoe)
                        <tr>
                            <td>{{ $shoe->id }}</td>
                            <td>
                                @if($shoe->images->count() > 0)
                                <img src="{{ asset($shoe->images->first()->image_url) }}" alt="Shoe Image" style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                <span>Không có ảnh</span>
                                @endif
                            </td>
                            <td>{{ $shoe->shoe_name }}</td>
                            <td>{{ $shoe->price }}</td>
                            <td>
                                @if($shoe->status == 'Active')
                                <span class="badge badge-success">Hoạt động</span>
                                @else
                                <span class="badge badge-danger">Chặn</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.shoes.edit', $shoe->id) }}" class="edit"><i class="material-icons">&#xE254;</i></a>
                                <a href="#deleteShoeModal" data-id="{{ $shoe->id }}" class="delete" data-toggle="modal"><i class="material-icons text-danger" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="4" class="text-center">Không tìm thấy giày nào phù hợp.</td>
                        </tr>
                        @endif
                    </tbody>

                </table>
            </div>
            <div class="card-footer clearfix">
                {{ $shoes->appends(['search' => request('search')])->links() }}
            </div>
        </div>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->

<!-- Delete Modal HTML -->
<div id="deleteShoeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="deleteShoeForm" method="post">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h4 class="modal-title">Xóa Giày</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Bạn muốn xóa Giày này ?</p>
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

<script src="{{ asset('admin-assets/plugins/jquery/jquery.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.delete').on('click', function() {
            var shoeId = $(this).data('id');
            var actionUrl = "{{ route('admin.shoes.destroy', ':id') }}";
            actionUrl = actionUrl.replace(':id', shoeId);
            $('#deleteShoeForm').attr('action', actionUrl);
        });
    });
</script>

@endsection