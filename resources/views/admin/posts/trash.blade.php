# Danh Sách Bài Viết Đã Xóa (trash.blade.php)

@extends('layouts.admin')

@section('title', 'Thùng rác bài viết')

@section('content')
    <div class="card shadow-sm rounded">
        <div class="card-body">
            <h2>Thùng Rác Bài Viết</h2>
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>STT</th>
                        <th>Tiêu đề</th>
                        <th>Ngày xóa</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $key => $post)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->deleted_at }}</td>
                            <td>
                                <form action="{{ route('admin.posts.restore', $post->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success btn-sm">Khôi phục</button>
                                </form>
                                <form action="{{ route('admin.posts.forceDelete', $post->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Xóa vĩnh viễn</button>
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