<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $recentOrders = $user->orders()->latest()->take(5)->get();

        return view('user.dashboard', compact('user', 'recentOrders'));
    }

    public function profile()
    {
        $user = auth()->user();
        return view('user.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        // Update basic info
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
        ]);

        // Update password if provided
        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng.']);
            }

            $user->update([
                'password' => Hash::make($request->new_password)
            ]);
        }

        // Update customer info if exists
        if ($user->customer) {
            $user->customer->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
            ]);
        }

        return back()->with('success', 'Thông tin cá nhân đã được cập nhật.');
    }

    // Admin methods
    public function index()
    {
        $users = User::with('customer')->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive,suspended',
        ]);

        $user->update($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'Thông tin người dùng đã được cập nhật.');
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => ['required', Rule::in(['admin', 'manager', 'staff', 'customer'])]
        ]);

        $user->update(['role' => $request->role]);

        return back()->with('success', 'Vai trò người dùng đã được cập nhật.');
    }

    public function updateStatus(Request $request, User $user)
    {
        $request->validate([
            'status' => 'required|in:active,inactive,suspended'
        ]);

        $user->update(['status' => $request->status]);

        return back()->with('success', 'Trạng thái người dùng đã được cập nhật.');
    }

    public function destroy(User $user)
    {
        if ($user->orders()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Không thể xóa người dùng vì có đơn hàng liên quan.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Người dùng đã được xóa thành công.');
    }
}
