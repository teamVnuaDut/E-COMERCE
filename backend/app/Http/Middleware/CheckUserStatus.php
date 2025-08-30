<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if (Auth::check()) {
        //     // Kiểm tra trạng thái tài khoản
        //     if (Auth::user()->status === 'inactive') {
        //         Auth::logout();
        //         return redirect()->route('show.login')
        //             ->with('error', 'Tài khoản của bạn đã bị vô hiệu hóa. Vui lòng liên hệ quản trị viên.');
        //     }

        //     // Kiểm tra email đã xác thực chưa
        //     if (Auth::user()->email_verified_at === null) {
        //         return redirect()->route('verification.notice')
        //             ->with('warning', 'Vui lòng xác thực email của bạn trước khi tiếp tục.');
        //     }
        // }
        return $next($request);
    }
}
