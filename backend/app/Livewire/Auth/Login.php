<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email = '';
    public $password = '';

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            $user = Auth::user();

            // Kiểm tra status
            if ($user->status !== 'active') {
                Auth::logout();
                session()->flash('error', 'Tài khoản đã bị vô hiệu hóa');
                return;
            }

            // Redirect đến dashboard
            return redirect($this->getDashboardRoute($user->role));
        }

        session()->flash('error', 'Email hoặc mật khẩu không đúng');
    }

    private function getDashboardRoute($role)
    {
        return match ($role) {
            'admin' => '/admin/dashboard',
            'manager' => '/manager/dashboard',
            'staff' => '/staff/dashboard',
            'customer' => '/customer/dashboard',
        };
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
