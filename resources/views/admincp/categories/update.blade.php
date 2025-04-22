@extends('layouts.admincp.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Cập nhật danh mục</h4>
                        <a href="{{ route('categories.index') }}" class="btn btn-primary">Quay lại</a>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['route' => ['categories.update', $category->id], 'method' => 'PUT']) !!}
                            <div class="form-group mb-3">
                                {!! Form::label('title', 'Tên danh mục') !!}
                                {!! Form::text('title', $category->title, ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''), 'id' => 'title']) !!}
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                {!! Form::label('description', 'Mô tả') !!}
                                {!! Form::textarea('description', $category->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'id' => 'description']) !!}
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                {!! Form::label('status', 'Trạng thái') !!}
                                {!! Form::select('status', ['1' => 'Hoạt động', '0' => 'Không hoạt động'], $category->status, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'id' => 'status']) !!}
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            {!! Form::submit('Cập nhật', ['class' => 'btn btn-primary']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
