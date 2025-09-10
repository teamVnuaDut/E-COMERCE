@extends('auth.layouts.auth-layout')

@section('title', 'Login - MyApp')
@section('page-title', 'Welcome Back')
@section('page-subtitle', 'Please sign in to your account')

@section('auth-content')
<div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Đăng nhập</h2>

    @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
        @endforeach
    </div>
    @endif

    @if (session('status'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('status') }}
    </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}"
                class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                required autofocus>
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Mật khẩu</label>
            <input type="password" name="password" id="password"
                class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                required>
        </div>

        <div class="mb-4 flex items-center">
            <input type="checkbox" name="remember" id="remember"
                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
            <label for="remember" class="ml-2 block text-sm text-gray-900">Ghi nhớ đăng nhập</label>
        </div>

        <div class="mb-4">
            <button type="submit"
                class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Đăng nhập
            </button>
        </div>
    </form>

    <div class="mt-6 text-center">
        <p class="text-sm text-gray-600">Chưa có tài khoản?
            <a href="{{ route('register') }}" class="text-blue-500 hover:text-blue-700">
                Đăng ký ngay
            </a>
        </p>
    </div>
</div>
@endsection