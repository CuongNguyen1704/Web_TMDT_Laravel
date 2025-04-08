@extends('master.client')

@section('title', 'Chi tiết sản phẩm')

@section('content')
    <div class="container mt-5">
        @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <!-- Sản phẩm mới nhất -->
        <div class="row">
            <!-- Hình ảnh sản phẩm -->
            <div class="col-md-5 d-flex justify-content-center">
                <a href="{{ route('client.detail', $product->id) }}"><img src="{{ asset('storage/' . $product->hinh_anh) }}"
                        class="img-fluid rounded" style="object-fit: cover; width: 90%; max-width: 450px;"
                        alt="{{ $product->ten_san_pham }}"></a>
            </div>

            <!-- Thông tin sản phẩm -->
            <div class="col-md-7">
                <h2 class="fw-bold">{{ $product->ten_san_pham }}</h2>
                <p class="text-muted">Mã sản phẩm: {{ $product->ma_san_pham }}</p>

                <!-- Giá sản phẩm -->
                <div class="mb-3">
                    @if ($product->gia_khuyen_mai && $product->gia_khuyen_mai > 0)
                        <h4 class="text-danger fw-bold">
                            {{ number_format($product->gia_khuyen_mai, 0, ',', '.') }} VNĐ
                        </h4>
                        <p class="text-muted">
                            <del>{{ number_format($product->gia, 0, ',', '.') }} VNĐ</del>
                        </p>
                    @else
                        <h4 class="text-primary fw-bold">
                            {{ number_format($product->gia, 0, ',', '.') }} VNĐ
                        </h4>
                    @endif
                </div>

                <!-- Số lượng tồn kho -->
                <p class="fw-bold">Số lượng còn lại: <span class="text-success">{{ $product->so_luong }}</span></p>

                <!-- Ngày nhập kho -->
                <p class="text-muted">Ngày nhập: {{ date('d/m/Y', strtotime($product->ngay_nhap)) }}</p>

                <!-- Mô tả sản phẩm -->
                <div class="mt-3">
                    <h5>Mô tả sản phẩm</h5>
                    <p class="text-justify">{{ $product->mo_ta }}</p>
                </div>

                <!-- Nút Mua Ngay & Thêm vào giỏ hàng -->
                <div class="mt-4">
                    <button class="btn btn-success btn-lg me-2">🛒 Thêm vào giỏ hàng</button>
                    <button class="btn btn-danger btn-lg">⚡ Mua ngay</button>
                </div>
                <!-- Form thêm đánh giá -->
                @auth
                <div class="mt-4">
                    <h6>Viết đánh giá của bạn</h6>
                    <form action="{{ route('admin.reviews.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="mb-3">
                            <label for="rating" class="form-label">Xếp hạng:</label>
                            <select name="rating" id="rating" class="form-select w-25" >
                                <option value="">Chọn số sao</option>
                                @for ($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}">{{ $i }} ★</option>
                                @endfor
                            </select>
                            @error('rating')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="review" class="form-label">Nội dung đánh giá:</label>
                            <textarea name="review" id="review" class="form-control" rows="3" 
                                      placeholder="Nhập đánh giá của bạn..." ></textarea>
                            @error('review')
                                {{-- <small class="text-danger">{{ $message }}</small> --}}
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Gửi Đánh Giá</button>
                    </form>
                </div>
            @else
                <p class="mt-3">
                    Vui lòng <a href="{{ route('login') }}" class="text-primary">đăng nhập</a> để viết đánh giá.
                </p>
            @endauth
            </div>
        </div>
    </div>
    @if ($relatedProducts->count())
        <div class="mt-5">
            <h4 class="fw mb-3">Sản phẩm liên quan</h4>
            <div class="row row-cols-2 row-cols-md-4 row-cols-lg-5 g-3">
                @foreach ($relatedProducts as $item)
                    <div class="col">
                        <div class="card h-100 shadow-sm border-0 rounded-4">
                            <a href="{{ route('client.detail', $item->id) }}"><img
                                    src="{{ asset('storage/' . $item->hinh_anh) }}"  accesskey=""
                                    class="card-img-top p-2 rounded-4 bg-white" alt="{{ $item->ten_san_pham }}"
                                    style="height: 130px; object-fit: contain;"></a>
                            <div class="card-body text-center px-2 py-3">
                                <h6 class="card-title mb-1 text-truncate" title="{{ $item->ten_san_pham }}">
                                    {{ $item->ten_san_pham }}
                                </h6>
                                <p class="text-danger fw-bold mb-2" style="font-size: 14px;">
                                    {{ number_format($item->gia, 0, ',', '.') }} VNĐ
                                </p>
                                <a href="{{ route('client.detail', $item->id) }}"
                                    class="btn btn-sm btn-outline-primary w-100 rounded-pill">
                                    Xem chi tiết
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @auth
    @if ($reviews->count())
        <div class="mt-5">
            <h4 class="fw-bold mb-3">Các Đánh giá sản phẩm: </h4>
            @foreach ($reviews as $review)
          Tên Sản Phẩm:  {{ $review->product->ten_san_pham ?? 'Lỗi sản phẩm' }}
                <div class="border-bottom mb-3 pb-2">
          Người đánh giá: <strong>{{ $review->user->name ?? 'Khách hàng ẩn danh' }}</strong>
                    <span class="text-warning">★ {{ $review->rating }}/5</span>
            <p class="mb-1">Nội Dung: {{ $review->review }}</p>
                    <small class="text-muted">{{ $review->created_at->format('d/m/Y H:i') }}</small>
                </div>
            @endforeach
        </div>
    @endif
@endauth


@endsection
