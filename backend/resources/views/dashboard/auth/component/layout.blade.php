<!DOCTYPE html>
<html lang="en">
<head>
    @include('dashboard.auth.component.head')
    @yield('title')
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="auth-card">
                    <div class="auth-header">
                        <h3><i class="fas fa-shopping-cart me-2"></i>Living Healthy Life</h3>
                        <p class="mb-0">@yield('header-text', 'Welcome')</p>
                    </div>
                    
                    <div class="auth-body">
                        @include('dashboard.auth.component.alerts')
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('dashboard.auth.component.scripts')
</body>
</html> 