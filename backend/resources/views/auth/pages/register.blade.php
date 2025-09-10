@extends('auth.layouts.auth-layout')

@section('title', 'Đăng ký - MyApp')
@section('page-title', 'Tạo tài khoản')
@section('page-subtitle', 'Bắt đầu với nền tảng của chúng tôi')

@section('auth-content')
<div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
    <!-- Hiển thị lỗi -->
    @if ($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-0 rounded mb-4">
        <ul class="list-disc list-inside space-y-1">
            @foreach ($errors->all() as $error)
            <li class="text-sm">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Hiển thị thông báo thành công -->
    @if (session('status'))
    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded mb-4">
        <p class="text-sm">{{ session('status') }}</p>
    </div>
    @endif

    <form action="{{ route('register') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Họ tên -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Họ tên *</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="Nguyễn Văn A" required>
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="email@example.com" required>
        </div>

        <!-- Số điện thoại -->
        <div>
            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Số điện thoại *</label>
            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="0912345678" required>
        </div>

        <!-- Mật khẩu -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mật khẩu *</label>
            <input type="password" id="password" name="password"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="Ít nhất 8 ký tự" required>
        </div>

        <!-- Xác nhận mật khẩu -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Xác nhận mật khẩu *</label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="Nhập lại mật khẩu" required>
        </div>

        <!-- Điều khoản -->
        <div class="flex items-start space-x-2">
            <input type="checkbox" id="terms" name="terms"
                class="mt-1 rounded border-gray-300 text-blue-600 focus:ring-blue-500" required>
            <label for="terms" class="text-sm text-gray-600">
                Tôi đồng ý với <a href="#" class="text-blue-600 hover:text-blue-800 underline">điều khoản dịch vụ</a>
                và <a href="#" class="text-blue-600 hover:text-blue-800 underline">chính sách bảo mật</a>
            </label>
        </div>

        <!-- Nút đăng ký -->
        <button type="submit"
            class="w-full bg-blue-600 text-white py-2.5 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors font-medium">
            Đăng ký
        </button>
    </form>

    <!-- Đăng nhập -->
    <div class="mt-6 text-center pt-4 border-t border-gray-200">
        <p class="text-sm text-gray-600">Đã có tài khoản?
            <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-medium underline">
                Đăng nhập ngay
            </a>
        </p>
    </div>
</div>
@endsection
