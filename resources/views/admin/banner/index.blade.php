@extends('layouts.admin')

@section('title', 'Danh sách danh mục')

@section('content')

    <div class="card shadow-sm rounded">
        <!-- Hiển thị thông báo -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Quản lý Banner</h2>
                <div>
                    <a href="{{ route('admin.banner.trash') }}" class="btn btn-outline-danger me-2">
                        <i class="fas fa-trash-alt"></i> Danh sách đã xóa
                    </a>
                    <a href="{{ route('admin.banner.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Thêm banner
                    </a>
                </div>
            </div>

            <!-- Form tìm kiếm trạng thái -->
            <form method="GET" action="{{ route('admin.banner.index') }}" class="mb-3">
                <div class="row">
                    <!-- Bộ lọc trạng thái -->
                    <div class="col-md-4">
                        <label class="form-label">Trạng thái</label>
                        <select name="trang_thai" class="form-select" onchange="this.form.submit()">
                            <option value="">-- Chọn trạng thái --</option>
                            <option value="1" {{ request('trang_thai') == '1' ? 'selected' : '' }}>Hoạt động</option>
                            <option value="0" {{ request('trang_thai') == '0' ? 'selected' : '' }}>Ẩn</option>
                        </select>
                    </div>

                    <!-- Nút Reset -->
                    <div class="col-md-2 d-flex align-items-end">
                        <a href="{{ route('admin.banner.index') }}" class="btn btn-secondary">Làm mới</a>
                    </div>
                </div>
            </form>

            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>STT</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($banners as $value => $banner)
                    <tr>
                        <td>{{ $value + 1 }}</td>
                        <td>{{ $banner->title }}</td>
                        <td><img src="{{ asset('storage/' . $banner->image) }}" alt="Banner" width="100px"></td>
                        <td>{{ $banner->description }}</td>
                        <td>{{ $banner->status == 1 ? 'Hoạt động' : 'Ẩn' }}</td>
                        <td>{{ $banner->created_at }}</td>
                        <td>{{ $banner->updated_at }}</td>
                        <td>
                            <a href="{{ route('admin.banner.edit',$banner->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                            <form action="{{ route('admin.banner.destroy', $banner->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa banner này?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Hiển thị phân trang -->
            <div class="d-flex justify-content-center mt-3">
                {{ $banners->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
