@extends('layouts.admin')

@section('title', 'Chi Tiết Sản Phẩm')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-sm rounded">
            <!-- Header -->
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h3 class="h4 mb-0">Chi Tiết Sản Phẩm: {{ $product->ten_san_pham }}</h3>
                <a href="{{ route('admin.products.index') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-arrow-left"></i> Quay Lại
                </a>
            </div>

            <!-- Body -->
            <div class="card-body">
                <!-- Thông báo nếu có -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Thông tin sản phẩm -->
                <div class="row">
                    <!-- Hình ảnh -->
                    <div class="col-md-4">
                        <img src="{{ asset('storage/' . $product->hinh_anh) }}" 
                             alt="{{ $product->ten_san_pham }}" 
                             class="img-fluid rounded shadow-sm" 
                             style="max-height: 300px; object-fit: cover;">
                    </div>

                    <!-- Chi tiết -->
                    <div class="col-md-8">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th scope="row" class="bg-light" style="width: 30%;">ID</th>
                                    <td>{{ $product->id }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="bg-light">Mã sản phẩm</th>
                                    <td><strong>{{ $product->ma_san_pham }}</strong></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="bg-light">Tên sản phẩm</th>
                                    <td>{{ $product->ten_san_pham }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="bg-light">Danh mục</th>
                                    <td>{{ $product->category->ten_danh_muc ?? 'Không có danh mục' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="bg-light">Giá</th>
                                    <td class="text-success fw-bold">{{ number_format($product->gia, 0, ',', '.') }} VNĐ</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="bg-light">Giá khuyến mãi</th>
                                    <td class="text-success fw-bold">{{ number_format($product->gia_khuyen_mai, 0, ',', '.') }} VNĐ</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="bg-light">Số lượng</th>
                                    <td>{{ $product->so_luong }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="bg-light">Trạng thái</th>
                                    <td>
                                        <span class="badge bg-{{ $product->trang_thai ? 'success' : 'danger' }}">
                                            {{ $product->trang_thai ? 'Còn hàng' : 'Hết hàng' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" class="bg-light">Ngày nhập</th>
                                    <td>{{ $product->ngay_nhap }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="bg-light">Ngày tạo</th>
                                    <td>{{ $product->created_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="bg-light">Ngày cập nhật</th>
                                    <td>{{ $product->updated_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Nút hành động -->
                {{-- <div class="mt-3 d-flex justify-content-end">
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning me-2">
                        <i class="fas fa-edit"></i> Sửa
                    </a>
                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" 
                          style="display:inline;" onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i> Xóa
                        </button>
                    </form>
                </div> --}}
            </div>
        </div>
    </div>

    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
        <style>
            .card { border-radius: 10px; }
            .table th, .table td { vertical-align: middle; }
            .img-fluid { transition: transform 0.3s; }
            .img-fluid:hover { transform: scale(1.05); }
        </style>
    @endpush

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @endpush
@endsection