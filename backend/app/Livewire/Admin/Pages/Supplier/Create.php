<?php

namespace App\Livewire\Admin\Pages\Supplier;

use App\Models\Supplier;
use Livewire\Component;

class Create extends Component
{
    public $form = [];

    public function rules()
    {
        return [
            'form.name' => 'required|string|max:255',
            'form.code' => 'required|string|unique:suppliers,code',
            'form.contact_person' => 'nullable|string|max:255',
            'form.email' => 'nullable|email|max:255',
            'form.phone' => 'nullable|string|max:20',
            'form.address' => 'nullable|string',
            'form.tax_code' => 'nullable|string|max:50',
            'form.bank_name' => 'nullable|string|max:255',
            'form.bank_account_number' => 'nullable|string|max:50',
            'form.bank_account_name' => 'nullable|string|max:255',
            'form.status' => 'required|in:active,inactive',
            'form.notes' => 'nullable|string',
        ];
    }

    public function save()
    {

        $this->validate();
        Supplier::create($this->form);
        session()->flash('success', '✅ Nhà cung cấp đã được tạo!');
        return redirect()->route('admin.supplier.index');
    }

    public function render()
    {
        return view('livewire.admin.pages.supplier.create');
    }
}
