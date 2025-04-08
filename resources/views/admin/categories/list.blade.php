@extends('layouts.admin')

@section('title', 'Danh sách danh mục')

@section('content')

    <div class="card shadow-sm rounded">
        {{-- Hiển thị thông báo --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Danh sách Danh mục</h3>

            {{-- Hiển thị thông báo --}}
            @if (session('success'))
                <div class="alert alert-success mb-0">
                    {{ session('success') }}
                </div>
            @endif
            <form method="GET" action="{{ route('admin.category.index') }}" class="p-3 border rounded bg-light">
                <div class="row g-3 align-items-end">
                    <!-- Danh mục -->
                    <div class="col-md-6">
                        <label for="category_id" class="form-label fw-bold">Chọn danh mục</label>
                        <select name="category_id" id="category_id" class="form-select">
                            <option value="">-- Tất cả danh mục --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->ten_danh_muc }}
                                </option>
                            @endforeach
                        </select>
                        <select name="trang_thai" class="form-select">
                            <option value="">-- Chọn trạng thái --</option>
                            @foreach ($statusList as $key => $status)
                                <option value="{{ $key }}" {{ request('trang_thai') == $key ? 'selected' : '' }}>
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select>
                        

                    </div>

                    <!-- Nút tìm kiếm & Làm mới -->
                    <div class="col-md-6 d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-grow-1">
                            <i class="fas fa-search"></i> Tìm kiếm
                        </button>
                        <a href="{{ route('admin.category.index') }}" class="btn btn-secondary flex-grow-1">
                            <i class="fas fa-sync"></i> Làm mới
                        </a>
                    </div>
                </div>
            </form>

            <div class="d-flex gap-2">
                <a href="{{ route('admin.category.create') }}" class="btn btn-secondary">+ Thêm Danh mục</a>
                <a href="{{ route('admin.category.deletesoft') }}" class="btn btn-danger">Danh mục đã xóa</a>
            </div>
        </div>


        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>STT</th>
                        <th>Tên danh mục</th>
                        <th>Trạng thái</th>
                        <th>created_at</th>
                        <th>updated_at</th>
                        <th>deleted_at</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $value => $category)
                        <tr>
                            <td>{{ $value + 1 }}</td>
                            <td>{{ $category->ten_danh_muc }}</td>
                            <td>{{ $category->trang_thai == 1 ? 'Hoạt động' : 'Không hoạt động' }}</td>
                            <td>{{ $category->created_at }}</td>
                            <td>{{ $category->updated_at }}</td>
                            <td>{{ $category->deleted_at }}</td>
                            <td>
                                <a href="{{ route('admin.category.edit', $category->id) }}"
                                    class="btn btn-warning btn-sm">Sửa</a>
                                <form action="{{ route('admin.category.destroy', $category->id) }}" method="post"
                                    class="d-inline" onsubmit="return confirm('xóa chứ?')">
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
                {{ $categories->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
