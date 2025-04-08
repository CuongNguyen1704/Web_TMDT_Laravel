@extends('layouts.admin')
@section('title','Trang thêm sản phẩm')
@section('content')
<div class="container">
    <div class="card shadow-lg p-4">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <!-- Mã sản phẩm -->
                <div class="col-md-6">
                    <label class="form-label">Mã sản phẩm:</label>
                    <input type="text" name="ma_san_pham" class="form-control @error('ma_san_pham') is-invalid @enderror"
                    
                    value="{{ old('ma_san_pham') }}" >
                    @error('ma_san_pham')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tên sản phẩm -->
                <div class="col-md-6">
                    <label class="form-label">Tên sản phẩm:</label>
                    <input type="text" name="ten_san_pham" 
                    class="form-control @error('ten_san_pham') is-invalid @enderror"
                    value="{{ old('ten_san_pham') }}" >
                    @error('ten_san_pham')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="row mt-3">
                <!-- Danh mục -->
                <div class="col-md-6">
                    <label class="form-label">Danh mục:</label>
                    <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                        <option value="">Chọn danh mục</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" 
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->ten_danh_muc }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Hình ảnh -->
                <div class="col-md-6">
                    <label class="form-label">Hình ảnh:</label>
                    <input type="file" name="hinh_anh" class="form-control">
                </div>
            </div>

            <div class="row mt-3">
                <!-- Giá -->
                <div class="col-md-6">
                    <label class="form-label">Giá:</label>
                    <input type="number" name="gia" class="form-control @error('gia') is-invalid @enderror"
                    value="{{ old('gia') }}"  >
                    @error('gia')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Giá khuyến mãi -->
                <div class="col-md-6">
                    <label class="form-label">Giá khuyến mãi:</label>
                    <input type="number" name="gia_khuyen_mai" class="form-control"
                    value="{{ old('gia_khuyen_mai') }}">
                </div>
            </div>

            <div class="row mt-3">
                <!-- Số lượng -->
                <div class="col-md-6">
                    <label class="form-label">Số lượng:</label>
                    <input type="number" name="so_luong" class="form-control @error('so_luong') is-invalid @enderror" 
                    value="{{ old('so_luong') }}" >
                    @error('so_luong')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Ngày nhập -->
                <div class="col-md-6">
                    <label class="form-label">Ngày nhập:</label>
                    <input type="date" name="ngay_nhap" class="form-control @error('ngay_nhap') is-invalid @enderror"
                    value="{{ old('ngay_nhap') }}" >
                    @error('ngay_nhap')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="row mt-3">
                <!-- Trạng thái -->
                <div class="col-md-6">
                    <label class="form-label">Trạng thái:</label>

                    <select name="trang_thai" class="form-select">
                        <option value="1" >Hoạt động</option>
                        <option value="0">Ngừng kinh doanh</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Mô tả:</label>
                    <input type="text" name="mo_ta" class="form-control" 
                    value="{{ old('mo_ta') }}">
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary px-4">Thêm sản phẩm</button>
            </div>
        </form>
    </div>
</div>

@endsection