<?php

namespace App\Http\Controllers\Client;

use App\Models\Post;
use App\Models\Banner;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $latestProducts = Product::latest()->take(8)->get();
        $latestPosts = Post::latest()->take(4)->get();
        $latestReviews = Review::with('user','product')  // Join bảng customers qua model
            ->orderByDesc('rating')  // Sắp xếp theo rating cao nhất
            ->orderByDesc('created_at') // Nếu rating bằng nhau, lấy review mới nhất
            ->take(10) // Lấy 10 review
            ->get();
        $categories = Category::all();
        $banners = Banner::latest()->orderByDesc('created_at')->take(3)->get();
        return view('client.home.home', compact('latestProducts', 'latestPosts', 'banners', 'categories','latestReviews'));
    }

    public function listProduct(Request $request)
    {
        // Lấy các banner mới nhất
        $banners = Banner::latest()->take(3)->get();

        // Lấy từ khóa tìm kiếm từ request
        $search = $request->input('ten_san_pham');

        // Lấy danh sách tất cả các danh mục
        $categories = Category::all();

        // Truy vấn sản phẩm với điều kiện tìm kiếm
        $query = Product::query();

        $price_min = $request->input('price_min');
        $price_max = $request->input('price_max');

        // Nếu có từ khóa tìm kiếm, thêm điều kiện tìm kiếm sản phẩm
        if ($search) {
            $query->where('ten_san_pham', 'LIKE', "%$search%");
        }

        if ($price_min) {
            $query->where('gia', '>=', $price_min);
        }

        if ($price_max) {
            $query->where('gia', '<=', $price_max);
        }

        // Sắp xếp theo giá nếu có yêu cầu
        $sort_price = $request->input('sort_price');
        if ($sort_price) {
            $query->orderBy('gia', $sort_price);  // asc (thấp đến cao) hoặc desc (cao xuống thấp)
        } else {
            $query->orderBy('gia', 'asc');
        }

        // Nếu có category_id, lọc sản phẩm theo danh mục
        $category_id = $request->input('category_id');
        if ($category_id) {
            $query->where('category_id', $category_id);
        }

        // Lấy danh sách sản phẩm, sử dụng phân trang với 10 sản phẩm mỗi trang
        $listProduct = $query->paginate(10)->withQueryString();


        // Trả về view với dữ liệu
        return view('client.home.listProduct', compact('listProduct', 'banners', 'categories'));
            // ->with('search', $search)
            // ->with('price_min', $price_min)
            // ->with('price_max', $price_max)
            // ->with('sort_price', $sort_price)
            // ->with('category_id', $category_id); 
    }

    public function detail($id)
    {
        $categories = Category::all();
        $product = Product::with('category')->findOrFail($id);
        // Lấy 5 sản phẩm cùng danh mục (ngoại trừ chính nó)
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(5)
            ->get();
        // Lấy toàn bộ đánh giá cho sản phẩm này
        $reviews = $product->review()->with('user')->latest()->get();
        return view('client.home.detail', compact('product', 'categories', 'relatedProducts','reviews'));
    }


    public function profile()
    {
        $user = Auth::user();  // Lấy thông tin người dùng hiện tại

        return view('client.partials.header', compact('user')); // Trả về view với thông tin người dùng
    }

    public function posts(){
        $post = Post::paginate(5);
        $categories = Category::all();
        return view('client.home.post',compact('post','categories'));
    }

  
}
