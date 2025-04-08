@extends('master.client')

@section('title', 'Trang Chủ')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <!-- Thông báo -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <!-- Sản phẩm mới nhất -->
            <div class="col-md-12">
                <h2 class="text-center mb-4 section-title">8 SẢN PHẨM MỚI NHẤT</h2>
                <div class="row">
                    @foreach ($latestProducts as $product)
                        <div class="col-md-3 mb-4">
                            <div class="card product-card">
                                <div class="product-image-wrapper">
                                    <a href="{{ route('client.detail', $product->id) }}"><img
                                            src="{{ asset('storage/' . $product->hinh_anh) }}" class="card-img-top"
                                            alt="{{ $product->hinh_anh }}"></a>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->ten_san_pham }}</h5>
                                    <p class="card-text description">{{ Str::limit($product->mo_ta, 100) }}</p>
                                    <p class="card-text price text-success">{{ number_format($product->gia, 0, ',', '.') }}
                                        VNĐ</p>
                                    <div class="d-flex gap-2 mt-3">
                                        <a href="{{ route('client.detail', $product->id) }}"
                                            class="btn btn-primary flex-fill">
                                            🔍 Xem chi tiết
                                        </a>
                                        <button class="btn btn-danger flex-fill">
                                            ⚡ Mua ngay
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Bài viết mới nhất -->
            <div class="col-md-12 mt-5">
                <h2 class="text-center mb-4 section-title">4 BÀI VIẾT MỚI NHẤT</h2>
                <div class="row">
                    @foreach ($latestPosts as $post)
                        <div class="col-md-3 mb-4">
                            <div class="card post-card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $post->title }}</h5>
                                    <p class="card-text description">{{ Str::limit($post->content, 100) }}</p>
                                    <a href="#" class="btn btn-info btn-custom">Đọc thêm</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="container mx-auto py-10">
                <h1 class="text-3xl font-bold text-center mb-8">Top 10 Đánh giá Cao Và Mới Nhất</h1>
        
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse ($latestReviews as $review)
                        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                            <!-- User Info -->
                            <div class="flex items-center mb-4">
                                <div>
                                    <div class="space-y-1">
                                        <h2 class="text-lg font-semibold">
                                            Người đánh giá: {{ $review->user->name ?? 'Anonymous' }}
                                        </h2>
                                        <h2 class="text-lg font-semibold">
                                            Sản phẩm: {{ $review->product->ten_san_pham ?? 'Anonymous' }}
                                        </h2>
                                        <p class="text-sm text-gray-500">
                                            {{ $review->created_at->format('d-m-Y') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
        
                            <!-- Rating -->
                            Đánh giá:
                            <div class="flex items-center mb-4">
                                <span class="text-yellow-400 text-xl">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $review->rating)
                                            ★
                                        @else
                                            ☆
                                        @endif
                                    @endfor
                                </span>
                                 <span class="ml-2 text-gray-600">({{ $review->rating }}/5)</span>
                            </div>
        
                            <!-- Review Content -->
                            <p class="text-gray-700">
                                Nội Dung:  {{ $review->review ?? 'No content provided.' }}
                            </p>
                        </div>
                    @empty
                        <div class="col-span-full text-center text-gray-500">
                            <p>No reviews available at the moment.</p>
                        </div>
                    @endforelse
                </div>
            </div>


        </div>
    </div>

    <style>
        /* General Section Styling */
        h2 {
            font-size: 32px;
            font-weight: 600;
            color: #333;
            position: relative;
            margin-bottom: 40px;
        }

        h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: #ff6b6b;
            border-radius: 2px;
        }

        /* Product Card Styling */
        .product-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            height: 100%;
            /* Đảm bảo card có chiều cao bằng nhau */
            display: flex;
            flex-direction: column;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        /* Wrapper để kiểm soát kích thước hình ảnh */
        .product-image-wrapper {
            position: relative;
            width: 100%;
            padding-top: 100%;
            /* Tỷ lệ 1:1 (hình vuông) */
            overflow: hidden;
            background: #f5f5f5;
            /* Màu nền nếu hình không tải được */
        }

        .product-image-wrapper img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: contain;
            /* Hình ảnh giữ nguyên tỷ lệ, không bị cắt */
            transition: transform 0.3s;
            padding: 10px;
            /* Thêm padding để hình nhỏ lại một chút */
            background: #fff;
            /* Nền trắng cho hình ảnh */
        }

        .product-card:hover .product-image-wrapper img {
            transform: scale(1.05);
        }

        .product-card .card-body {
            padding: 15px;
            text-align: center;
            flex: 1;
            /* Đảm bảo card-body chiếm không gian còn lại */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            /* Căn chỉnh các phần tử bên trong */
        }

        .product-card .card-title {
            font-size: 16px;
            font-weight: 500;
            color: #333;
            margin-bottom: 8px;
            min-height: 48px;
            /* Đảm bảo tiêu đề có chiều cao cố định */
            display: -webkit-box;
            -webkit-line-clamp: 2;
            /* Giới hạn 2 dòng */
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .product-card .card-text.description {
            font-size: 13px;
            color: #666;
            margin-bottom: 8px;
            min-height: 40px;
            /* Đảm bảo mô tả có chiều cao cố định */
            display: -webkit-box;
            -webkit-line-clamp: 2;
            /* Giới hạn 2 dòng */
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .product-card .card-text.price {
            font-size: 15px;
            font-weight: 600;
            color: #28a745 !important;
            margin-bottom: 10px;
        }

        .product-card .btn-primary.btn-custom {
            background: #ff6b6b;
            border: none;
            border-radius: 20px;
            padding: 8px 20px;
            font-size: 14px;
            transition: background 0.3s, transform 0.3s;
        }

        .product-card .btn-primary.btn-custom:hover {
            background: #ff8787;
            transform: scale(1.05);
        }

        /* Post Card Styling */
        .post-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .post-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .post-card .card-body {
            padding: 20px;
            text-align: center;
        }

        .post-card .card-title {
            font-size: 18px;
            font-weight: 500;
            color: #333;
            margin-bottom: 10px;
        }

        .post-card .card-text.description {
            font-size: 14px;
            color: #666;
            margin-bottom: 15px;
        }

        .post-card .btn-info.btn-custom {
            background: #17a2b8;
            border: none;
            border-radius: 20px;
            padding: 8px 20px;
            font-size: 14px;
            transition: background 0.3s, transform 0.3s;
        }

        .post-card .btn-info.btn-custom:hover {
            background: #138496;
            transform: scale(1.05);
        }

        /* Review Item Styling */
        .list-group.review-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .list-group-item.review-item {
            border: none;
            border-radius: 10px;
            background: #fff;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            padding: 20px;
            transition: background 0.3s;
        }

        .list-group-item.review-item:hover {
            background: #f8f9fa;
        }

        .review-item .review-content {
            font-size: 15px;
            color: #555;
            margin-bottom: 5px;
        }

        .review-item .review-date {
            font-size: 13px;
            color: #999;
        }
    </style>
@endsection
