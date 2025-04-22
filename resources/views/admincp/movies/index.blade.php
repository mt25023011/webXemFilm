@extends('layouts.admincp.app')

@section('content')
<div class="container mt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Danh sách phim</h4>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Hình ảnh</th>
                                        <th>Tên phim</th>
                                        <th>Danh mục</th>
                                        <th>Quốc gia</th>
                                        <th>Thể loại</th>
                                        <th>Loại</th>
                                        <th>Lượt xem</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($movies as $movie)
                                        <tr>
                                            <td>
                                                <img src="{{ asset('storage/' . $movie->image) }}" alt="{{ $movie->title }}" width="50">
                                            </td>
                                            <td>{{ $movie->title }}</td>
                                            <td>{{ $movie->category->title ?? 'N/A' }}</td>
                                            <td>{{ $movie->country->title ?? 'N/A' }}</td>
                                            <td>{{ $movie->genre->title ?? 'N/A' }}</td>
                                            <td>{{ $movie->type === 'series' ? 'Phim bộ' : 'Phim lẻ' }}</td>
                                            <td>{{ $movie->views }}</td>
                                            <td>{{ $movie->status ? 'Hoạt động' : 'Không hoạt động' }}</td>
                                            <td>
                                                {{-- <a href="{{ route('admin.movies.edit', $movie->id) }}" class="btn btn-primary">Sửa</a>
                                                <a href="{{ route('admin.movies.destroy', $movie->id) }}" class="btn btn-danger">Xóa</a> --}}
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
