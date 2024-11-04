<div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img 
                @if (file_exists(public_path('storage/uploads/profile_pictures/'.auth()->user()->username.'/'.auth()->user()->username.'_profile.png')))
                    src="{{ asset('storage/uploads/profile_pictures/'. auth()->user()->username .'/'.auth()->user()->username.'_profile.png') }}?t={{ time() }}"
                @elseif (file_exists(public_path('storage/uploads/profile_pictures/'.auth()->user()->username.'/'.auth()->user()->username.'_profile.jpg')))
                    src="{{ asset('storage/uploads/profile_pictures/'. auth()->user()->username .'/'.auth()->user()->username.'_profile.jpg') }}?t={{ time() }}"
                @elseif (file_exists(public_path('storage/uploads/profile_pictures/'.auth()->user()->username.'/'.auth()->user()->username.'_profile.jpeg')))
                    src="{{ asset('storage/uploads/profile_pictures/'. auth()->user()->username .'/'.auth()->user()->username.'_profile.jpeg') }}?t={{ time() }}"
                @endif
            class="img-circle elevation-2" alt="User Image">

        </div>
        <div class="info">
            <a href="{{ url('/profile')}}" class="d-block">{{ auth()->user()->nama }}</a>
        </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline mt-2">
        <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                    <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ url('/') }}" class="nav-link {{ ($activeMenu == 'dashboard') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            <!-- Data Pengguna Dropdown -->
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Data Pengguna
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('/level') }}" class="nav-link {{ ($activeMenu == 'level') ? 'active' : '' }}">
                            <i class="far fa-user nav-icon"></i>
                            <p>Level User</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/user') }}" class="nav-link {{ ($activeMenu == 'user') ? 'active' : '' }}">
                            <i class="far fa-user nav-icon"></i>
                            <p>Data User</p>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Data Barang Dropdown -->
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-box"></i>
                    <p>
                        Data Barang
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('/kategori') }}" class="nav-link {{ ($activeMenu == 'kategori') ? 'active' : '' }}">
                            <i class="far fa-bookmark nav-icon"></i>
                            <p>Kategori Barang</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/barang') }}" class="nav-link {{ ($activeMenu == 'barang') ? 'active' : '' }}">
                            <i class="far fa-list-alt nav-icon"></i>
                            <p>Data Barang</p>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Data Transaksi Dropdown -->
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-exchange-alt"></i>
                    <p>
                        Data Transaksi
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('/stok') }}" class="nav-link {{ ($activeMenu == 'stok') ? 'active' : '' }}">
                            <i class="fas fa-cubes nav-icon"></i>
                            <p>Stok Barang</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/penjualan') }}" class="nav-link {{ ($activeMenu == 'penjualan') ? 'active' : '' }}">
                            <i class="fas fa-cash-register nav-icon"></i>
                            <p>Transaksi Penjualan</p>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Data Pengiriman Dropdown -->
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-truck"></i>
                    <p>
                        Data Pengiriman
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('/supplier') }}" class="nav-link {{ ($activeMenu == 'supplier') ? 'active' : '' }}">
                            <i class="fas fa-truck nav-icon"></i>
                            <p>Supplier</p>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Log Out Button -->
            <li class="nav-item">
                <a href="{{ url('logout') }}" class="nav-link">
                    <button type="button" class="btn btn-block btn-danger btn-lg">Log out</button>
                </a>
            </li>
        </ul>        
    </nav>
    <!-- /.sidebar-menu -->
</div>
