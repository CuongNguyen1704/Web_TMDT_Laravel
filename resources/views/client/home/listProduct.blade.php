@extends('master.client')

@section('title','Danh sách sản phẩm')

@section('content')
    <!-- Form tìm kiếm -->
    <form method="GET" action="{{ route('client.listProduct') }}" class="mb-4">
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="price_min">Giá từ (VNĐ)</label>
                    <input type="number" class="form-control" name="price_min" id="price_min" placeholder="Nhập giá tối thiểu" value="{{ request('price_min') }}">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="price_max">Giá đến (VNĐ)</label>
                    <input type="number" class="form-control" name="price_max" id="price_max" placeholder="Nhập giá tối đa" value="{{ request('price_max') }}">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="sort_price">Sắp xếp theo giá</label>
                    <select class="form-control" name="sort_price" id="sort_price">
                        <option value="">Chọn cách sắp xếp</option>
                        <option value="asc" {{ request('sort_price') === 'asc' ? 'selected' : '' }}>Giá từ thấp đến cao</option>
                        <option value="desc" {{ request('sort_price') === 'desc' ? 'selected' : '' }}>Giá từ cao xuống thấp</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Tìm kiếm</button>
            </div>
        </div>
    </form>

    <h3 style="text-align: center;margin-bottom: 20px">DANH SÁCH  SẢN PHẨM</h3>

    <div class="container">
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-4">
            @foreach ($listProduct as $product)
                <div class="col">
                    <div class="card shadow-sm border-0">
                        <a href="{{ route('client.detail',$product->id) }}"><img src="{{ asset('storage/' . $product->hinh_anh) }}" class="card-img-top" alt="{{ $product->ten_san_pham }}"></a>
                        <div class="card-body text-center">
                            <h6 class="card-title text-truncate">{{ $product->ten_san_pham }}</h6>
                            <p class="card-text text-danger fw-bold">{{ number_format($product->gia, 0, ',', '.') }} VNĐ</p>
                            <a href="{{ route('client.detail', $product->id) }}" class="btn btn-primary flex-fill">
                                🔍 Xem chi tiết
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


        <div class="d-flex justify-content-center mt-3">
            {{ $listProduct->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
