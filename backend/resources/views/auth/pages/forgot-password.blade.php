@extends('auth.layouts.auth-layout')

@section('title', 'Quên mật khẩu - MyApp')
@section('page-title', 'Quên mật khẩu')
@section('page-subtitle', 'Vui lòng nhập email để đặt lại mật khẩu')

@section('auth-content')
<div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
    <!-- Hiển thị thông báo -->
    @if (session('status'))
    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded mb-4">
        <p class="text-sm">{{ session('status') }}</p>
    </div>
    @endif

    @if ($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded mb-4">
        <ul class="list-disc list-inside space-y-1">
            @foreach ($errors->all() as $error)
            <li class="text-sm">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('password.email') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
                placeholder="email@example.com" required>
        </div>

        <!-- Nút gửi -->
        <button type="submit"
            class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors font-medium">
            Gửi liên kết đặt lại
        </button>
    </form>

    <!-- Quay lại đăng nhập -->
    <div class="mt-6 text-center pt-4 border-t border-gray-200">
        <p class="text-sm text-gray-600">Nhớ mật khẩu?
            <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-medium underline">
                Đăng nhập ngay
            </a>
        </p>
    </div>
</div>
@endsection
