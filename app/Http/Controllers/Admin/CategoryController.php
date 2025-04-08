<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::when($request->trang_thai !== null, function ($query) use ($request) {
                return $query->where('trang_thai', $request->trang_thai);
            })
            ->orderBy('id', 'DESC')
            ->paginate(10);
    
        // Trạng thái danh mục: 1 = Hoạt động, 0 = Không hoạt động
        $statusList = [
            1 => 'Hoạt động',
            0 => 'Không hoạt động'
        ];
    
        return view('admin.categories.list', compact('categories', 'statusList'));
    }
    

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $dataValidate = $request->validate([
            'ten_danh_muc' => 'required|max:50|unique:categories',
            'trang_thai' => 'required|in:0,1',
        ]);
        Category::create($dataValidate);
        return redirect()->route('admin.category.index');
    }
    public function edit($id)
    {

        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $dataValidate = $request->validate([
            'ten_danh_muc' => 'required|max:50|unique:categories,ten_danh_muc,' . $id,
            'trang_thai' => 'required|in:0,1',
        ]);
        $category->update($dataValidate);
        return redirect()->route('admin.category.index');
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return redirect()->route('admin.category.index')->with('error', 'Danh mục không tồn tại.');
        }

        $category->delete(); // Xóa mềm (chỉ cập nhật deleted_at)

        return redirect()->route('admin.category.index')->with('success', 'Xóa danh mục thành công.');
    }

    public function forcedelete($id)
    {
        $category = Category::onlyTrashed()->find($id);

        if (!$category) {
            return redirect()->back()->with('success', 'Danh mục không tồn tại hoặc chưa bị xóa mềm.');
        }

        // Xóa tất cả sản phẩm thuộc danh mục
        $category->products()->forceDelete();

        // Xóa vĩnh viễn danh mục
        $category->forceDelete();

        return redirect()->back()->with('success', 'Danh mục và tất cả sản phẩm đã được xóa vĩnh viễn.');
    }

    public function deletesoft()
    {
        $categories = Category::onlyTrashed()->paginate(10); //  Lấy cả danh mục đã xóa
        return view('admin.categories.deletesoft', compact('categories'));
    }

    public function restore($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        if ($category) {
            $category->restore(); // khôi phục danh mục
            return redirect()->route('admin.category.index')->with('success', 'Khôi phục danh mục thành công.');
        }
        return redirect()->route('admin.category.index')->with('error', 'Danh mục không tồn tại hoặc chưa bị xóa mềm.');
    }
}
