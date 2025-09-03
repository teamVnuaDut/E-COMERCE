<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function user()
    {
        return view('admin.pages.users.user');
    }
}
