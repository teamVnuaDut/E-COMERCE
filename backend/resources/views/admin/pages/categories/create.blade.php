<!DOCTYPE html>
<html lang="en">
@include('admin.components.head')

<head>
    <title>Admin Dashboard - Living Healthy Life</title>
</head>

<body class="bg-gray-100">
    @auth
    @include('admin.components.header')
    @include('admin.components.sidebar')

    <main class="ml-64 p-8 pt-24">

        <livewire:pages.categories.create />
    </main>

    @include('admin.components.footer')
    @include('admin.components.scripts')
    @endauth
</body>

</html>