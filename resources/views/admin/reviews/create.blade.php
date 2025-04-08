@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h1 class="h4 mb-0">Thêm Đánh Giá</h1>
            </div>
            <div class="card-body">
                <!-- Hiển thị thông báo lỗi nếu có -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.reviews.store') }}" method="POST">
                    @csrf

                    <!-- Người đánh giá -->
                    <div class="mb-3">
                        <label for="user_id" class="form-label fw-bold required">Người đánh giá</label>
                        <select name="user_id" 
                                id="user_id" 
                                class="form-select @error('user_id') is-invalid @enderror" 
                                required>
                            <option value="">Chọn người dùng</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Sản phẩm -->
                    <div class="mb-3">
                        <label for="product_id" class="form-label fw-bold required">Sản phẩm</label>
                        <select name="product_id" 
                                id="product_id" 
                                class="form-select @error('product_id') is-invalid @enderror" 
                                required>
                            <option value="">Chọn sản phẩm</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                    {{ $product->ten_san_pham }}
                                </option>
                            @endforeach
                        </select>
                        @error('product_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Đánh giá -->
                    <div class="mb-3">
                        <label for="review" class="form-label fw-bold">Đánh giá</label>
                        <textarea name="review" 
                                  id="review" 
                                  class="form-control @error('review') is-invalid @enderror" 
                                  rows="4">{{ old('review') }}</textarea>
                        @error('review')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Xếp hạng -->
                    <div class="mb-3">
                        <label for="rating" class="form-label fw-bold required">Số Sao (1-5)</label>
                        <input type="number" 
                               name="rating" 
                               id="rating" 
                               class="form-control @error('rating') is-invalid @enderror" 
                               min="1" 
                               max="5" 
                               value="{{ old('rating') }}" 
                               required>
                        @error('rating')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nút submit -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Lưu Đánh Giá</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Thêm Bootstrap CSS trong layouts.admin nếu chưa có -->
    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            .required::after {
                content: " *";
                color: red;
            }
            .card {
                border-radius: 10px;
            }
        </style>
    @endpush

    <!-- Thêm Bootstrap JS (tùy chọn) -->
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @endpush
@endsection 