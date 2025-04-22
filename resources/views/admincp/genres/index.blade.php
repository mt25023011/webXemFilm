@extends('layouts.admincp.app')

@section('content')
<div class="container mt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Thể loại phim</h4>
                        <a href="{{ route('genres.create') }}" class="btn btn-primary">Thêm thể loại</a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tên thể loại</th>
                                        <th>Mô tả</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($genres as $genre)
                                        <tr>
                                            <td>{{ $genre->title }}</td>
                                            <td>{{ $genre->description }}</td>
                                            <td>{{ $genre->status ? 'Hoạt động' : 'Không hoạt động' }}</td>
                                            <td>
                                                <a href="{{ route('genres.edit', $genre->id) }}" class="btn btn-primary">Sửa</a>
                                                <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $genre->id }}">Xóa</a>

                                                <!-- Delete Modal -->
                                                <div class="modal fade" id="deleteModal{{ $genre->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel">Xác nhận xóa</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Bạn có chắc chắn muốn xóa thể loại này?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                                                <form action="{{ route('genres.destroy', $genre->id) }}" method="POST" style="display: inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">Xóa</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
