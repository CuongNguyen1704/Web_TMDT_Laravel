<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $query = Product::with('category');
        // tìm kiếm theo sản phẩm
        if($request->filled('ma_san_pham'))// kiểm tra xem resquest có chứa mã sản phẩm không
        {
            $query->where('ma_san_pham', 'LIKE', '%'. $request->ma_san_pham . '%');
        }
        $products = $query->orderBy('products.id', 'DESC')->paginate(10);
        // return view('admin.products.home',compact('products'));
        // return response()->json($products,200);
        return ProductResource::collection($products);


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        // Lấy ra dữ liệu chi tiết theo id
        $product = Product::with('category')->findOrFail($id);
        // dd($product);
        // đổ dữ liệu thông tin chi ra giao diện
        // return response()->json($product,200);
        return new ProductResource($product);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
