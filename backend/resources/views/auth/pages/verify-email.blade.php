<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác thực Email</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Xác thực Email</h1>
        </div>

        @if (session('status') == 'verification-link-sent')
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            Một liên kết xác thực mới đã được gửi đến email của bạn.
        </div>
        @endif

        <div class="mb-6">
            <p class="text-gray-600">
                Cảm ơn bạn đã đăng ký! Trước khi tiếp tục, vui lòng kiểm tra email để xác thực tài khoản.
            </p>
        </div>

        <div class="space-y-4">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                    Gửi lại email xác thực
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600">
                    Đăng xuất
                </button>
            </form>
        </div>
    </div>
</body>

</html>