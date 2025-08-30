<!DOCTYPE html>
<html lang="en">
@include('admin.components.head')

<body>
    @include('admin.components.header')
    @include('admin.components.sidebar')
    <main class="min-h-screen bg-gray-50 py-10 px-4 lg:ml-72">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Admin Dashboard</h2>
            <p class="text-gray-600 mb-8">Welcome to the admin dashboard of Living Healthy Life.</p>
            <div class="bg-white rounded-xl shadow-md p-6 mb-8 flex flex-col items-center">
                <h3 class="text-xl font-semibold text-indigo-600 mb-2">Chart</h3>
                <div class="w-full h-64 flex items-center justify-center bg-gradient-to-r from-indigo-200 via-purple-200 to-pink-200 rounded-lg">
                    <span class="text-gray-700 text-lg">[Chart Placeholder]</span>
                </div>
            </div>
        </div>
    </main>
    @include('admin.components.footer')
</body>

</html>
