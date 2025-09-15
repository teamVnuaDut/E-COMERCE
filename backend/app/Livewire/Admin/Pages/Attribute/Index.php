<?php

namespace App\Livewire\Admin\Pages\Attribute;

use App\Models\Attribute;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public function updateSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        Attribute::findOrFail($id)->delete();
        session()->flash('success', '✅ Đã xóa thuộc tính!');
    }

    public function render()
    {
        $attributes = Attribute::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->orderBy('sort_order')
            ->paginate(10);

        return view('livewire.admin.pages.attribute.index', compact('attributes'));
    }
}
