<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function settings()
    {
        return view('admin.pages.settings.index');
    }
}
