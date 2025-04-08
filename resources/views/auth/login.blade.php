@extends('layouts.auth')

@section('title', 'Đăng Nhập')

@section('content')
    <div class="tabs">
        <a href="{{ route('auth.login') }}" class="tab">Đăng Nhập</a>
        <a href="{{ route('auth.showRegister') }}"  class="tab active">Đăng Ký</a>
    </div>

    <h2>Đăng Nhập</h2>
    <form method="POST" action="{{ route('auth.login-post')  }}">
        @csrf

        {{-- <div class="form-group">
            <label for="username">Tên đăng nhập</label>
            <input 
                type="text" 
                id="username" 
                name="username" 
                value="{{ old('username') }}" 
            >
            @error('username')
                <div class="error">{{ $message }}</div>
            @enderror
        </div> --}}
        <div class="form-group">
            <label for="email">Email</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                value=""    
            >
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Mật khẩu</label>
            <input 
                type="password" 
                id="password" 
                name="password" 
                
            >
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="login-btn">Đăng Nhập</button>
    </form>
@endsection