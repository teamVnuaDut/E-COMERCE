<?php

namespace App\Livewire\Admin\Pages\Category;

use App\Models\Category;
use Livewire\Component;

class Show extends Component
{
    public Category $category;

    public function mount(Category $category)
    {
        if (! $category->exists) {
            session()->flash('error', 'Danh mục không tồn tại');
            return redirect()->route('admin.category.index');
        }

        $this->category = $category;
    }
    public function render()
    {
        return view('livewire.admin.pages.category.show');
    }
}
