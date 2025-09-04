<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\Categories;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Products::with(['category', 'brand'])->paginate(20);
        return view('admin.pages.product.index', compact('products'));
    }

    public function create()
    {
        $categories = Categories::where('status', 'active')->get();
        $brands = Brand::where('status', 'active')->get();
        return view('admin.pages.product.create', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $product = Products::create($validated);
        return redirect()->route('admin.products')->with('success', 'Product created successfully.');
    }

    public function edit(Request $request)
    {
        $categories = Categories::where('status', 'active')->get();
        $brands = Brand::where('status', 'active')->get();
        return view('admin.pages.product.edit', compact('product', 'categories', 'brands'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $product = Products::find($request->id);
        $product->update($validated);
        return redirect()->route('admin.products')->with('success', 'Product updated successfully.');
    }

    public function destroy(Request $request)
    {
        $product = Products::find($request->id);
        $product->delete();
        return redirect()->route('admin.products')->with('success', 'Product deleted successfully.');
    }

    public function updateStock(Request $request, Products $product)
    {
        $validated = $request->validate([
            'stock_quantity' => 'required|integer|min:0',
            'reason' => 'required|string',
        ]);

        $product->update([
            'stock_quantity' => $request->stock_quantity,
        ]);

        //log inventory change
        // InventoryLog::create([
        //     'product_id' => $product->id,
        //     'warehouse_id' => 1, // main warehouse
        //     'type' => 'adjustment',
        //     'quantity' => $request->stock_quantity,
        //     'reason' => $request->reason,
        //     'user_id' => id()
        // ]);

        return back()->with('success', 'Stock updated successfully.');
    }
}
