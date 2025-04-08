@extends('layouts.admin')

@section('content')
    <h2>Thêm liên hệ</h2>
    <form action="{{ route('admin.contacts.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Tên" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="phone" placeholder="Số điện thoại">
        <textarea name="message" placeholder="Nội dung" required></textarea>
        <select name="status">
            <option value="0">Chưa xử lý</option>
            <option value="1">Đã xử lý</option>
        </select>
        <button type="submit">Lưu</button>
    </form>
@endsection
