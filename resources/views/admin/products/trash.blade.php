@extends('layouts.admin')

@section('content')
    <h2>Danh sách sản phẩm đã xóa</h2>
    
    <table class="table table-bordered">
        <thead>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Danh mục</th>
                <th>Ngày xóa</th>
                <th>Hành động</th>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->ten_san_pham }}</td>
                    <td>{{ number_format($product->gia) }} VNĐ</td>
                    <td>{{ optional($product->category)->ten_danh_muc ?? 'Không có' }}</td>
                    <td>{{ $product->deleted_at->format('d/m/Y H:i') }}</td>
                    <td>
                         <!-- Nút Khôi phục -->
                         <form action="{{ route('admin.products.restore', $product->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success btn-sm">Khôi phục</button>
                        </form>

                        <!-- Nút Xóa Vĩnh Viễn -->
                        <form action="{{ route('admin.products.forcedelete', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn sản phẩm này?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Xóa vĩnh viễn</button>
                        </form> 
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Hiển thị phân trang -->
    {{ $products->links() }}
@endsection
