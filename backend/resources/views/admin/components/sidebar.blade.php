<aside class="sidebar">
    <div class="sidebar-header">
        <h1 class="text-xl font-bold">LIVING HEALTHY LIFE</h1>
    </div>

    <!--name-->
    <span class="fas fa-user-circle text-4xl text-gray-600"></span>
    Hi there {{ Auth::user()->name }}
    </span>

    <nav class="sidebar-menu">
        <a href="#" class="active"><i class="fas fa-th-large"></i> Dashboard</a>
        <a href="#"><i class="fas fa-users"></i> Users</a>
        <a href="{{ route('admin.products') }}"><i class="fas fa-box"></i> Products</a>
        <a href="#"><i class="fas fa-shopping-cart"></i> Orders</a>
        <a href="#"><i class="fas fa-cog"></i> SETTINGS</a>
        <a href="#"><i class="fas fa-sliders-h"></i> Settings</a>
        <a href="#">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </a>
    </nav>
</aside>
