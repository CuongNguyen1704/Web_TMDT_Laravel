@extends('layouts.admin')

@section('title','trang thêm danh mục')

@section('content')

<form action="{{ route('admin.category.store') }}" method="post" enctype="multipart/form-data">
@csrf
<div class="row mt-3">
    <div class="col-md-2">
        <label class="form-label">Tên danh mục:</label>
        <input type="text" name="ten_danh_muc" class="form-control @error('gia') is-invalid @enderror"
        value="{{ old('ten_danh_muc') }}"  >
        @error('ten_danh_muc')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>

    <!-- Giá khuyến mãi -->
    <div class="col-md-2" >
        <label class="form-label">Trạng thái:</label>
        <select name="trang_thai" class="form-select" id="">
            <option value="1">Còn</option>
            <option value="0">Hết</option>
        </select>
    </div>
</div>
<br>
<button type="submit" class="btn btn-primary">Thêm danh mục</button>
</form>



@endsection