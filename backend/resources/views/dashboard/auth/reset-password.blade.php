<!DOCTYPE html>
<html lang="en">
<head>
    @include('dashboard.auth.component.head')
    @section('title', 'Reset Password - E-Commerce Dashboard')
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="auth-card">
                    <div class="auth-header">
                        <h3><i class="fas fa-shopping-cart me-2"></i>Living Healthy Life</h3>
                        <p class="mb-0">Đặt lại mật khẩu</p>
                    </div>
                    
                    <div class="auth-body">
                        @include('dashboard.auth.component.alerts')

                        <div class="text-center mb-4">
                            <i class="fas fa-lock fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Nhập mật khẩu mới dưới đây.</p>
                        </div>

                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            
                            <!-- Password Reset Token -->
                            <input type="hidden" name="token" value="{{ $token }}">

                            @include('dashboard.auth.component.input-field', [
                                'name' => 'email',
                                'label' => 'Email Address',
                                'type' => 'email',
                                'placeholder' => 'Nhập địa chỉ email',
                                'icon' => 'fas fa-envelope',
                                'required' => true,
                                'value' => $email ?? old('email')
                            ])

                            @include('dashboard.auth.component.input-field', [
                                'name' => 'password',
                                'label' => 'Mật khẩu mới',
                                'type' => 'password',
                                'placeholder' => 'Nhập mật khẩu mới',
                                'icon' => 'fas fa-lock',
                                'required' => true
                            ])

                            @include('dashboard.auth.component.input-field', [
                                'name' => 'password_confirmation',
                                'label' => 'Xác nhận mật khẩu mới',
                                'type' => 'password',
                                'placeholder' => 'Xác nhận mật khẩu mới',
                                'icon' => 'fas fa-lock',
                                'required' => true
                            ])

                            @include('dashboard.auth.component.submit-button', [
                                'text' => 'Đặt lại mật khẩu',
                                'icon' => 'fas fa-save'
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
