<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }
    
    public function create()
    {
        return view('admin.posts.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $data = $request->only('title', 'content');
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts', 'public');
        }
    
        Post::create($data);
        return redirect()->route('admin.posts.index')->with('success', 'Bài viết đã được tạo.');
    }
    
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.edit', compact('post'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $post = Post::findOrFail($id);
        $data = $request->only('title', 'content');
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($post->image) {
                Storage::delete('public/' . $post->image);
            }
            $data['image'] = $request->file('image')->store('posts', 'public');
        }
    
        $post->update($data);
        return redirect()->route('admin.posts.index')->with('success', 'Bài viết đã được cập nhật.');
    }
    
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Bài viết đã được xóa mềm.');
    }
    
    public function trash()
    {
        $posts = Post::onlyTrashed()->paginate(10);
        return view('admin.posts.trash', compact('posts'));
    }
    
    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore();
        return redirect()->route('admin.posts.trash')->with('success', 'Bài viết đã được khôi phục.');
    }
    
    public function forceDelete($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        if ($post->image) {
            Storage::delete('public/' . $post->image);
        }
        $post->forceDelete();
        return redirect()->route('admin.posts.trash')->with('success', 'Bài viết đã bị xóa vĩnh viễn.');
    }
}
