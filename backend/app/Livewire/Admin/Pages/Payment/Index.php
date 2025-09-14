<?php

namespace App\Livewire\Admin\Pages\Payment;

use App\Models\Payment;
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
        Payment::findOrFail($id)->delete();
        session()->flash('Success', 'Đã xoá phương thức thanh toán');
    }
    public function render()
    {
        $payments = Payment::query()
            ->where('payment_number', 'like', '%' . $this->search . '%')
            ->orWhere('transaction_id', 'like', '%' . $this->search . '%')
            ->orderBy('created_at')
            ->paginate(10);
        return view('livewire.admin.pages.payment.index', compact('payments'));
    }
}
