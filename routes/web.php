<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Client\ProductController as ClientProductController;
use App\Http\Controllers\Admin\CustomerController;

Route::prefix('admin')->middleware(['auth','admin'])->name('admin.')->group(function () {
    // Các đường dẫn admin sẽ được đặt trong đây
    // Route::get('/products', [ProductController::class, 'index'])->name('admin.list');

    // Route quản lí sản phẩm
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/',          [ProductController::class, 'index'])->name('index');
        Route::get('/create',    [ProductController::class, 'create'])->name('create');
        Route::post('/store',    [ProductController::class, 'store'])->name('store');
        Route::get('/deletesoft', [ProductController::class, 'deletesoft'])->name('deletesoft');
        Route::patch('/restore/{id}', [ProductController::class, 'restore'])->name('restore');
        Route::delete('/forcedelete/{id}', [ProductController::class, 'forcedelete'])->name('forcedelete');

        Route::get('/{id}/show', [ProductController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [ProductController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [ProductController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('category')->name('category.')->group(function () {
        Route::get('/',          [CategoryController::class, 'index'])->name('index');
        Route::get('/create',    [CategoryController::class, 'create'])->name('create');
        Route::post('/store',    [CategoryController::class, 'store'])->name('store');
        Route::get('/deletesoft', [CategoryController::class, 'deletesoft'])->name('deletesoft');
        Route::patch('/restore/{id}', [CategoryController::class, 'restore'])->name('restore');
        Route::delete('/forcedelete/{id}', [CategoryController::class, 'forcedelete'])->name('forcedelete');
        Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [CategoryController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [CategoryController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('banner')->name('banner.')->group(function () {
        Route::get('/',          [BannerController::class, 'index'])->name('index');
        Route::get('/create',    [BannerController::class, 'create'])->name('create');
        Route::post('/store',    [BannerController::class, 'store'])->name('store');
        Route::delete('/{id}/destroy', [BannerController::class, 'destroy'])->name('destroy');

        Route::get('/trash', [BannerController::class, 'trash'])->name('trash');
        Route::patch('/restore/{id}', [BannerController::class, 'restore'])->name('restore');
        Route::delete('/forcedelete/{id}', [BannerController::class, 'forceDelete'])->name('forcedelete');
        Route::get('/{id}/show', [BannerController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [BannerController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [BannerController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [BannerController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('posts')->name('posts.')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('index');
        Route::get('/create', [PostController::class, 'create'])->name('create');
        Route::post('/store', [PostController::class, 'store'])->name('store');
        Route::get('/trash', [PostController::class, 'trash'])->name('trash');
        Route::patch('/restore/{id}', [PostController::class, 'restore'])->name('restore');
        Route::delete('/force-delete/{id}', [PostController::class, 'forceDelete'])->name('forceDelete');
        Route::get('/{id}/edit', [PostController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [PostController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [PostController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/',          [UserController::class, 'index'])->name('index');
        Route::get('/create',    [UserController::class, 'create'])->name('create');
        Route::post('/store',    [UserController::class, 'store'])->name('store');
        Route::get('/{id}/show', [UserController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [UserController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [UserController::class, 'destroy'])->name('destroy');
    
        // Thêm route xóa mềm, khôi phục và xóa vĩnh viễn
        Route::get('/trash', [UserController::class, 'trash'])->name('trash');
        Route::patch('/restore/{id}', [UserController::class, 'restore'])->name('restore');
        Route::delete('/force-delete/{id}', [UserController::class, 'forceDelete'])->name('forceDelete');
    });

    Route::prefix('reviews')->name('reviews.')->group(function () {
        Route::get('/', [ReviewController::class, 'index'])->name('index');
        Route::get('/create', [ReviewController::class, 'create'])->name('create');
        Route::post('/store', [ReviewController::class, 'store'])->name('store')->withoutMiddleware('admin');
        Route::get('/trash', [ReviewController::class, 'trash'])->name('trash');
        Route::patch('/restore/{id}', [ReviewController::class, 'restore'])->name('restore');
        Route::delete('/force-delete/{id}', [ReviewController::class, 'forceDelete'])->name('forceDelete');
        Route::get('/{id}/edit', [ReviewController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [ReviewController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [ReviewController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('contacts')->name('contacts.')->group(function () {
        Route::get('/', [ContactController::class, 'index'])->name('index');
        Route::get('/create', [ContactController::class, 'create'])->name('create');
        Route::post('/store', [ContactController::class, 'store'])->name('store');
        Route::get('/{contact}/show', [ContactController::class, 'show'])->name('show');
        Route::get('/{contact}/edit', [ContactController::class, 'edit'])->name('edit');
        Route::put('/{contact}/update', [ContactController::class, 'update'])->name('update');
        Route::delete('/{contact}/destroy', [ContactController::class, 'destroy'])->name('destroy');

        Route::get('/trash', [ContactController::class, 'trash'])->name('trash');
        Route::patch('/restore/{id}', [ContactController::class, 'restore'])->name('restore');
        Route::delete('/force-delete/{id}', [ContactController::class, 'forceDelete'])->name('forceDelete');
    });


    Route::get('/', [ProductController::class, 'demo'])->name('demo');
});



Route::prefix('auth')->name('auth.')->group(function(){
    Route::get('/form-login',[AuthController::class, 'showLogin'])->name('login');
    Route::get('/form-resgiter',[AuthController::class, 'showRegister'])->name('showRegister');
    Route::post('/register',[AuthController::class, 'regsiter'])->name('register');
    Route::post('/login',[AuthController::class, 'login'])->name('login-post');
    Route::post('/logout',[AuthController::class, 'logout'])->name('logout');
});

Route::get('/login', function () {
    return redirect()->route('auth.login');
})->name('login');


Route::prefix('/')->name('client.')->group(function(){
    Route::get('/',[ClientProductController::class, 'index'])->name('index');
    Route::get('/listProduct',[ClientProductController::class ,'listProduct'])->name('listProduct');
    Route::get('/detail/{id}',[ClientProductController::class ,'detail'])->name('detail');
    Route::get('/profile', [ClientProductController::class, 'profile'])->name('profile');
    Route::get('/posts', [ClientProductController::class, 'posts'])->name('posts');
});

// Route::get('/login',function(){
//     return view('auth.login');
    
// });

// Route::get('/register',function(){
//     return view('auth.register');
    
// });



