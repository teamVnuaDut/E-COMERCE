<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{

    public function index()
    {
        $categories = Categories::with('parent')->get();
        return view('admin.pages.categories.index', compact('categories'));
    }

    public function edit(Categories $categories)
    {
        $parentCategories = Categories::whereNull('parent_id')
            ->where('id', '!=', $categories->id)
            ->get();

        return view('admin.pages.categories.edit', compact('categories', 'parentCategories'));
    }

    public function create()
    {
        $parentCategories = Categories::whereNull('parent_id')->get();
        return view('admin.pages.categories.create', compact('parentCategories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
        }

        Categories::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'parent_id' => $validated['parent_id'],
            'description' => $validated['description'],
            'status' => $validated['status'],
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function show($slug)
    {
        $category = Categories::where('slug', $slug)->with('products')->firstOrFail();
        return view('categories.show', compact('categories'));
    }

    public function destroy(Categories $categories)
    {
        // Kiểm tra nếu danh mục có sản phẩm
        if ($categories->products()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Không thể xóa danh mục vì có sản phẩm đang sử dụng.');
        }

        // Xóa ảnh
        if ($categories->image) {
            Storage::disk('public')->delete($categories->image);
        }

        $categories->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Danh mục đã được xóa thành công.');
    }

    public function update(Request $request, Categories $categories)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = $categories->image;
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ
            if ($categories->image) {
                Storage::disk('public')->delete($categories->image);
            }
            $imagePath = $request->file('image')->store('categories', 'public');
        }

        $categories->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'parent_id' => $validated['parent_id'],
            'description' => $validated['description'],
            'status' => $validated['status'],
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }
}
