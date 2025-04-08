@extends('layouts.admin')

@section('title','Sửa danh mục')

@section('content')

<form action="{{ route('admin.category.update',$category->id) }}" method="post" enctype="multipart/form-data">
@csrf
@method('PUT')
<div class="row mt-3">
    <div class="col-md-2">
        <label class="form-label">Tên danh mục:</label>
        <input type="text" name="ten_danh_muc" class="form-control @error('gia') is-invalid @enderror"
        value="{{ old('ten_danh_muc',$category->ten_danh_muc) }}"  >
        @error('ten_danh_muc')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>

    <!-- Giá khuyến mãi -->
    <div class="col-md-2" >
        <label class="form-label">Trạng thái:</label>
        <select name="trang_thai" class="form-select" id="">
            <option value="1" {{ $category->trang_thai == 1 ? 'selected' : ''  }} >Còn</option>
            <option value="0" {{ $category->trang_thai == 0 ? 'selected' : ''  }}>Hết</option>
        </select>
    </div>
</div>
<br>
<button type="submit" class="btn btn-primary">Sửa danh mục</button>
</form>



@endsection