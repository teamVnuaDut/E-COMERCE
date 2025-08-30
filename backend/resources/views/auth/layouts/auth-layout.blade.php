<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Authentication')</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4F46E5',
                        secondary: '#6B7280',
                        background: '#F9FAFB',
                        'input-border': '#D1D5DB',
                        'input-focus': '#3B82F6',
                        'error-color': '#EF4444',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                },
            },
        }
    </script>
    <style>
        .auth-body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
        }

        .auth-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            padding: 2rem;
        }
    </style>
</head>

<body class="auth-body">
    <div class="auth-container">
        <!-- Header -->
        <div class="auth-header text-center mb-6">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="auth-logo h-15 mx-auto mb-4">
            <h1 class="auth-title text-2xl font-bold text-gray-800 mb-2">@yield('page-title', 'Welcome Back')</h1>
            <p class="auth-subtitle text-gray-600 text-sm">@yield('page-subtitle', 'Please enter your details to continue')</p>
        </div>

        <!-- Content Slot -->
        <div class="auth-content mb-6">
            @yield('auth-content')
        </div>

        <!-- Footer Links -->
        <div class="auth-footer text-center pt-4 border-t border-gray-200">
            @yield('auth-footer')
        </div>
    </div>
</body>

</html>
