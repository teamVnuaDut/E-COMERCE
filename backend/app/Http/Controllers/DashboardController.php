<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController
{
    public function dashboard()
    {
        if (Auth::check()) {
            $user = Auth::user();

            switch ($user->role) {
                case 'admin':
                    return view('admin.index');
                case 'manager':
                    return view('manager.index');
                case 'staff':
                    return view('staff.index');
                case 'customer':
                    return view('home');
                default:
                    return redirect("login")->withErrors('Opps! You do not have access');
            }
        }

        return redirect("login")->withErrors('Please login first');
    }
}
