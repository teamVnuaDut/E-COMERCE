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


        $totalProducts = Products::count();

        //lay danh muc cho filter
        $categories = Categories::all();

        return view('admin.pages.product.product', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Categories::all();
        return view('admin.pages.product.create', compact('categories'));
    }

    public function edit(Request $request)
    {
        $product = Products::find($request->id);
        $categories = Categories::all();
        return view('admin.pages.product.edit', compact('product', 'categories'));
    }

    public function destroy(Request $request)
    {
        $product = Products::find($request->id);
        $product->delete();
        return redirect()->route('admin.products')->with('success', 'Product deleted successfully.');
    }
}
