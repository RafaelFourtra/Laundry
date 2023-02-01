<nav class="main-sidebar ps-menu">
    <div class="sidebar-toggle action-toggle">
        <a href="#">
            <i class="fas fa-bars"></i>
        </a>
    </div>
    <div class="sidebar-opener action-toggle">
        <a href="#">
            <i class="ti-angle-right"></i>
        </a>
    </div>
    <div class="sidebar-header">
        <div class="text">Laundry Kuy</div>
        <div class="close-sidebar action-toggle">
            <i class="ti-close"></i>
        </div>
    </div>
    <div class="sidebar-content">
        <ul>
            <li class="{{request()->segment(1) == 'dashboard' ? 'active' : ''}}">
                <a href="{{ route('dashboard') }}" class="link">
                    <i class="ti-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            @if(request()->user()->hasRole('admin'))
            <li class="{{request()->segment(1) == 'konfigurasi' ? 'active open' : ''}}">
                <a href="#" class="main-menu has-dropdown">
                    <i class="ti-desktop"></i>
                    <span>Konfigurasi</span>
                </a>
                <ul class="sub-menu">
                    <li
                        class="{{request()->segment(1) == 'konfigurasi' && request()->segment(2) == 'roles' ? 'active open' : ''}}">
                        <a href="{{ route('roles.index') }}" class="link"><span>Roles</span></a>
                    </li>
                </ul>
            </li>
            @endif
            <li class="{{request()->segment(1) == 'users' ? 'active' : ''}}">
                <a href="{{ route('users.index') }}" class="link">
                    <i class="ti-user"></i>
                    <span>Users</span>
                </a>
            </li>
            <li class="{{request()->segment(1) == 'pelanggan' ? 'active' : ''}}">
                <a href="{{ route('pelanggan.index') }}" class="link">
                    <i class="ti-id-badge"></i>
                    <span>Pelanggan</span>
                </a>
            </li>
            <li class="{{request()->segment(1) == 'outlet' ? 'active' : ''}}">
                <a href="{{ route('outlet.index') }}" class="link">
                    <i class="ti-home"></i>
                    <span>Outlet</span>
                </a>
            </li>
            <li class="{{request()->segment(1) == 'produk' ? 'active' : ''}}">
                <a href="{{ route('produk.index') }}" class="link">
                    <i class="ti-package"></i>
                    <span>Produk</span>
                </a>
            </li>
            <li class="{{request()->segment(1) == 'pemesanan' ? 'active' : ''}}">
                <a href="{{ route('pemesanan.index') }}" class="link">
                    <i class="ti-bag"></i>
                    <span>Pemesanan</span>
                </a>
            </li>
            <li class="{{request()->segment(1) == 'transaksi' ? 'active' : ''}}">
                <a href="{{ route('transaksi.index') }}" class="link">
                    <i class="ti-wallet"></i>
                    <span>Transaksi</span>
                </a>
            </li>
        </ul>
    </div>
</nav>