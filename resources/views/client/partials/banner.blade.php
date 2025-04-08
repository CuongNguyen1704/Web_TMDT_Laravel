<div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach($banners as $key => $b)
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                <img src="{{ asset('storage/' . $b->image) }}" class="d-block w-100 banner-img" alt="Banner">
                {{-- <div class="carousel-caption d-none d-md-block">
                    <h5>{{ $b->title }}</h5>
                    <p>{{ $b->description }}</p>
                </div> --}}
            </div>
        @endforeach
    </div>

    <!-- Nút điều hướng -->
    <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
    </button>

    <style>
       .banner-img {
    height: 500px; /* Chiều cao cố định */
    object-fit: cover; /* Giữ tỉ lệ, cắt phần thừa */
}

    </style>
</div>