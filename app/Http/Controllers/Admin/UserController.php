<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function index(){
        $listUser = User::with('customer')
            ->latest() // tương đương orderBy('created_at', 'desc')
            ->paginate(10);
    
        return view('admin.users.index', compact('listUser'));
    }

    public function create(){
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        // 1. Validate dữ liệu đầu vào
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,user',
            'phone' => 'required|string|max:20|regex:/^[0-9\-\+\s\(\)]+$/',
            'address' => 'required|string|max:255',
        ]);
    
        // 2. Tạo user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
        ]);
    
        // 3. Tạo customer gắn với user
        $user->customer()->create([
            'phone' => $validated['phone'],
            'address' => $validated['address'],
        ]);
    
        // 4. Quay lại danh sách
        return redirect()->route('admin.users.index')->with('success', 'Tạo người dùng thành công!');
    }
    

    
}
