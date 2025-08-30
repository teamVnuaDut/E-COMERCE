<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function overview()
    {
        return view('admin.pages.overview');
    }

    public function chart()
    {
        return view('admin.pages.chart');
    }

    public function product()
    {
        return view('admin.pages.product.product');
    }

    public function categories()
    {
        return view('admin.pages.categories.categories');
    }

    public function settings()
    {
        return view('admin.pages.settings.settings');
    }
}
