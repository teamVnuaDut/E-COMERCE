<div>
    <h1>Đăng nhập</h1>

    @if (session('error'))
    <div style="color: red;">{{ session('error') }}</div>
    @endif

    <form wire:submit="login">
        <div>
            <input type="email" wire:model.live="email" placeholder="Email">
            @error('email') <span style="color: red;">{{ $message }}</span> @enderror
        </div>

        <div>
            <input type="password" wire:model.live="password" placeholder="Mật khẩu">
            @error('password') <span style="color: red;">{{ $message }}</span> @enderror
        </div>

        <button type="submit">Đăng nhập</button>
    </form>
</div>
