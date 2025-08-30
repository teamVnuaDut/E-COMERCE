<header class="header">
    <h2 class="text-xl font-semibold">Admin Dashboard</h2>
    <div class="flex items-center space-x-4">
        <button class="md:hidden text-gray-500" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
        <div class="relative">
            <button class="flex items-center focus:outline-none" id="userMenuButton">
                <img src="https://ui-avatars.com/api/?name=Admin+User&background=0ea5e9&color=fff"
                    alt="Admin" class="w-8 h-8 rounded-full">
                <span class="ml-2 text-gray-700">Admin</span>
                <i class="fas fa-chevron-down ml-1 text-gray-500"></i>
            </button>

            <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 hidden z-50" id="userMenu">
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    <i class="fas fa-user-circle mr-2"></i>Profile
                </a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    <i class="fas fa-cog mr-2"></i>Settings
                </a>
                <div class="border-t border-gray-100"></div>
                <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                </a>
            </div>
        </div>
    </div>
</header>
