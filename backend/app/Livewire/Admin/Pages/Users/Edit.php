<?php

namespace App\Livewire\Admin\Pages\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public int $id;
    public User $user;

    public $name, $email, $phone, $address, $avatar, $newAvatar;
    public $role, $status;

    public function mount()
    {
        $this->user = User::findOrFail($this->id);

        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->phone = $this->user->phone;
        $this->address = $this->user->address;
        $this->avatar = $this->user->avatar;
        $this->role = $this->user->role;
        $this->status = $this->user->status;
    }

    public function updateUser()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'newAvatar' => 'nullable|image|max:2048',
        ]);

        $user = $this->user;

        $user->name = $this->name;
        $user->phone = $this->phone;
        $user->address = $this->address;

        if ($this->newAvatar) {
            $path = $this->newAvatar->store('avatars', 'public');
            $user->avatar = $path;
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Thông tin đã được cập nhật!');
    }

    public function render()
    {
        return view('livewire.admin.pages.users.edit');
    }
}
