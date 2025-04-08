<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

// mặc định apiResource sẽ trỏ tới 5 hàm mặc định trong controller api
// Nếu muốn tạo ra các phương thức mới trong controllerAPi
// thì ta phải tạo ra thêm các route khác để trỏ tới phương thức đó

Route::apiResource('products',ProductController::class);