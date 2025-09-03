<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 transition-colors duration-300">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Cài Đặt Hệ Thống</h2>

    @if (session()->has('message'))
    <div class="bg-green-100 dark:bg-green-800 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-100 px-4 py-3 rounded mb-6">
        {{ session('message') }}
    </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Chế độ màu -->
        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-3">Giao Diện</h3>

            <div class="flex items-center justify-between mb-4">
                <span class="text-gray-700 dark:text-gray-300">Chế độ màu</span>
                <button wire:click="toggleTheme" class="relative inline-flex items-center h-6 rounded-full w-11 bg-gray-300 dark:bg-blue-600 transition-colors duration-300">
                    <span class="sr-only">Toggle theme</span>
                    <span class="inline-block w-4 h-4 transform bg-white rounded-full transition-transform duration-300 translate-x-1 dark:translate-x-6"></span>
                </button>
            </div>

            <div class="text-sm text-gray-600 dark:text-gray-400">
                Hiện tại: <span class="font-medium">{{ $theme === 'light' ? 'Sáng' : 'Tối' }}</span>
            </div>
        </div>

        <!-- Thông báo -->
        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-3">Thông Báo</h3>

            <div class="flex items-center justify-between mb-4">
                <span class="text-gray-700 dark:text-gray-300">Nhận thông báo</span>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" wire:model="notifications" class="sr-only peer">
                    <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none rounded-full peer dark:bg-gray-600 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                </label>
            </div>
        </div>

        <!-- Ngôn ngữ -->
        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-3">Ngôn Ngữ</h3>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Chọn ngôn ngữ</label>
                <select wire:model="language" class="w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm p-2 bg-white dark:bg-gray-600 text-gray-900 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                    <option value="vi">Tiếng Việt</option>
                    <option value="en">English</option>
                </select>
                @error('language') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Hiển thị -->
        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-3">Hiển Thị</h3>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Số lượng mỗi trang</label>
                <select wire:model="pageSize" class="w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm p-2 bg-white dark:bg-gray-600 text-gray-900 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                    <option value="10">10 items</option>
                    <option value="25">25 items</option>
                    <option value="50">50 items</option>
                    <option value="100">100 items</option>
                </select>
                @error('pageSize') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    <!-- Nút hành động -->
    <div class="flex justify-between items-center mt-8 pt-6 border-t border-gray-200 dark:border-gray-600">
        <button wire:click="resetToDefault" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded transition-colors">
            Đặt lại mặc định
        </button>

        <div class="space-x-3">
            <button wire:click="cancel" class="bg-gray-300 dark:bg-gray-600 hover:bg-gray-400 dark:hover:bg-gray-500 text-gray-800 dark:text-white px-4 py-2 rounded transition-colors">
                Hủy
            </button>
            <button wire:click="saveSettings" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition-colors">
                Lưu Cài Đặt
            </button>
        </div>
    </div>
</div>