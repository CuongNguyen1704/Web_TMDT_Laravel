@extends('layouts.admin')

@section('content')
    <h1>Sửa đánh giá</h1>
    <form action="{{ route('admin.reviews.update', $review->id) }}" method="POST">
        @csrf @method('PUT')

        <label>Khách hàng ID:</label>
        <input type="number" name="customer_id" value="{{ $review->customer_id }}" required>

        <label>Sản phẩm ID:</label>
        <input type="number" name="product_id" value="{{ $review->product_id }}" required>

        <label>Đánh giá:</label>
        <textarea name="review">{{ $review->review }}</textarea>

        <label>Xếp hạng:</label>
        <input type="number" name="rating" min="1" max="5" value="{{ $review->rating }}" required>

        <button type="submit">Cập nhật</button>
    </form>
@endsection
