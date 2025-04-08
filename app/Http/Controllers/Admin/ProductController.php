<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    //
    public function index(Request $request){
        $query = Product::with('category');
        // tìm kiếm theo sản phẩm
        if($request->filled('ma_san_pham'))// kiểm tra xem resquest có chứa mã sản phẩm không
        {
            $query->where('ma_san_pham', 'LIKE', '%'. $request->ma_san_pham . '%');
        }

        if($request->filled('ten_san_pham')){
            $query->where('ten_san_pham', 'LIKE', '%'. $request->ten_san_pham . '%');
        }

        if($request->filled('category_id')){
            // Lọc category_id ở products so sánh = với category_id ở request
            $query->where('category_id', $request->category_id);
        }

        if($request->filled('trang_thai')){
            
            $query->where('products.trang_thai', $request->trang_thai);
        }

        if($request->filled('min_price')){
            $query->where('gia', '>=',$request->min_price);
        }

        if($request->filled('max_price')){
            $query->where('gia', '<=',$request->max_price);
        }
        
        if($request->filled('ngay_nhap')){
            $query->where('ngay_nhap', $request->ngay_nhap);
        }
        
        $products = $query->orderBy('products.id', 'DESC')->paginate(10);
        $categories = Category::all();
        $trangThaiList = Product::pluck('trang_thai')->unique();
        return view('admin.products.home',compact('products','categories','trangThaiList'));
        // Tương tự thực hiện tìm kiếm sản phẩm theo:
        // Tên sản phẩm, Danh mục, Khoảng giá, Ngày nhập, Trạng thái
    }

    public function demo(){
        return view('admin.products.demo');
    }

    public function show($id){

        // Lấy ra dữ liệu chi tiết theo id
        $product = Product::with('category')->findOrFail($id);
        // dd($product);
        // đổ dữ liệu thông tin chi ra giao diện
        return view('admin.products.show',compact('product'));

    }
    public function create(){
        $categories = Category::all();
        return view('admin.products.create',compact('categories'));

    }
    
    public function store(Request $request)
    {
        // // Khởi tạo 1 đối tượng product mới
        // $product = new Product();
        // // lấy giữ liệu từ form
        // $product->ma_san_pham = $request->ma_san_pham;
        // $product->ten_san_pham = $request->ten_san_pham;
        // $product->category_id = $request->category_id;
        // $product->gia = $request->gia;
        // $product->gia_khuyen_mai = $request->gia_khuyen_mai;
        // $product->so_luong = $request->so_luong;
        // $product->ngay_nhap = $request->ngay_nhap;
        // $product->mo_ta = $request->mo_ta;
        // $product->trang_thai = $request->trang_thai;

        // // Xử lý hình ảnh
        // if($request->hasFile('hinh_anh')){
        //     $imgagePath = $request->files('hinh_anh')->store('image/products','public');
        //     $product->hinh_anh = $imgagePath;         
        // }

        // // Lưu sản phẩm
        // $product->save();

        // validate
        $dataValidate = $request->validate([
            'ma_san_pham' => 'required|string|max:20|unique:products,ma_san_pham',
            'ten_san_pham' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'hinh_anh'=>'nullable|image|mimes:jpg,png,jpeg,gif',
            'gia'=> 'required|numeric|min:0|max:999999999999',
            'gia_khuyen_mai'=>'nullable|numeric|min:0|lt:gia',
            'so_luong'=>'required|integer|min:1',
            'ngay_nhap'=> 'required|date',
            'mo_ta'=>'nullable|string',
            'trang_thai'=>'required|in:0,1',
        ]);

        // Xử lý hình ảnh
        if($request->hasFile('hinh_anh')){
            // Lưu đường dẫn ảnh vào trong thư mục 
            $imagePath = $request->file('hinh_anh')->store('image/products','public');
            $dataValidate['hinh_anh'] = $imagePath;         
        }
        Product::create($dataValidate);
        return redirect()->route('admin.products.index');

    }

    public function edit($id){
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit',compact('categories','product'));
    }
    public function update(Request $request, $id){
        $product = Product::findOrFail($id);
        $dataValidate = $request->validate([
            'ma_san_pham' => 'required|string|max:20|unique:products,ma_san_pham,' . $id,
            'ten_san_pham' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'hinh_anh'=>'nullable|image|mimes:jpg,png,jpeg,gif',
            'gia'=> 'required|numeric|min:0|max:999999999999',
            'gia_khuyen_mai'=>'nullable|numeric|min:0|lt:gia',
            'so_luong'=>'required|integer|min:1',
            'ngay_nhap'=> 'required|date',
            'mo_ta'=>'nullable|string',
            'trang_thai'=>'required|in:0,1',
        ]);

        // Xử lý hình ảnh
        if($request->hasFile('hinh_anh')){
            // Lưu đường dẫn ảnh vào trong thư mục 
            $imagePath = $request->file('hinh_anh')->store('image/products','public');
            $dataValidate['hinh_anh'] = $imagePath;   
            
            if($product->hinh_anh){
                Storage::disk('public')->delete($product->hinh_anh);
            }
        }
        $product->update($dataValidate);
        return redirect()->route('admin.products.index');
    }
    public function destroy($id){
        $product = Product::findOrFail($id);
        if($product->hinh_anh){
            Storage::disk('public')->delete($product->hinh_anh);
        }
        $product->delete();
        return redirect()->route('admin.products.index')->with('success','xóa sản phẩm thành công');
    }

    public function deletesoft()
    {
        $products = Product::onlyTrashed()->orderBy('deleted_at', 'DESC')->paginate(10);
        return view('admin.products.trash', compact('products'));
    }

    public function restore($id)
{
    $product = Product::onlyTrashed()->where('id', $id)->firstOrFail();
    $product->restore();
    return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được khôi phục!');
}

public function forceDelete($id)
{
    $product = Product::onlyTrashed()->where('id', $id)->firstOrFail();
    $product->forceDelete();
    return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã bị xóa vĩnh viễn!');
}

    // Xây dựng master layout trang quản trị 
    // Tạo trang để quản lí thông tin sản phẩm
    // Thực hiện hiển thị danh sách sản phẩm ra bảng có phân trang

    
}
