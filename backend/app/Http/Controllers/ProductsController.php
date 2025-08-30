<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\Categories;

class ProductsController extends Controller
{
    public function products(Request $request)
    {
        $products = Products::with('category')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        //lay danh muc cho filter
        $categories = Categories::all();

        return view('admin.pages.product.product', compact('products', 'categories'));
    }
}
