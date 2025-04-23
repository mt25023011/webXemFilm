@extends('layouts.admincp.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-film"></i> Chỉnh sửa phim</h5>
                </div>
                <div class="card-body">
                    {!! Form::model($movie, ['route' => ['movies.update', $movie->id], 'method' => 'PUT', 'files' => true]) !!}
                    @csrf
                    <div class="row g-3">

                        {{-- Thông tin cơ bản --}}
                        <div class="col-md-6 form-floating">
                            {!! Form::text('title', null, ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''), 'placeholder' => 'Tên phim']) !!}
                            {!! Form::label('title', 'Tên phim') !!}
                            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            {!! Form::label('type', 'Loại phim') !!}
                            {!! Form::select('type', ['single' => 'Phim lẻ', 'series' => 'Phim bộ'], null, ['class' => 'form-select' . ($errors->has('type') ? ' is-invalid' : '')]) !!}
                            @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-12">
                            {!! Form::label('description', 'Mô tả') !!}
                            {!! Form::textarea('description', null, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'rows' => 4]) !!}
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Upload files --}}
                        <div class="col-md-6">
                            {!! Form::label('image', 'Poster phim') !!}
                            {!! Form::file('image', ['class' => 'form-control' . ($errors->has('image') ? ' is-invalid' : ''), 'id' => 'imageInput']) !!}
                            @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror

                            <div class="mt-2 border rounded text-center" style="width: 150px; height: 225px; overflow: hidden;">
                                <img id="imagePreview" src="{{ asset('uploads/movies/images/' . $movie->image) }}" alt="Preview" class="img-fluid rounded" style="object-fit: cover; width: 100%; height: 100%;">
                            </div>
                        </div>

                        <div class="col-md-6">
                            {!! Form::label('trailer', 'Trailer phim') !!}
                            {!! Form::file('trailer', ['class' => 'form-control' . ($errors->has('trailer') ? ' is-invalid' : ''), 'accept' => 'video/*']) !!}
                            @error('trailer') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            <small class="text-muted">Chấp nhận định dạng: MP4, MOV, AVI (tối đa 10MB) - Tùy chọn</small>
                            @if($movie->trailer)
                                <div class="mt-2">
                                    <small>Trailer hiện tại: {{ $movie->trailer }}</small>
                                </div>
                            @endif
                        </div>

                        {{-- Thông số kỹ thuật --}}
                        <div class="col-md-4 form-floating">
                            {!! Form::text('duration', null, ['class' => 'form-control' . ($errors->has('duration') ? ' is-invalid' : ''), 'placeholder' => 'Thời lượng']) !!}
                            {!! Form::label('duration', 'Thời lượng (phút)') !!}
                            @error('duration') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4 form-floating">
                            {!! Form::text('resolution', null, ['class' => 'form-control' . ($errors->has('resolution') ? ' is-invalid' : ''), 'placeholder' => 'Độ phân giải']) !!}
                            {!! Form::label('resolution', 'Độ phân giải') !!}
                            @error('resolution') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4 form-floating">
                            {!! Form::text('language', null, ['class' => 'form-control' . ($errors->has('language') ? ' is-invalid' : ''), 'placeholder' => 'Ngôn ngữ']) !!}
                            {!! Form::label('language', 'Ngôn ngữ') !!}
                            @error('language') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Ngày phát hành & Chất lượng --}}
                        <div class="col-md-6 form-floating">
                            {!! Form::date('release_date', null, ['class' => 'form-control' . ($errors->has('release_date') ? ' is-invalid' : '')]) !!}
                            {!! Form::label('release_date', 'Ngày phát hành') !!}
                            @error('release_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            {!! Form::label('quality', 'Chất lượng') !!}
                            {!! Form::select('quality', ['HD' => 'HD', '4K' => '4K', 'FullHD' => 'FullHD'], null, ['class' => 'form-select' . ($errors->has('quality') ? ' is-invalid' : '')]) !!}
                            @error('quality') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Đánh giá --}}
                        <div class="col-md-3 form-floating">
                            {!! Form::number('rating', null, ['class' => 'form-control' . ($errors->has('rating') ? ' is-invalid' : ''), 'step' => '0.1', 'min' => '0', 'max' => '10']) !!}
                            {!! Form::label('rating', 'Điểm đánh giá') !!}
                            @error('rating') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-3 form-floating">
                            {!! Form::number('imdb_rating', null, ['class' => 'form-control' . ($errors->has('imdb_rating') ? ' is-invalid' : ''), 'step' => '0.1', 'min' => '0', 'max' => '10']) !!}
                            {!! Form::label('imdb_rating', 'IMDb') !!}
                            @error('imdb_rating') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Danh mục --}}
                        <div class="col-md-4">
                            {!! Form::label('category_id', 'Danh mục') !!}
                            {!! Form::select('category_id', $categories->pluck('title', 'id'), null, ['class' => 'form-select' . ($errors->has('category_id') ? ' is-invalid' : '')]) !!}
                            @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            {!! Form::label('country_id', 'Quốc gia') !!}
                            {!! Form::select('country_id', $countries->pluck('title', 'id'), null, ['class' => 'form-select' . ($errors->has('country_id') ? ' is-invalid' : '')]) !!}
                            @error('country_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            {!! Form::label('genre_id', 'Thể loại') !!}
                            {!! Form::select('genre_id', $genres->pluck('title', 'id'), null, ['class' => 'form-select' . ($errors->has('genre_id') ? ' is-invalid' : '')]) !!}
                            @error('genre_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            {!! Form::label('status', 'Trạng thái') !!}
                            {!! Form::select('status', ['1' => 'Hoạt động', '0' => 'Không hoạt động'], null, ['class' => 'form-select' . ($errors->has('status') ? ' is-invalid' : '')]) !!}
                            @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mt-4 d-flex justify-content-end gap-2">
                        {!! Form::submit('💾 Lưu', ['class' => 'btn btn-success']) !!}
                        <a href="{{ route('movies.index') }}" class="btn btn-secondary">Hủy</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('imageInput').addEventListener('change', function(e) {
        const preview = document.getElementById('imagePreview');
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
