@extends('layouts.admincp.app')

@section('content')
<div class="container mt-5">
    <div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
                        <h4 class="card-title mb-0">
                            <i class="fas fa-film me-2"></i>Danh sách phim
                        </h4>
                        <a href="{{ route('movies.create') }}" class="btn btn-light">
                            <i class="fas fa-plus-circle me-1"></i>Thêm phim mới
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center" width="100">Hình ảnh</th>
                                        <th>Tên phim</th>
                                        <th>Danh mục</th>
                                        <th>Quốc gia</th>
                                        <th>Thể loại</th>
                                        <th>Loại phim</th>
                                        <th class="text-center">Lượt xem</th>
                                        <th class="text-center">Trạng thái</th>
                                        <th class="text-center" width="150">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($movies as $movie)
                                        <tr>
                                            <td class="text-center">
                                                <img src="{{ asset('uploads/movies/images/' . $movie->image) }}"
                                                     alt="{{ $movie->title }}"
                                                     class="img-thumbnail shadow-sm"
                                                     style="width: 60px; height: 90px; object-fit: cover;">
                                            </td>
                                            <td>
                                                <div class="fw-bold text-primary">{{ $movie->title }}</div>
                                                <small class="text-muted">
                                                    <i class="fas fa-calendar-alt me-1"></i>
                                                    {{ $movie->release_date ? date('d/m/Y', strtotime($movie->release_date)) : 'N/A' }}
                                                </small>
                                            </td>
                                            <td>
                                                <span class="badge bg-info">
                                                    {{ $movie->category->title ?? 'N/A' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary">
                                                    {{ $movie->country->title ?? 'N/A' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-warning text-dark">
                                                    {{ $movie->genre->title ?? 'N/A' }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($movie->type === 'series')
                                                    <span class="badge bg-danger">Phim bộ</span>
                                                @else
                                                    <span class="badge bg-success">Phim lẻ</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-light text-dark">
                                                    <i class="fas fa-eye me-1"></i>{{ number_format($movie->views) }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                @if($movie->status)
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-check-circle me-1"></i>Hoạt động
                                                    </span>
                                                @else
                                                    <span class="badge bg-danger">
                                                        <i class="fas fa-times-circle me-1"></i>Không hoạt động
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('movies.edit', $movie->id) }}"
                                                       class="btn btn-sm btn-primary"
                                                       title="Chỉnh sửa">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="{{ route('movies.show', $movie->id) }}"
                                                       class="btn btn-sm btn-info text-white"
                                                       title="Chi tiết">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <form action="{{ route('movies.destroy', $movie->id) }}"
                                                          method="POST"
                                                          class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="btn btn-sm btn-danger"
                                                                title="Xóa"
                                                                onclick="return confirm('Bạn có chắc chắn muốn xóa phim này?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center py-4 text-muted">
                                                <i class="fas fa-film fa-3x mb-3"></i>
                                                <p>Chưa có phim nào trong danh sách</p>
                                            </td>
                                        </tr>
                                    @endforelse
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
