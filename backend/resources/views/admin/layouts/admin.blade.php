<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.components.head')
    <title>Admin Dashboard - Living Healthy Life</title>
    @livewireStyles
</head>

<body class="bg-[#ede0d4] text-[#1a1a1a]">
    @auth
    @include('admin.components.header')
    @include('admin.components.sidebar')

    <main class="ml-64 p-8 pt-24 bg-[#ede0d4] text-[#1a1a1a] p-5">
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
