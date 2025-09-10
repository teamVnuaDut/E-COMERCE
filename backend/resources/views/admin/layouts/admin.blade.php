<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.components.head')
    <title>Admin Dashboard - Living Healthy Life</title>
    @livewireStyles
</head>

<body class="bg-gray-100">
    @auth
    @include('admin.components.header')
    @include('admin.components.sidebar')

    <main class="ml-64 p-8 pt-24">
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