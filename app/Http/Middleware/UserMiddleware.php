<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra nếu không đăng nhập hoặc không phải là user thì không có quyền truy cập
        if (!Auth::check() || !Auth::user()->isRoleUser()){
            return redirect()->route('client.index')
                    ->withErrors( "Bạn không đủ quyền truy cập vào trang.");
        }
        return $next($request);
    }
}
