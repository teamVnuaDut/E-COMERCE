<?php

namespace App\Livewire\Admin\Pages\Category;

use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public Category $category;

    public $name, $slug, $description, $image, $parent_id;
    public $meta_title, $meta_description, $meta_keywords;
    public $status = 'active', $sort_order = 0;

    public function mount(Category $category)
    {
        if (! $category->exists) {
            session()->flash('error', 'Danh mục không tồn tại');
            return redirect()->route('admin.category.index');
        }

        $this->category = $category;
        // dd($this->name, $this->category);

        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->description = $category->description;
        $this->parent_id = $category->parent_id;
        $this->meta_title = $category->meta_title;
        $this->meta_description = $category->meta_description;
        $this->meta_keywords = $category->meta_keywords;
        $this->status = $category->status;
        $this->sort_order = $category->sort_order;
    }

    public function updatedName()
    {
        $this->slug = Str::slug($this->name);
    }

    public function rules()
    {

        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:categories,slug,' . $this->category->id,
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

    public function updateCategory()
    {
        $this->validate();

        $this->category->update([
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'parent_id' => $this->parent_id,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
            'status' => $this->status,
            'sort_order' => $this->sort_order,
            'image' => $this->image ? $this->image->store('categories', 'public') : $this->category->image,
        ]);

        session()->flash('success', '✅ Danh mục đã được cập nhật!');
        return redirect()->route('admin.category.index');
    }

    public function render()
    {
        $parents = Category::whereNull('parent_id')
            ->where('id', '!=', $this->category->id)
            ->where('status', 'active')
            ->get();

        return view('livewire.admin.pages.category.edit', compact('parents'));
    }
}
