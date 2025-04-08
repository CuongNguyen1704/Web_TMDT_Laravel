<header class="header">
    <div class="top-bar">
        <div class="container">
            <div class="top-bar-content">
                <span><i class="fas fa-phone-alt"></i> Hotline: 0123-456-789</span>
                <div class="user-actions d-flex align-items-center gap-3">
                  
                    @if (Auth::check() && Auth::user()->role == 'user')
                        <!-- Nếu người dùng đã đăng nhập và có quyền là 'user' -->
                        <a href="#" 
                           class="d-flex align-items-center text-decoration-none text-dark p-2 rounded hover-bg">
                            <i class="fas fa-user-circle me-2" style="font-size: 1.5rem; color: #007bff;"></i>
                            <span class="text-white">{{ Auth::user()->name }}</span>
                        </a>
                        <form action="{{ route('auth.logout') }}" method="POST">
                            @csrf
                            <button 
                           class="d-flex align-items-center text-decoration-none text-dark p-2 rounded hover-bg">
                            <i class="fas fa-sign-out-alt me-2" style="font-size: 1.5rem; color: #43dc35;"></i>
                            <span class="text-white">Đăng xuất</span>  
                        </button>
                        </form>
                    @else
                        <!-- Nếu người dùng chưa đăng nhập -->
                        <a href="{{ route('auth.login') }}" 
                           class="d-flex align-items-center text-decoration-none text-dark p-2 rounded hover-bg">
                            <i class="fas fa-user me-2" style="font-size: 1.5rem; color: #28a745;"></i>
                            <span class="text-white">Đăng ký/Đăng nhập</span>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <nav class="main-nav">
        <div class="container">
            <div class="nav-content">
                <a href="{{ route('client.index') }}" class="logo">FPOLYSHOP</a>
                <ul class="nav-menu">
                    <li class="dropdown">
                        <button class="btn btn-danger dropdown-toggle category-btn" id="categoryDropdown"
                            data-bs-toggle="dropdown">
                            <i class="fas fa-bars"></i> Danh mục
                        </button>
                        <ul class="dropdown-menu">
                            @foreach ($categories as $category)
                                <li><a class="dropdown-item"
                                        href="{{ route('client.listProduct', ['category_id' => $category->id]) }}">
                                        {{ $category->ten_danh_muc }}
                                    </a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="{{ route('client.listProduct') }}">Danh Sách Sản phẩm</a></li>
                    <li><a href="{{ route('client.posts') }}">Danh sách bài viết</a></li>
                    <li><a href="">Liên hệ</a></li>
                </ul>
                <div class="nav-right">
                    <form class="search-form" action="{{ route('client.listProduct') }}" method="GET">
                        @csrf
                        <input type="text" name="ten_san_pham" placeholder="Tìm kiếm..." value="{{ request('ten_san_pham') }}">
                        <button type="submit"><i class="fas fa-search"></i></button>
                    </form>
                    <a href="" class="cart-icon">
                        <i class="fas fa-shopping-bag"></i>
                        <span class="cart-count"></span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <style>
        .category-btn {
            border: none;
            background-color: #b71c1c;
            color: white;
            padding: 10px 15px;
            border-radius: 20px;
            font-size: 16px;
        }

        .category-btn i {
            margin-right: 8px;
        }

        .dropdown-menu {
            background: white;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .dropdown-item {
            color: #333;
            padding: 10px;
        }

        .dropdown-item:hover {
            background: #f8f9fa;
            color: #d9534f;
        }

        /* Style cho ảnh người dùng */
        .user-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 8px;
            object-fit: cover;
        }
        .user-actions {
            padding: 0.5rem;
        }
        .hover-bg:hover {
            background-color: #a31942;
            transition: background-color 0.3s;
        }
        .hover-bg:hover i {
            color: #0056b3; /* Màu khi hover cho icon profile */
        }
        .hover-bg:hover span {
            color: #007bff; /* Màu khi hover cho text */
        }
        .hover-bg[href*='logout']:hover i {
            color: #c82333; /* Màu khi hover cho icon logout */
        }
        .hover-bg[href*='login']:hover i {
            color: #218838; /* Màu khi hover cho icon login */
        }
    </style>
</header>
