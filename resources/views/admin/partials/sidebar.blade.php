<div class="sidebar">
    <h2>Trang Quản Trị</h2>
    <ul>
        <li><a href="{{ route('admin.demo') }}">Trang chủ</a></li>
        <li><a href="{{ route('admin.products.index') }}">Quản lý sản phẩm</a></li>
        <li><a href="{{ route('admin.category.index') }}">Quản lý Danh mục</a></li>
        <li><a href="{{ route('admin.banner.index') }}">Quản lý Banner</a></li>
        <li><a href="{{ route('admin.posts.index') }}">Quản lý Bài viết</a></li>
        <li><a href="{{ route('admin.users.index') }}">Quản lý Người dùng</a></li>
        <li><a href="{{ route('admin.reviews.index') }}">Quản lý Review</a></li>
        <li><a href="{{ route('admin.contacts.index') }}">Liên Hệ</a></li>


    </ul>
    <br>
   
        <form action="{{ route('auth.logout') }}" method="post">
            @csrf 
            
            <button type="submit" class="btn btn-danger w-75">Đăng xuất</button>

        </form>
    
    

</div>