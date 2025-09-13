<?php

namespace App\Livewire\Admin\Pages\Category;

use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $name = '';
    public $slug = '';
    public $description;
    public $image;
    public $parent_id;
    public $meta_title;
    public $meta_description;
    public $meta_keywords;
    public $status = 'active';
    public $sort_order = 0;

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:categories,slug',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'parent_id' => 'nullable|exists:categories,id',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer|min:0',
        ];
    }

    public function updatedName()
    {
        $this->slug = Str::slug($this->name);
    }

    public function createCategory()
    {
        $this->validate();
        // dd($this);

        $category = new Category();
        $category->name = $this->name;
        $category->slug = $this->slug;
        $category->description = $this->description;
        $category->parent_id = $this->parent_id;
        $category->meta_title = $this->meta_title;
        $category->meta_description = $this->meta_description;
        $category->meta_keywords = $this->meta_keywords;
        $category->status = $this->status;
        $category->sort_order = $this->sort_order;

        if ($this->image) {
            $path = $this->image->store('categories', 'public');
            $category->image = $path;
        }

        $category->save();

        return redirect()->route('admin.category.index')->with('success', '✅ Danh mục đã được tạo!');
    }

    public function render()
    {
        $parents = Category::whereNull('parent_id')->where('status', 'active')->get();
        return view('livewire.admin.pages.category.create', compact('parents'));
    }
}
