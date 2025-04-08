@extends('layouts.admin')

@section('title', 'Danh sách bài viết')

@section('content')
    <div class="card shadow-sm rounded">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Quản lý Bài Viết</h2>
                <div>
                    <a href="{{ route('admin.posts.trash') }}" class="btn btn-outline-danger me-2">
                        <i class="fas fa-trash-alt"></i> Danh sách đã xóa
                    </a>
                    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Thêm bài viết
                    </a>
                </div>
            </div>

            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>STT</th>
                        <th>Tiêu đề</th>
                        {{-- <th>Hình ảnh</th> --}}
                        <th>Content</th>
                        <th>Ngày tạo</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $key => $post)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $post->title }}</td>
                            {{-- <td><img src="{{ asset('storage/' . $post->image) }}" width="80"></td> --}}
                           
                            <td>{{ $post->content }}</td>
                            <td>{{ $post->created_at }}</td>
                            <td>
                                <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $posts->links() }}
        </div>
    </div>
@endsection
