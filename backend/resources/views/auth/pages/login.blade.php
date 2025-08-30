@extends('auth.layouts.auth-layout')

@section('title', 'Login - MyApp')
@section('page-title', 'Welcome Back')
@section('page-subtitle', 'Please sign in to your account')

@section('auth-content')
@guest
<form action="{{ route('login') }}" method="POST" class="space-y-4">
    @csrf

    <!-- Email Input -->
    <div class="space-y-2">
        <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
        <input type="email" id="email" name="email"
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            placeholder="Enter your email" required value="{{ old('email') }}">

        @error('email')
        <span class="text-sm text-red-600">{{ $message }}</span>
        @enderror
    </div>

    <!-- Password Input -->
    <div class="space-y-2">
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" id="password" name="password"
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            placeholder="Enter your password" required>
        @error('password')
        <span class="text-sm text-red-600">{{ $message }}</span>
        @enderror
    </div>

    <!-- Remember Me & Forgot Password -->
    <div class="flex items-center justify-between">
        <label class="flex items-center space-x-2">
            <input type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
            <span class="text-sm text-gray-600">Remember me</span>
        </label>
        <a href="{{ route('show.forgot.password') }}" class="text-sm text-blue-600 hover:text-blue-800">Forgot password?</a>
    </div>

    <!-- Social Login Buttons -->
    <div class="space-y-4">
        <div class="relative flex items-center">
            <div class="flex-grow border-t border-gray-300"></div>
            <span class="mx-4 flex-shrink text-sm text-gray-500">Or continue with</span>
            <div class="flex-grow border-t border-gray-300"></div>
        </div>

        <div class="grid grid-cols-2 gap-3">
            <button type="button" class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                <img src="{{ asset('icons/google.svg') }}" alt="Google" class="w-5 h-5 mr-2">
                Google
            </button>
            <button type="button" class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                <img src="{{ asset('icons/facebook.svg') }}" alt="Facebook" class="w-5 h-5 mr-2">
                Facebook
            </button>
        </div>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
        Sign In
    </button>

    <!-- Display General Error Message -->
    <!-- Validation error-->
    @if ($errors->any())
    <ul class="px-4 py-2 bg-red-100">
        @foreach ($errors->all() as $error)
        <li class="my-2 text-red-500">{{ $error}}</li>
        @endforeach
    </ul>
    @endif
</form>
@endguest
@endsection

@section('auth-footer')
<p class="text-center text-sm text-gray-600">
    Don't have an account?
    <a href="{{ route('show.register') }}" class="font-medium text-blue-600 hover:text-blue-500">Sign up</a>
</p>
@endsection
