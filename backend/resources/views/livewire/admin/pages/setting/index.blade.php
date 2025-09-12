<div class="max-w-3xl mx-auto p-6 rounded-xl shadow-xl transition-all duration-300
    {{ auth()->user()->theme === 'dark' ? 'bg-gray-800 text-white' : 'bg-white text-gray-800' }}">

    <h2 class="text-2xl font-bold flex items-center gap-2 mb-6">
        <i class="fas fa-cog text-indigo-500"></i>
        <span>Cài đặt người dùng</span>
    </h2>

    @if (session('success'))
    <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-md mb-4">
        {{ session('success') }}
    </div>
    @endif

    <form wire:submit="save" class="space-y-6">
        <!-- Giao diện -->
        <div>
            <label class="block text-sm font-semibold mb-1">🎨 Giao diện</label>
            <select wire:model.defer="theme"
                class="w-full rounded-lg border border-gray-300 px-4 py-2 text-black focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="light">🌞 Sáng</option>
                <option value="dark">🌙 Tối</option>
            </select>
        </div>

        <!-- Ngôn ngữ -->
        <div>
            <label class="block text-sm font-semibold mb-1">🌐 Ngôn ngữ</label>
            <select wire:model.defer="language"
                class="w-full rounded-lg border border-gray-300 px-4 py-2 text-black focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="vi">🇻🇳 Tiếng Việt</option>
                <option value="en">🇺🇸 English</option>
                <option value="jp">🇯🇵 日本語</option>
            </select>
        </div>

        <!-- Thông báo -->
        <div>
            <label class="flex items-center gap-3">
                <input type="checkbox" wire:model.defer="notifications"
                    class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                <span class="text-sm font-medium">📩 Nhận thông báo qua email</span>
            </label>
        </div>

        <!-- Nút lưu -->
        <div class="flex justify-end">
            <button type="submit"
                class="inline-flex items-center gap-2 px-5 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">
                💾 <span>Lưu cài đặt</span>
            </button>
        </div>
    </form>
</div>
