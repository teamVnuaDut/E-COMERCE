<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Nếu chưa login thì redirect luôn
        if (!Auth::check()) {
            return redirect('login')->withErrors('Bạn cần đăng nhập');
        }

        // Nếu login rồi nhưng role không thuộc danh sách được phép
        if (!in_array(Auth::user()->role, $roles)) {
            return redirect('login')->withErrors('Bạn không có quyền truy cập');
        }

        // Cho phép đi tiếp
        return $next($request);
    }
}
