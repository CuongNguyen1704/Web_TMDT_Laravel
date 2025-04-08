@extends('layouts.auth')

@section('title', 'Đăng Ký')

@section('content')
    <div class="tabs">
        <a href="{{ route('auth.login') }}" class="tab">Đăng Nhập</a>
        <a href="{{ route('auth.showRegister') }}"  class="tab active">Đăng Ký</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0"> 
                @foreach ($errors->all() as $error)
                    <li class="text-danger">
                        {{ $error }} 
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <h2>Đăng Ký</h2>
    <form method="POST" action="{{ route('auth.register') }}">
        @csrf

        <div class="form-group">
            <label for="name">Tên đăng nhập</label>
            <input 
                type="text" 
                id="username" 
                name="name" 
                value="{{ old('name') }}" 
                
            >
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                value="{{ old('email') }}" 
                
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

        <div class="form-group">
            <label for="password_confirmation">Xác nhận mật khẩu</label>
            <input 
                type="password" 
                id="password_confirmation" 
                name="password_confirmation" 
                
            >
        </div>

        <button type="submit" class="register-btn">Đăng Ký</button>
    </form>
@endsection