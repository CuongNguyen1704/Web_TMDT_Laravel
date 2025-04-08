@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h1 class="h4 mb-0">Danh Sách Đánh Giá</h1>
                <div>
                    <a href="{{ route('admin.reviews.create') }}" class="btn btn-light btn-sm me-2">
                        <i class="fas fa-plus"></i> Thêm Đánh Giá
                    </a>
                    <a href="{{ route('admin.reviews.trash') }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-trash"></i> Thùng Rác
                    </a>
                </div>
            </div>
            <div class="card-body">
                <!-- Thông báo thành công nếu có -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Bảng danh sách -->
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Khách Hàng</th>
                                <th scope="col">Sản Phẩm</th>
                                <th scope="col">Đánh Giá</th>
                                <th scope="col">Số Sao</th>
                                <th scope="col">Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reviews as $review)
                                <tr>
                                    <td>{{ $review->id }}</td>
                                    <td>{{ $review->user->name ?? 'N/A' }}</td>
                                    <td>{{ $review->product->ten_san_pham ?? 'N/A' }}</td>
                                    <td>{{ Str::limit($review->review, 50) }}</td>
                                    <td>
                                        <span class="badge bg-{{ $review->rating >= 3 ? 'success' : 'warning' }}">
                                            {{ $review->rating }}/5
                                        </span>
                                    </td>
                                    <td>
                                        {{-- <a href="{{ route('admin.reviews.edit', $review->id) }}" 
                                           class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Sửa
                                        </a> --}}
                                        <form action="{{ route('admin.reviews.destroy', $review->id) }}" 
                                              method="POST" 
                                              style="display:inline;" 
                                              onsubmit="return confirm('Bạn có chắc muốn xóa đánh giá này?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i> Xóa
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Không có đánh giá nào.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Phân trang -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $reviews->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Thêm CSS và Font Awesome -->
    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
        <style>
            .card {
                border-radius: 10px;
            }
            .table th, .table td {
                vertical-align: middle;
            }
            .badge {
                font-size: 0.9em;
            }
        </style>
    @endpush

    <!-- Thêm JS -->
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @endpush
@endsection