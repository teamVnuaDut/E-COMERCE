<?php

namespace App\Livewire\Admin\Pages\User;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $name, $email, $phone, $address, $avatar, $newAvatar;
    public $role, $status, $created_at, $updated_at;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->address = $user->address;
        $this->avatar = $user->avatar;
        $this->role = $user->role;
        $this->status = $user->status;
        $this->created_at = $user->created_at->format('d/m/Y H:i');
        $this->updated_at = $user->updated_at->format('d/m/Y H:i');
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'newAvatar' => 'nullable|image|max:2048',
        ]);

        $user = Auth::user();
        $user->name = $this->name;
        $user->phone = $this->phone;
        $user->address = $this->address;

        if ($this->newAvatar) {
            $path = $this->newAvatar->store('avatars', 'public');
            $user->avatar = $path;
        }

        $user->save();

        return redirect()->route('admin.user.index')->with('success', 'Thong tin da duoc cap nhat!');
    }

    public function render()
    {
        return view('livewire.admin.pages.user.edit');
    }
}
