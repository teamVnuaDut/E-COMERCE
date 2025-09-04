<?php

namespace App\Livewire\Pages\Categories;

use App\Models\Categories;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
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
        'slug' => 'required|string|max:255|unique:categories,slug',
    ];

    protected $fillable = [
        'name',
        'parent_id',
        'status',
        'description',
        'slug',
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

    public function save()
    {
        $this->validate();

        Categories::create([
            'name' => $this->name,
            'parent_id' => $this->parent_id,
            'status' => $this->status,
            'description' => $this->description,
            'slug' => $this->slug,
        ]);

        session()->flash('message', 'Danh mục đã được tạo thành công.');
        return redirect()->route('categories.index');
    }

    public function cancel()
    {
        return redirect()->route('admin.categories');
    }

    public function mount()
    {
        $this->categories = Categories::all();
    }

    public function render()
    {
        return view('livewire.pages.categories.create', [
            'categories' => $this->categories,
        ]);
    }
}
