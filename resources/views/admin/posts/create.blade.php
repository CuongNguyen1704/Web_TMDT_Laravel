@extends('layouts.admin')

@section('title', 'Thêm bài viết')

@section('content')
    <div class="card shadow-sm rounded">
        <div class="card-body">
            <h2>Thêm Bài Viết</h2>
            <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Tiêu đề</label>
                    <input type="text" name="title" class="form-control" >
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Nội dung</label>
                    <textarea name="content" class="form-control" rows="5" ></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary">Thêm</button>
            </form>
        </div>
    </div>
@endsection

