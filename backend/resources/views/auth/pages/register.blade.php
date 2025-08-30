@extends('auth.layouts.auth-layout')

@section('title', 'Register - MyApp')
@section('page-title', 'Create Account')
@section('page-subtitle', 'Get started with our platform')

@section('auth-content')
<form action="{{ route('register') }}" method="POST" class="space-y-4">
    @csrf

    <!-- Name Input -->
    <div class="space-y-2">
        <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
        <input type="text" id="name" name="name"
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            placeholder="Enter your name" required value="{{ old('name') }}">
    </div>

    <!-- Email Input -->
    <div class="space-y-2">
        <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
        <input type="email" id="email" name="email"
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            placeholder="Enter your email" required value="{{ old('email') }}">
    </div>

    <!-- Password Input -->
    <div class="space-y-2">
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" id="password" name="password"
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            placeholder="Create a password" required>
    </div>

    <!-- Password Confirmation -->
    <div class="space-y-2">
        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation"
            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            placeholder="Confirm your password" required>
    </div>

    <!-- Terms Agreement -->
    <div class="flex items-center space-x-2">
        <input type="checkbox" id="terms" name="terms"
            class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" required>
        <label for="terms" class="text-sm text-gray-600">
            I agree to the <a href="#" class="text-blue-600 hover:text-blue-800">Terms of Service</a>
        </label>
    </div>

    <!-- Submit Button -->
    <button type="submit"
        class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
        Create Account
    </button>

    <!-- Validation error-->
    @if ($errors->any())
    <ul class="px-4 py-2 bg-red-100">
        @foreach ($errors->all() as $error)
        <li class="my-2 text-red-500">{{ $error}}</li>
        @endforeach
    </ul>
    @endif
</form>
@endsection

@section('auth-footer')
<p class="text-center text-sm text-gray-600 mt-4">
    Already have an account?
    <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500">
        Sign in
    </a>
</p>
@endsection
