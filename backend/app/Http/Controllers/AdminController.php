<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
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

    public function products(Request $request)
    {
        $products = Products::with('category')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        //lay danh muc cho filter
        $categories = Categories::all();

        return view('admin.pages.product.product', compact('products', 'categories'));
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
