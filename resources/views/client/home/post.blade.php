@extends('master.client')

@section('title', 'Danh sách bài post')

@section('content')

    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900">Danh sách bài Post</h1>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        @if ($post->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($post as $item)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                        <!-- Post Content -->
                        <div class="p-6">
                            <!-- Title -->
                            <h2 class="text-xl font-semibold text-gray-800 mb-2">
                              <p>Tiêu đề: </p>  {{ $item->title ?? 'Untitled Post' }}
                            </h2>

                            <!-- Content Preview -->
                            <p class="text-gray-600 mb-4 line-clamp-3">
                              <p>Nội dung: </p>  {{ $item->content ?? 'No content available' }}
                            </p>

                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination (nếu cần) -->
            <div class="mt-8">
                {{ $post->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-600 text-lg">No reviews found at the moment.</p>
            </div>
        @endif
    </main>

@endsection
