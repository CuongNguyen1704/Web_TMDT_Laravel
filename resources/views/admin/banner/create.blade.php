@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4">Thêm Banner</h2>
    
    <form action="{{ route('admin.banner.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Tiêu đề -->
        <div class="mb-3">
            <label for="title" class="form-label">Tiêu đề</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" >
            @error('title')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <!-- Hình ảnh -->
        <div class="mb-3">
            <label for="image" class="form-label">Hình ảnh</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" >
        </div>

        <!-- Mô tả -->
        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea class="form-control" id="description" name="description" value="{{ old('description') }}" rows="3"></textarea>
            @error('description')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <!-- Trạng thái -->
        <div class="mb-3">
            <label for="status" class="form-label">Trạng thái</label>
            <select class="form-select" id="status" name="status">
                <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Hiển thị</option>
                <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Ẩn</option>
            </select>
        </div>

        <!-- Nút Submit -->
        <button type="submit" class="btn btn-primary">Thêm Banner</button>
    </form>
</div>
@endsection
