@extends('layouts.admincp.app')

@section('content')
<div class="container mt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Danh sách tập phim</h4>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Hình ảnh</th>
                                        <th>Tên phim</th>
                                        <th>Tên mùa</th>
                                        <th>Tên tập</th>
                                        <th>Số tập</th>
                                        <th>Thời lượng</th>
                                        <th>Lượt xem</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($episodes as $episode)
                                        <tr>
                                            <td>
                                                <img src="{{ asset('storage/' . $episode->thumbnail) }}" alt="{{ $episode->name }}" width="50">
                                            </td>
                                            <td>{{ $episode->movie->title ?? 'N/A' }}</td>
                                            <td>{{ $episode->season->name ?? 'N/A' }}</td>
                                            <td>{{ $episode->name }}</td>
                                            <td>{{ $episode->episode_number }}</td>
                                            <td>{{ $episode->duration }} phút</td>
                                            <td>{{ $episode->views }}</td>
                                            <td>{{ $episode->status ? 'Hoạt động' : 'Không hoạt động' }}</td>
                                            <td>
                                                {{-- <a href="{{ route('admin.episodes.edit', $episode->id) }}" class="btn btn-primary">Sửa</a>
                                                <a href="{{ route('admin.episodes.destroy', $episode->id) }}" class="btn btn-danger">Xóa</a> --}}
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
