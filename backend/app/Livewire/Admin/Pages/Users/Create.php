<?php

namespace App\Livewire\Admin\Pages\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $name, $email = '', $phone, $address, $password = '', $avatar, $role = 'user', $status = 'active';

    public function rules()
    {
        // dd($this);
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'password' => 'required|string|min:6',
            'avatar' => 'nullable|image|max:2048',
            'role' => 'required|in:admin,user,staff',
            'status' => 'required|in:active,inactive',
        ];
    }

    public function createUser()
    {
        $this->validate();

        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->phone = $this->phone;
        $user->address = $this->address;
        $user->password = Hash::make($this->password);
        $user->role = $this->role;
        $user->status = $this->status;

        if ($this->avatar) {
            $path = $this->avatar->store('avatars', 'public');
            $user->avatar = $path;
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Người dùng đã được tạo!');
    }

    public function render()
    {
        return view('livewire.admin.pages.users.create');
    }
}
