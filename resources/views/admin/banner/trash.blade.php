@extends('layouts.admin')

@section('title', 'Danh sách banner đã xóa')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2><i class="fas fa-trash-alt"></i> Danh sách Banner Đã Xóa</h2>
        <a href="{{ route('admin.banner.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Tiêu đề</th>
                        {{-- <th>Hình ảnh</th> --}}
                        <th>Ngày xóa</th>
                        <th class="text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($banners as $banner)
                        <tr>
                            <td>{{ $banner->id }}</td>
                            <td>{{ $banner->title }}</td>
                            {{-- <td><img src="{{ asset('storage/' . $banner->image) }}" width="80" alt="Banner"></td> --}}
                            <td>{{ $banner->deleted_at }}</td>
                            <td class="text-center">
                                <!-- Khôi phục -->
                                <form action="{{ route('admin.banner.restore', $banner->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fas fa-undo"></i> Khôi phục
                                    </button>
                                </form>
                                <!-- Xóa vĩnh viễn -->
                                <form action="{{ route('admin.banner.forcedelete', $banner->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn banner này?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-times"></i> Xóa vĩnh viễn
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $banners->links() }} <!-- Phân trang -->
        </div>
    </div>
</div>
@endsection
