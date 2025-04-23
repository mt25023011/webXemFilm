<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để truy cập trang này.');
        }

        // Kiểm tra xem người dùng có phải là admin không
        // Bạn có thể thay đổi điều kiện này tùy theo cấu trúc quyền của ứng dụng
        $user = Auth::user();
        if (!$user->is_admin) {
            return redirect()->back()->with('error', 'Bạn không có quyền truy cập vào trang này.');
        }

        // Nếu người dùng có quyền, cho phép tiếp tục
        return $next($request);
    }
} 