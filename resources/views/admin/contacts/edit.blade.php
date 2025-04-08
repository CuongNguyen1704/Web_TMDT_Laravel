@extends('layouts.admin')

@section('content')
    <h2>Chỉnh sửa liên hệ</h2>
    <form action="{{ route('admin.contacts.update', $contact->id) }}" method="POST">
        @csrf @method('PUT')
        <input type="text" name="name" value="{{ $contact->name }}" required>
        <input type="email" name="email" value="{{ $contact->email }}" required>
        <input type="text" name="phone" value="{{ $contact->phone }}">
        <textarea name="message" required>{{ $contact->message }}</textarea>
        <select name="status">
            <option value="0" {{ !$contact->status ? 'selected' : '' }}>Chưa xử lý</option>
            <option value="1" {{ $contact->status ? 'selected' : '' }}>Đã xử lý</option>
        </select>
        <button type="submit">Cập nhật</button>
    </form>
@endsection
