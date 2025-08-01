<!DOCTYPE html>
<html lang="en">
<head>
    @include('dashboard.auth.component.head')
    @section('title', 'Login - E-Commerce Dashboard')
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="auth-card">
                    <div class="auth-header">
                        <h3><i class="fas fa-shopping-cart me-2"></i>Living Healthy Life</h3>
                        <p class="mb-0">Chào mừng quay trở lại!.</p>
                    </div>
                    
                    <div class="auth-body">
                        @include('dashboard.auth.component.alerts')

                        <form method="POST" action="{{ route('login.post') }}">
                            @csrf
                            
                            @include('dashboard.auth.component.input-field', [
                                'name' => 'email',
                                'label' => 'Địa chỉ email',
                                'type' => 'email',
                                'placeholder' => 'Nhập địa chỉ email',
                                'icon' => 'fas fa-envelope',
                                'required' => true
                            ])

                            @include('dashboard.auth.component.input-field', [
                                'name' => 'password',
                                'label' => 'Mật khẩu',
                                'type' => 'password',
                                'placeholder' => 'Nhập mật khẩu',
                                'icon' => 'fas fa-lock',
                                'required' => true
                            ])

                            @include('dashboard.auth.component.remember-me')

                            @include('dashboard.auth.component.submit-button', [
                                'text' => 'Đăng nhập',
                                'icon' => 'fas fa-sign-in-alt'
                            ])

                            <div class="text-center">
                                <a href="{{ route('password.request') }}" class="text-decoration-none">
                                    <i class="fas fa-key me-1"></i>Quên mật khẩu?
                                </a>
                            </div>
                        </form>

                        <hr class="my-4">

                        @include('dashboard.auth.component.nav-links', ['type' => 'login'])
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('dashboard.auth.component.scripts')
</body>
</html>
