@extends('layouts.admin')

@section('title', 'Sửa bài viết')

@section('content')
    <div class="card shadow-sm rounded">
        <div class="card-body">
            <h2>Sửa Bài Viết</h2>
            <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="title" class="form-label">Tiêu đề</label>
                    <input type="text" name="title" class="form-control" value="{{ $post->title }}" >
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Nội dung</label>
                    <textarea name="content" class="form-control" rows="5" >{{ $post->content }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Hình ảnh</label>
                    <input type="file" name="image" class="form-control">
                    <img src="{{ asset('storage/' . $post->image) }}" width="100">
                </div>
                <button type="submit" class="btn btn-warning">Cập nhật</button>
            </form>
        </div>
    </div>
@endsection