@extends('layouts.admin')

@section('content')
    <h1>Thùng rác đánh giá</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Khách hàng</th>
                <th>Sản phẩm</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reviews as $review)
                <tr>
                    <td>{{ $review->id }}</td>
                    <td>{{ $review->user->name ?? 'N/A' }}</td>
                    <td>{{ $review->product->ten_san_pham ?? 'N/A' }}</td>
                    <td>
                        <form action="{{ route('admin.reviews.restore', $review->id) }}" method="POST" style="display:inline;"
                            onsubmit="return confirm('Bạn muốn khôi phục chứ')">
                            @csrf @method('PATCH')
                            <button type="submit" class="btn btn-info">Khôi phục</button>
                        </form>
                        <form action="{{ route('admin.reviews.forceDelete', $review->id) }}" method="POST" style="display:inline;"
                            onsubmit="return confirm('Bạn chắc chắn muốn xóa chứ')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger">Xóa vĩnh viễn</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
