<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{

    public function categories(Request $request)
    {
        $categories = Categories::orderBy('created_at', 'desc')->paginate(10);

        $categories = Categories::with('parent')->get();
        return view('admin.pages.categories.categories', compact('categories'));
    }

    public function edit($id)
    {
        $category = Categories::findOrFail($id);
        return view('admin.pages.categories.edit', compact('category'));
    }

    public function create()
    {
        $categories = Categories::all();
        return view('admin.pages.categories.create', compact('categories'));
    }

    public function destroy($id)
    {
        $category = Categories::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.categories')->with('success', 'Category deleted successfully.');
    }
}
