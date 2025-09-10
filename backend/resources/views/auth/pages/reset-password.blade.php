@extends('auth.layouts.auth-layout')

@section('title', 'Đặt lại mật khẩu - MyApp')
@section('page-title', 'Đặt lại mật khẩu')
@section('page-subtitle', 'Tạo mật khẩu mới cho tài khoản của bạn')

@section('auth-content')
<div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Đặt lại mật khẩu</h2>
        <p class="text-gray-600 mt-2">Tạo mật khẩu mới cho tài khoản</p>
    </div>

    @if ($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded mb-4">
        <ul class="list-disc list-inside space-y-1">
            @foreach ($errors->all() as $error)
            <li class="text-sm">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if (session('status'))
    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded mb-4">
        <p class="text-sm">{{ session('status') }}</p>
    </div>
    @endif

    <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
            <input type="email" id="email" name="email" value="{{ $email ?? old('email') }}"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                placeholder="email@example.com" required>
        </div>

        <!-- Mật khẩu mới -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Mật khẩu mới *</label>
            <input type="password" id="password" name="password"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                placeholder="Ít nhất 8 ký tự" required>
        </div>

        <!-- Xác nhận mật khẩu -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Xác nhận mật khẩu *</label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                placeholder="Nhập lại mật khẩu" required>
        </div>

        <!-- Nút đặt lại mật khẩu -->
        <button type="submit"
            class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors font-medium">
            Đặt lại mật khẩu
        </button>
    </form>

    <!-- Quay lại đăng nhập -->
    <div class="mt-6 text-center pt-4 border-t border-gray-200">
        <p class="text-sm text-gray-600">
            <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-medium underline">
                Quay lại đăng nhập
            </a>
        </p>
    </div>
</div>
@endsection
