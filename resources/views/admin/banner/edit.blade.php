@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4">Thêm Banner</h2>
    
    <form action="{{  route('admin.banner.update', ['id' => $banner->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <!-- Tiêu đề -->
        <div class="mb-3">
            <label for="title" class="form-label">Tiêu đề</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title',$banner->title) }}" >
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
        <div class="mb-3">@extends('layouts.admin')

            @section('content')
            <div class="container">
                <h2 class="mb-4">Chỉnh sửa Banner</h2> <!-- Sửa tiêu đề -->
            
                <form action="{{ route('admin.banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
            
                    <!-- Tiêu đề -->
                    <div class="mb-3">
                        <label for="title" class="form-label">Tiêu đề</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $banner->title) }}" >
                        @error('title')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
            
                    <!-- Hình ảnh -->
                    <div class="mb-3">
                        <label for="image" class="form-label">Hình ảnh</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        <div class="mt-2">
                            @if ($banner->image)
                            <label for="">Hình ảnh cũ: </label>
                            <img src="{{ asset('storage/' . $banner->image) }}" alt="Banner Image" width="150"> <!-- Hiển thị ảnh cũ -->
                            @endif
                        </div>
                    </div>
            
                    <!-- Mô tả -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Mô tả</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $banner->description) }}</textarea>
                        @error('description')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
            
                    <!-- Trạng thái -->
                    <div class="mb-3">
                        <label for="status" class="form-label">Trạng thái</label>
                        <select class="form-select" id="status" name="status">
                            <option value="1" {{ old('status', $banner->status) == 1 ? 'selected' : '' }}>Hiển thị</option>
                            <option value="0" {{ old('status', $banner->status) == 0 ? 'selected' : '' }}>Ẩn</option>
                        </select>
                    </div>
            
                    <!-- Nút Submit -->
                    <button type="submit" class="btn btn-primary">Cập nhật Banner</button>
                </form>
            </div>
            @endsection
            
            <label for="description" class="form-label">Mô tả</label>
            <textarea class="form-control" id="description" name="description" value="{{ old('description',$banner->description) }}" rows="3"></textarea>
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
