<?php
namespace App\Http\Controllers\Admin;

use App\Models\Review;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::with(['user', 'product'])->latest()->paginate(10);
        $products = Product::all();
        $users = User::all();
        return view('admin.reviews.index', compact('reviews','products','users'));    
    }
    public function create()
    {
        $products = Product::all();
        $users = User::all();
        return view('admin.reviews.create',compact('products','users'));
    }

    public function store(Request $request)
    {
        // validate dữ liệu
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
            'user_id' => $request->user()?->id ? 'nullable' : 'required|exists:users,id',
        ]);
        // lấy tất cả dữ liệu khi đã validate
        $data = $request->all();
        
        // nếu người dùng là user thì gán id hiện tại của người dùng cho user_id
        if ($request->user()){
            $data['user_id'] = $request->user()->id;
        }
    
        Review::create($data);
    
        if ($request->routeIs('admin.reviews.store')){
            return redirect()->route('client.index')->with('success', 'Cảm ơn  bạn đã đánh giá.');
        }
    
        return redirect()->back()->with('success', 'Cảm ơn bạn đã đánh giá!');
    }
    
    

    public function edit($id)
    {
        $review = Review::findOrFail($id);
        return view('admin.reviews.edit', compact('review'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            'review' => 'nullable|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $review = Review::findOrFail($id);
        $review->update($request->all());

        return redirect()->route('admin.reviews.index')->with('success', 'Đánh giá đã được cập nhật.');
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();
        return redirect()->route('admin.reviews.index')->with('success', 'Đánh giá đã được xóa mềm.');
    }

    public function trash()
    {
        $reviews = Review::with(['user', 'product'])->onlyTrashed()->paginate(10);
        return view('admin.reviews.trash', compact('reviews'));
    }
    public function restore($id)
    {
        $review = Review::withTrashed()->findOrFail($id);
        $review->restore();
        return redirect()->route('admin.reviews.trash')->with('success', 'Đánh giá đã được khôi phục.');
    }

    public function forceDelete($id)
    {
        $review = Review::withTrashed()->findOrFail($id);
        $review->forceDelete();
        return redirect()->route('admin.reviews.trash')->with('success', 'Đánh giá đã bị xóa vĩnh viễn.');
    }
}
