<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //

    public function showLogin(){
        return view('auth.login');
    }

    public function showRegister(){
        return view('auth.register');
    }

    public function login(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
    
        // Thử đăng nhập
        if (Auth::attempt($credentials)) {
            $user = Auth::user(); // Lấy thông tin người dùng sau khi đăng nhập
    
            // Kiểm tra vai trò người dùng và chuyển hướng theo vai trò
            if ($user->role === 'admin') {
                return redirect()->route('admin.demo'); // Trang quản trị cho admin
            } elseif ($user->role === 'user') {
                return redirect()->route('client.index'); // Trang client cho người dùng
            }
    
            // Nếu không có vai trò nào, bạn có thể chuyển hướng về trang mặc định hoặc trang chủ
            return redirect()->route('client.index');
        }
    
        // Trả về lỗi nếu đăng nhập thất bại
        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không đúng.',
        ])->onlyInput('email');
    }
    
    public function register(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed', // 'confirmed' sẽ yêu cầu một ô xác nhận mật khẩu
        ]);
    
        // Tạo người dùng mới
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => User::ROLE_USER, // Gán quyền mặc định là user
        ]);
    
        // Đăng nhập người dùng ngay sau khi tạo thành công
        Auth::login($user);
    
        // Chuyển hướng người dùng đến trang client nếu quyền là user
        return redirect()->route('client.index'); // Trang này dành cho người dùng
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('auth.login');
    }
}
