@extends('auth.layouts.auth-layout')

@section('title', 'Login - MyApp')
@section('page-title', 'Welcome Back')
@section('page-subtitle', 'Please sign in to your account')

@section('auth-content')
@auth
<form action="{{ route('show.login') }}" method="POST" class="space-y-6">
    @csrf

    <!-- Email Input -->
    <div class="space-y-2">
        <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
        <input type="email" id="email" name="email"
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors"
            placeholder="Enter your email" required>
        @error('email')
        <span class="text-sm text-red-600">{{ $message }}</span>
        @enderror
    </div>

    <!-- Submit Button -->
    <button type="submit" class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors font-medium">
        Send email
    </button>
</form>
@endauth
@endsection

@section('auth-footer')
<p class="text-center text-sm text-gray-600 mt-6">
    Don't have an account?
    <a href="{{ route('show.register') }}" class="font-medium text-blue-600 hover:text-blue-500 transition-colors">
        Sign up
    </a>
</p>
@endsection
