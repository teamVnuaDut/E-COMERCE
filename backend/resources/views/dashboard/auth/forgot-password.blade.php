<!DOCTYPE html>
<html lang="en">
<head>
    @include('dashboard.auth.component.head')
    @section('title', 'Forgot Password - E-Commerce Dashboard')
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="auth-card">
                    <div class="auth-header">
                        <h3><i class="fas fa-shopping-cart me-2"></i>Living Healthy Life</h3>
                        <p class="mb-0">Quên mật khẩu</p>
                    </div>
                    
                    <div class="auth-body">
                        @include('dashboard.auth.component.alerts')

                        <div class="text-center mb-4">
                            <i class="fas fa-key fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Nhập địa chỉ email và chúng tôi sẽ gửi cho bạn một liên kết để đặt lại mật khẩu.</p>
                        </div>

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            
                            @include('dashboard.auth.component.input-field', [
                                'name' => 'email',
                                'label' => 'Địa chỉ email',
                                'type' => 'email',
                                'placeholder' => 'Nhập địa chỉ email',
                                'icon' => 'fas fa-envelope',
                                'required' => true
                            ])

                            @include('dashboard.auth.component.submit-button', [
                                'text' => 'Gửi liên kết đặt lại mật khẩu',
                                'icon' => 'fas fa-paper-plane'
                            ])
                        </form>

                        <hr class="my-4">

                        @include('dashboard.auth.component.back-link', [
                            'href' => route('login'),
                            'text' => 'Quay lại đăng nhập'
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('dashboard.auth.component.scripts')
</body>
</html>
