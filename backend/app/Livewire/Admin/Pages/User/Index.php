<?php

namespace App\Livewire\Admin\Pages\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    public $user;

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        if (Auth::id() === $user->id) {
            session()->flash('error', 'Không thể xoá chính mình!');
            return;
        }

        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();
        session()->flash('success', 'Người dùng đã được xoá!');
    }
    public function render()
    {
        return view('livewire.admin.pages.user.index');
    }
}
