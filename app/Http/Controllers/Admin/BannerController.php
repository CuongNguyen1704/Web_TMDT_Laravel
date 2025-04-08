<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index(Request $request)
    {
        $query = Banner::query();
    
        // Kiểm tra xem có request trạng thái không
        if ($request->filled('trang_thai')) {
            $query->where('status', $request->trang_thai);
        }
    
        $banners = $query->orderBy('id', 'desc')->paginate(10);
        return view('admin.banner.index', compact('banners'));
    }
    

    public function create(){
        return view('admin.banner.create');
        
    }

    public function store(Request $request){
        $validateDate = $request->validate([
            'title'=>'required|max:255',
            'description'=>'required|max:255',
            'status'=>'required|in:0,1'
        ]);
           // Xử lý hình ảnh
           if($request->hasFile('image')){
            // Lưu đường dẫn ảnh vào trong thư mục 
            $imagePath = $request->file('image')->store('image/banners','public');
            $validateDate['image'] = $imagePath;         
        }
        Banner::create($validateDate);
        return redirect()->route('admin.banner.index');
    }

    public function edit($id){
        $banner = Banner::findOrFail($id);
        return view('admin.banner.edit',compact('banner'));
    }

    public function update(Request $request,$id){
        $banner = Banner::findOrFail($id);
        $validateDate = $request->validate([
            'title'=>'required|max:255',
            'description'=>'required|max:255',
            'status'=>'required|in:0,1'
        ]);
            // Xử lý hình ảnh
        if($request->hasFile('image')){
            // Lưu đường dẫn ảnh vào trong thư mục 
            $imagePath = $request->file('image')->store('image/banner','public');
            $validateDate['image'] = $imagePath;   
            // Xóa ảnh cũ nếu có
            if($banner->image){
                Storage::disk('public')->delete($banner->image);
            }
        }
        $banner->update($validateDate);
        return redirect()->route('admin.banner.index');
    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->delete(); // Xóa mềm

        return redirect()->route('admin.banner.index')->with('success', 'Banner đã được xóa mềm!');
    }

    // Hiển thị danh sách Banner đã xóa mềm
    public function trash()
    {
        $banners = Banner::onlyTrashed()->paginate(10);
        return view('admin.banner.trash', compact('banners'));
    }

    // Khôi phục Banner đã xóa mềm
    public function restore($id)
    {
        $banner = Banner::onlyTrashed()->where('id', $id)->firstOrFail();
        $banner->restore();

        return redirect()->route('admin.banner.trash')->with('success', 'Banner đã được khôi phục!');
    }

    // Xóa vĩnh viễn Banner
    public function forceDelete($id)
    {
        $banner = Banner::onlyTrashed()->where('id', $id)->firstOrFail();
        $banner->forceDelete();

        return redirect()->route('admin.banner.trash')->with('success', 'Banner đã bị xóa vĩnh viễn!');
    }

}
