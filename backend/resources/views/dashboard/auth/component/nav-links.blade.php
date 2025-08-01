@props([
    'type' => 'login' // login, register, forgot
])

@if($type === 'login')
    <div class="text-center">
        <p class="mb-0">Chưa có tài khoản? 
            <a href="{{ route('register') }}" class="text-decoration-none fw-bold">
                Register here
            </a>
        </p>
    </div>
@elseif($type === 'register')
    <div class="text-center">
        <p class="mb-0">Đã có tài khoản? 
            <a href="{{ route('login') }}" class="text-decoration-none fw-bold">
                Login here
            </a>
        </p>
    </div>
@endif 