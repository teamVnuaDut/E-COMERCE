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
            <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                <h3 class="text-xl font-semibold text-indigo-600 mb-2">Overview</h3>
                <p class="text-gray-700">Here you can find a quick overview of the system's status.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 rounded-xl shadow-lg p-6 text-white flex flex-col items-center">
                    <h3 class="text-lg font-semibold mb-2">Total Users</h3>
                    <p class="text-3xl font-bold">100</p>
                </div>
                <div class="bg-gradient-to-r from-green-400 via-blue-500 to-purple-600 rounded-xl shadow-lg p-6 text-white flex flex-col items-center">
                    <h3 class="text-lg font-semibold mb-2">Active Subscriptions</h3>
                    <p class="text-3xl font-bold">75</p>
                </div>
                <div class="bg-gradient-to-r from-yellow-400 via-red-500 to-pink-500 rounded-xl shadow-lg p-6 text-white flex flex-col items-center">
                    <h3 class="text-lg font-semibold mb-2">Pending Orders</h3>
                    <p class="text-3xl font-bold">5</p>
                </div>
            </div>
        </div>
    </main>
    @include('admin.components.footer')
</body>

</html>
