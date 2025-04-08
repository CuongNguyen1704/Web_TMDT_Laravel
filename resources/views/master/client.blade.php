<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Cửa hàng') - FPOLYSHOP</title>
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/client.css') }}">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">


</head>

<body>
    @include('client.partials.header')

    @if (!request()->is('detail/*') && !request()->is('posts*'))
    @include('client.partials.banner') <!-- Chỉ hiển thị banner khi KHÔNG phải trang chi tiết và trang reviews -->
@endif

    @include('client.partials.main')
    @include('client.partials.footer')

    <!-- JS -->
    <script src="{{ asset('js/client.js') }}"></script>
</body>

</html>
