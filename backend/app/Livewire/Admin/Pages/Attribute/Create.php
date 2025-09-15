<?php

namespace App\Livewire\Admin\Pages\Attribute;

use App\Models\Attribute;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Component;

class Create extends Component
{
    public $name, $slug, $type = 'select', $description;
    public $is_filterable = false, $is_visible = true, $is_required = false;
    public $sort_order = 0;
    public $availableSlugs = [];

    public function mount()
    {
        $this->availableSlugs = Category::pluck('slug')->toArray();
    }

    public function updatedName()
    {
        $this->slug = Str::slug($this->name);
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:attributes,slug',
            'type' => 'required|in:select,text,number,color',
            'description' => 'nullable|string',
            'is_filterable' => 'boolean',
            'is_visible' => 'boolean',
            'is_required' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ];
    }

    public function save()
    {
        $this->validate();

        Attribute::create([
            'name' => $this->name,
            'slug' => $this->slug,
            'type' => $this->type,
            'description' => $this->description,
            'is_filterable' => $this->is_filterable,
            'is_visible' => $this->is_visible,
            'is_required' => $this->is_required,
            'sort_order' => $this->sort_order,
        ]);

        session()->flash('success', '✅ Thuộc tính đã được tạo!');
        return redirect()->route('admin.attribute.index');
        dd($this->name, $this->slug, $this->type);
    }

    public function render()
    {
        return view('livewire.admin.pages.attribute.create');
    }
}
