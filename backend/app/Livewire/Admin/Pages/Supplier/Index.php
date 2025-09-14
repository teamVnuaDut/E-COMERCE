<?php

namespace App\Livewire\Admin\Pages\Supplier;

use App\Models\Supplier;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $status = '';
    protected $listeners = ['confirmDelete'];

    protected $queryString = ['search', 'status'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->forceDelete();

        session()->flash('success', '🗑️ Đã xoá nhà cung cấp!');
    }

    public function render()
    {
        $query = Supplier::query();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                    ->orWhere('code', 'like', "%{$this->search}%")
                    ->orWhere('contact_person', 'like', "%{$this->search}%");
            });
        }

        if ($this->status) {
            $query->where('status', $this->status);
        }

        $suppliers = $query->latest()->paginate(10);

        return view('livewire.admin.pages.supplier.index', compact('suppliers'));
    }
}
