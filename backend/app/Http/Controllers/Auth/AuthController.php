<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AuthController
{
    //
    public function index(): View
    {
        return view('auth.pages.login');
    }

    public function registration(): View
    {
        return view('auth.pages.registration');
    }

    public function postLogin(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')->withSuccess('You have successfully loggedin');
        }

        return redirect("login")->withErrors('Opps, You have invalid credentials');
    }

    public function postRegistration(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $user = $this->create($data);

        Auth::login($user);

        return redirect("dashboard")->withSuccess('Great! You have Successfully loggedin');
    }

    public function dashboard()
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->role === 'admin') {
                return view('admin.index');
            } else if ($user->role === 'manager') {
                return view('manager.index');
            } else if ($user->role === 'staff') {
                return view('staff.index');
            } else if ($user->role === 'customer') {
                return view('home');
            }

            return redirect("login")->withErrors('Opps! You do not have access as admin');
        }

        return redirect("login")->withErrors('Please login first');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout(): RedirectResponse
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
