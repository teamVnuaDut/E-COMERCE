<!DOCTYPE html>
<html lang="en">
<head>
    @include('dashboard.auth.component.head')
    @section('title', 'Register - E-Commerce Dashboard')
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="auth-card">
                    <div class="auth-header">
                        <h3><i class="fas fa-shopping-cart me-2"></i>Living Healthy Life</h3>
                        <p class="mb-0">Tạo tài khoản để bắt đầu.</p>
                    </div>
                    
                    <div class="auth-body">
                        @include('dashboard.auth.component.alerts')

                        <form method="POST" action="{{ route('register.post') }}">
                            @csrf
                            
                            @include('dashboard.auth.component.input-field', [
                                'name' => 'name',
                                'label' => 'Họ và tên',
                                'type' => 'text',
                                'placeholder' => 'Nhập họ và tên',
                                'icon' => 'fas fa-user',
                                'required' => true
                            ])

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

                            @include('dashboard.auth.component.input-field', [
                                'name' => 'password_confirmation',
                                'label' => 'Xác nhận mật khẩu',
                                'type' => 'password',
                                'placeholder' => 'Xác nhận mật khẩu',
                                'icon' => 'fas fa-lock',
                                'required' => true
                            ])

                            @include('dashboard.auth.component.checkbox-field', [
                                'name' => 'terms',
                                'label' => 'I agree to the <a href=\'#\' class=\'text-decoration-none\'>Terms of Service</a> and <a href=\'#\' class=\'text-decoration-none\'>Privacy Policy</a>',
                                'required' => true
                            ])

                            @include('dashboard.auth.component.submit-button', [
                                'text' => 'Tạo tài khoản',
                                'icon' => 'fas fa-user-plus'
                            ])
                        </form>

                        <hr class="my-4">

                        @include('dashboard.auth.component.nav-links', ['type' => 'register'])
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('dashboard.auth.component.scripts')
</body>
</html>
