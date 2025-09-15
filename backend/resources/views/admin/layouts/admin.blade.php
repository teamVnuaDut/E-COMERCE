<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.components.head')
    <title>Admin Dashboard - Living Healthy Life</title>
    @livewireStyles
</head>

<body class="{{ auth()->user()->theme === 'dark' ? 'bg-gray-900 text-white' : 'bg-[#ede0d4] text-[#1a1a1a]' }}">
    @auth
    @include('admin.components.header')
    @include('admin.components.sidebar')

    <main class="ml-64 p-8 pt-24 p-5 pb-20
    {{ auth()->user()->theme === 'dark' ? 'bg-gray-900 text-black' : 'bg-[#ede0d4] text-[#1a1a1a]' }}">
        @yield('content')
    </main>

    @include('admin.components.footer')
    @include('admin.components.scripts')
    @livewireScripts
    @else
    {{-- Nếu chưa đăng nhập thì redirect về login --}}
    <script>
        window.location.href = "{{ route('login') }}";
    </script>
    @endauth
</body>

</html>
