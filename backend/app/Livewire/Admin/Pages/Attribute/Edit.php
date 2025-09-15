<?php

namespace App\Livewire\Admin\Pages\Attribute;

use App\Models\Attribute;
use Illuminate\Support\Str;
use Livewire\Component;

class Edit extends Component
{
    public Attribute $attribute;

    public function rules()
    {
        return [
            'attribute.name' => 'required|string|max:255',
            'attribute.slug' => 'required|string|unique:attributes,slug,' . $this->attribute->id,
            'attribute.type' => 'required|in:select,text,number,color',
            'attribute.description' => 'nullable|string',
            'attribute.is_filterable' => 'boolean',
            'attribute.is_visible' => 'boolean',
            'attribute.is_required' => 'boolean',
            'attribute.sort_order' => 'nullable|integer|min:0',
        ];
    }

    public function updatedAttributeName()
    {
        $this->attribute->slug = Str::slug($this->attribute->name);
    }

    public function save()
    {
        $this->validate();
        $this->attribute->save();

        session()->flash('success', '✅ Thuộc tính đã được cập nhật!');
        return redirect()->route('admin.attribute.index');
    }

    public function render()
    {
        return view('livewire.admin.pages.attribute.edit');
    }
}
