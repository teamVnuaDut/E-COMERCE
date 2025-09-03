<?php

namespace App\Livewire\Pages\Categories;

use Livewire\Component;
use App\Models\Categories;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use WithFileUploads;

    public $categoryId;
    public $name;
    public $parent_id;
    public $status = 'active';
    public $description;
    public $slug;
    public $categories;

    protected $rules = [
        'name' => 'required|string|max:255',
        'parent_id' => 'nullable|exists:categories,id',
        'status' => 'required|in:active,inactive',
        'description' => 'nullable|string',
        'slug' => 'required|string|max:255|unique:categories,slug,' . 'categoryId',
    ];

    protected $messages = [
        'name.required' => 'Tên danh mục không được để trống.',
        'name.max' => 'Tên danh mục không được vượt quá 255 ký tự.',
        'parent_id.exists' => 'Danh mục cha không hợp lệ.',
        'status.in' => 'Trạng thái không hợp lệ.',
        'description.string' => 'Mô tả phải là chuỗi ký tự.',
        'slug.required' => 'Slug không được để trống.',
        'slug.max' => 'Slug không được vượt quá 255 ký tự.',
        'slug.unique' => 'Slug đã tồn tại. Vui lòng chọn một slug khác.',
    ];

    public function mount($id)
    {
        $category = Categories::findOrFail($id);
        $this->categoryId = $category->id;
        $this->name = $category->name;
        $this->parent_id = $category->parent_id;
        $this->status = $category->status;
        $this->description = $category->description;
        $this->slug = $category->slug;

        //load all
        $this->categories = Categories::where('id', '!=', $id)->get();
    }

    public function render()
    {
        return view('livewire.pages.categories.edit');
    }

    public function update()
    {
        $this->validate();

        $category = Categories::findOrFail($this->categoryId);

        $category->update([
            'name' => $this->name,
            'parent_id' => $this->parent_id,
            'status' => $this->status,
            'description' => $this->description,
            'slug' => Str::slug($this->slug),
        ]);

        $category->save();

        session()->flash('message', 'Cập nhật danh mục thành công!');

        return redirect()->route('admin.categories');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function cancel()
    {
        return redirect()->route('admin.categories');
    }
}
