<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <img src="{{ asset('img/pgnlogo.png') }}" style="opacity: 1" alt="User Image">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

            <!-- Sidebar Menu -->
            @if (Auth::user()->role == 'admin')
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li id="menu-home" class="nav-item {{ request()->is('dashboard') ? 'menu-open' : '' }}">
                            <a href="{{ route('dashboard') }}"
                                class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                                <i class="iconify nav-icon" data-icon="tabler:home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li id="menu-acount" class="nav-item {{ request()->is('acount') ? 'menu-open' : '' }}">
                            <a href="" class="nav-link {{ request()->is('acount') ? 'active' : '' }}">
                                <i class="iconify nav-icon ml-1" data-icon="pajamas:account"></i>
                                <p>Kelola Akun <i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview" style="padding-left: 20px;">
                                <li id="menu-tambahkan-akun" class="nav-item">
                                    <a href="{{ route('tambahAkun') }}" class="nav-link">
                                        <i class="iconify nav-icon ml-1" data-icon="pajamas:account"></i></i>
                                        <p>Tambahkan Akun</p>
                                    </a>
                                </li>
                                <li id="menu-data-akun" class="nav-item">
                                    <a href="{{ route('dataAkun') }}" class="nav-link">
                                        <i class="iconify nav-icon" data-icon="carbon:data-table"></i>
                                        <p>Data Akun </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li id="menu-kelola-klien" class="nav-item">
                            <a href="{{ route ('dataKlien')}}" class="nav-link">
                                <i class="iconify nav-icon" data-icon="tdesign:data"></i>
                                <p>Kelola Klien <i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview" style="padding-left: 20px;">
                                <li id="menu-tambah-klien" class="nav-item">
                                    <a href="{{ route('tambahKlien') }}" class="nav-link">
                                        <i class="iconify nav-icon ml-1" data-icon="pajamas:account"></i></i>
                                        <p>Tambah Klien</p>
                                    </a>
                                </li>
                                <li id="menu-data-klien" class="nav-item">
                                    <a href="{{ route('dataKlien') }}" class="nav-link">
                                        <i class="iconify nav-icon" data-icon="carbon:data-table"></i>
                                        <p>Data Klien</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li id="menu-server" class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="iconify nav-icon" data-icon="uil:server"></i>
                                <p>Server<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview" style="padding-left: 20px;">
                                <li id="menu-tambah-server" class="nav-item">
                                    <a href="{{ route('tambahServer') }}" class="nav-link">
                                        <i class="iconify nav-icon ml-1" data-icon="pajamas:account"></i></i>
                                        <p>Tambah Server</p>
                                    </a>
                                </li>
                                <li id="menu-data-server" class="nav-item">
                                    <a href="{{ route('dataServer') }}" class="nav-link">
                                        <i class="iconify nav-icon" data-icon="uil:server"></i>
                                        <p>Data Server</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- Tambahan ID untuk submenu pelacak perjalanan -->
                        <li id="menu-perangkat" class="nav-item">
                            <a href="{{ route('dataDevice') }}" class="nav-link">
                                <i class="iconify nav-icon" data-icon="mingcute:location-3-line"></i>
                                <p>Perangkat</p>
                            </a>
                        </li>
                        <li id="menu-lokasi" class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="iconify nav-icon" data-icon="grommet-icons:location"></i>
                                <p>Lokasi<i class="fas fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview" style="padding-left: 20px;">
                                <li id="menu-klien" class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="iconify nav-icon" data-icon="tdesign:data"></i>
                                        <p>Klien</p>
                                    </a>
                                </li>
                                <li id="menu-server" class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="iconify nav-icon" data-icon="prime:server"></i>
                                        <p>Server</p>
                                    </a>
                                </li>
                                <li id="menu-perangkat" class="nav-item">
                                    <a href="{{ route('dataDevice') }}" class="nav-link">
                                        <i class="iconify nav-icon" data-icon="mingcute:location-3-line"></i>
                                        <p>Perangkat</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li id="menu-log" class="nav-item">
                            <a href="" class="nav-link">
                                <i class="far fa-calendar-check nav-icon"></i>
                                <p>Log</p>
                            </a>
                        </li>
                        <li id="menu-notifikasi"
                            class="nav-item {{ request()->is('/notifikasi') ? 'menu-open' : '' }}">
                            <a href="" class="nav-link {{ request()->is('/notifikasi') ? 'active' : '' }}">
                                <i class="iconify nav-icon" data-icon="mdi:bell-warning"></i>
                                <p>Notifikasi</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            @endif
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li id="menu-logout" class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <i class="iconify nav-icon" data-icon="material-symbols:logout"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ...

        // Tambahkan event listener untuk menyimpan status menu saat menu diklik
        var menuItems = document.querySelectorAll('.nav-item');

        menuItems.forEach(function(menuItem) {
            menuItem.addEventListener('click', function() {
                // Simpan status menu ke localStorage
                localStorage.setItem('openedMenu', menuItem.id);

                // Bersihkan status menu aktif sebelumnya
                menuItems.forEach(function(item) {
                    item.classList.remove('active');
                });

                // Bersihkan status menu terbuka pada submenu yang tidak aktif
                menuItems.forEach(function(item) {
                    if (item.id !== menuItem.id && item.classList.contains(
                            'menu-open')) {
                        item.classList.remove('menu-open');
                    }
                });

                // Tambahkan kelas aktif pada menu yang diklik
                menuItem.classList.add('active');
            });
        });
    });
</script>



{{--

        <div id="header">
            <div class="header__toggle">
                <i class='bx bx-menu' id="header-toggle"></i>
            </div>
        </div>


        <div class="l-navbar" id="nav-bar">

            <nav class="nav">
                <div>
                    <a href="#" class="nav__logo">
                        <i class='bx bx-layer nav__logo-icon'></i>
                        <span class="nav__logo-name">Bedimcode</span>
                    </a>

                    <div class="nav__list">
                        @if (Auth::user()->role == 'admin')
                            <a href="{{ route('adminDashboard') }}" class="nav__link active">
                            <i class='bx bx-grid-alt nav__icon' ></i>
                                <span class="nav__name">Dashboard</span>
                            </a>
                            @else
                            <a href="{{ route('userDashboard') }}" class="nav__link active">
                                <i class='bx bx-grid-alt nav__icon' ></i>
                                    <span class="nav__name">Dashboard</span>
                                </a>
                        @endif
                        @if (Auth::user()->role == 'admin')
                        <a href="{{ route('createAcount') }}" class="nav__link">
                            <i class='bx bx-user nav__icon' ></i>
                            <span class="nav__name">Users</span>
                        </a>
                        @endif

                        <a href="{{ route('manageAcount') }}" class="nav__link">
                            <i class='bx bx-message-square-detail nav__icon' ></i>
                            <span class="nav__name">kelola akun</span>
                        </a>

                        <a href="#" class="nav__link">
                            <i class='bx bx-bookmark nav__icon' ></i>
                            <span class="nav__name">kondisi kendaraan</span>
                        </a>

                        <a href="{{ route('tipeKendaraan') }}" class="nav__link">
                            <i class='bx bx-folder nav__icon' ></i>
                            <span class="nav__name">Data kendaraan</span>
                        </a>

                        <a href="#" class="nav__link">
                            <i class='bx bx-bar-chart-alt-2 nav__icon' ></i>
                            <span class="nav__name">Analytics</span>
                        </a>
                    </div>
                </div>

                <a href="#" class="nav__link">
                    <i class='bx bx-log-out nav__icon' ></i>
                    <span class="nav__name">Log Out</span>
                </a>
            </nav>
        </div>

 --}}
