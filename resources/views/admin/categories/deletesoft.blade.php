@extends('layouts.admin')
@section('title', 'Danh sách xóa mềm')

@section('content')
    <table class="table table-hover align-middle">
        <thead>
            <th>Tên danh mục</th>
            <th>Ngày xóa</th>
            <th>Thao tác</th>
        </thead>
        <tbody>

            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->ten_danh_muc }}</td>
                    <td>{{ $category->deleted_at }}</td>
                    <td>
                        <form action="{{ route('admin.category.restore', $category->id) }}" method="post"
                            onsubmit="return confirm('chắc chắn khôi phục không?')">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-warning">Khôi phục</button>
                        </form>
                        <form action="{{ route('admin.category.forcedelete', $category->id) }}" method="POST"
                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn danh mục này?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" >Xóa vĩnh viễn</button>
                        </form>
                    </td>
                    
                        
                    
                </tr>

            @endforeach

        </tbody>

    </table>
    <a href="{{ route('admin.category.index') }}" class="btn btn-warning">Quay về</a>

@endsection
