
<body>
@include('admin.partials.header')
    <!-- Sidebar -->
@include('admin.partials.sidebar')

    <!-- Content Area -->
    <div class="content">
        <div class="header">
            <h1>@yield('title', 'Dashboard')</h1>
        </div>

        <main>
            @yield('content')  {{-- Nội dung riêng của từng trang --}}
        </main>

@include('admin.partials.footer')

    </div>

</body>
</html>
