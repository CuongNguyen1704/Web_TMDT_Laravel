@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-sm rounded">
            <!-- Header -->
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h3 class="h4 mb-0">Danh Sách Sản Phẩm</h3>
                <div>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-light btn-sm me-2">
                        <i class="fas fa-plus"></i> Thêm Sản Phẩm
                    </a>
                    <a href="{{ route('admin.products.deletesoft') }}" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i> Xóa Mềm
                    </a>
                </div>
            </div>

            <!-- Thông báo -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Form tìm kiếm -->
            <div class="card m-3 shadow-sm">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-search"></i> Tìm Kiếm Sản Phẩm</h5>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.products.index') }}" class="row g-3">
                        <div class="col-md-2">
                            <input type="text" name="ma_san_pham" class="form-control" placeholder="Mã sản phẩm"
                                   value="{{ request('ma_san_pham') }}">
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="ten_san_pham" class="form-control" placeholder="Tên sản phẩm"
                                   value="{{ request('ten_san_pham') }}">
                        </div>
                        <div class="col-md-2">
                            <select name="category_id" class="form-select">
                                <option value="">-- Danh mục --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->ten_danh_muc }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="trang_thai" class="form-select">
                                <option value="">-- Trạng thái --</option>
                                <option value="1" {{ request('trang_thai') == '1' ? 'selected' : '' }}>Còn hàng</option>
                                <option value="0" {{ request('trang_thai') == '0' ? 'selected' : '' }}>Hết hàng</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="min_price" class="form-control" placeholder="Giá từ"
                                   value="{{ request('min_price') }}">
                            <input type="number" name="max_price" class="form-control mt-2" placeholder="Giá đến"
                                   value="{{ request('max_price') }}">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary me-1 w-50"><i class="fas fa-search">Tìm kiếm</i></button>
                            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary w-50"><i class="fas fa-sync">Làm lại</i></a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Bảng sản phẩm -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Mã SP</th>
                                <th>Tên SP</th>
                                <th>Danh mục</th>
                                <th>Hình ảnh</th>
                                <th>Giá</th>
                                <th>Giá KM</th>
                                <th>SL</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $index => $product)
                                <tr>
                                    <td>{{ $products->firstItem() + $index }}</td>
                                    <td>{{ $product->ma_san_pham }}</td>
                                    <td>{{ Str::limit($product->ten_san_pham, 30) }}</td>
                                    <td>{{ $product->category->ten_danh_muc ?? 'N/A' }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $product->hinh_anh) }}" alt="Hình ảnh" width="50" class="rounded">
                                    </td>
                                    <td class="text-success">{{ number_format($product->gia, 0, ',', '.') }}đ</td>
                                    <td class="text-success">{{ number_format($product->gia_khuyen_mai, 0, ',', '.') }}đ</td>
                                    <td>{{ $product->so_luong }}</td>
                                    <td>
                                        <span class="badge bg-{{ $product->trang_thai ? 'success' : 'danger' }}">
                                            {{ $product->trang_thai ? 'Còn hàng' : 'Hết hàng' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye">Show</i>
                                        </a>
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit">Sửa</i>
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" 
                                              style="display:inline;" onsubmit="return confirm('Xác nhận xóa sản phẩm?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash">Xóa</i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center text-muted">Không có sản phẩm nào.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Phân trang -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
        <style>
            .card { border-radius: 10px; }
            .table th, .table td { vertical-align: middle; }
            .btn-sm { padding: 0.25rem 0.5rem; }
        </style>
    @endpush

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @endpush
@endsection