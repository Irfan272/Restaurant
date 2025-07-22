<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0; margin-top:10px;">
            @if (Auth::guard('user')->check())
                @php $role = Auth::guard('user')->user()->role; @endphp

                @if ($role == 'Admin')
                    <a href="/dashboard" class="site_title">
                        <img src="{{ asset('assets/Logo.png') }}" style="width: 70px" height="auto">
                        <span class="pl-2">GEPREK BANGBRE</span>
                    </a>
                @elseif (in_array($role, ['Customer', 'Koki', 'Kasir', 'Pelayan', 'Owner']))
                    <a @if ($role != 'Customer') href="/dashboard" @endif class="site_title">
                        <img src="{{ asset('assets/Logo.png') }}" style="width: 70px" height="auto">
                        <span class="pl-2" style="font-size: 14px;">GEPREK BANGBRE</span>
                    </a>
                @endif
            @else
                <!-- Guest (belum login) -->
                <a class="site_title">
                    <img src="{{ asset('assets/Logo.png') }}" style="width: 70px" height="auto">
                    <span class="pl-2" style="font-size: 14px;">GEPREK BANGBRE</span>
                </a>
            @endif
        </div>

        <div class="clearfix"></div>
        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>Menu</h3>
                <ul class="nav side-menu">
                    @if (!Auth::guard('user')->check())
                        {{-- Belum login --}}
                        <li><a href="/"><i class="fa fa-home"></i> Dashboard</a></li>
                    @else
                        {{-- Sudah login, cek apakah role-nya Customer --}}
                        @php $role = Auth::guard('user')->user()->role; @endphp

                        @if ($role === 'Customer')
                            <li><a href="/"><i class="fa fa-home"></i> Dashboard</a></li>
                        @endif
                    @endif



                    @if (Auth::guard('user')->check())
                        @php $role = Auth::guard('user')->user()->role; @endphp

                        @if (in_array($role, ['Admin', 'Koki', 'Kasir', 'Pelayan', 'Owner']))
                            <li><a href="/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
                        @endif
                    @endif

                    {{-- ✅ Ini ditampilkan untuk Kasir, Customer, dan Guest (belum login) --}}
                    @if (
                        (Auth::guard('user')->check() && in_array(Auth::guard('user')->user()->role, ['Kasir', 'Customer'])) ||
                            !Auth::guard('user')->check())
                        <li><a href="/makanan"><i class="fa fa-cutlery"></i> Makanan</a></li>
                        <li><a href="/minuman"><i class="fa fa-coffee"></i> Minuman</a></li>
                    @endif

                    @if (Auth::guard('user')->check() &&
                            (Auth::guard('user')->user()->role == 'Kasir' || Auth::guard('user')->user()->role == 'Customer'))
                        <li><a href="/order"><i class="fa fa-cart-plus"></i> Order</a></li>
                    @endif

                    @if (Auth::guard('user')->check() && Auth::guard('user')->user()->role == 'Customer')
                        <li><a href="/pesanan"><i class="fa fa-archive"></i> Pesanan</a></li>
                    @endif

                    @if (Auth::guard('user')->check() && in_array($role, ['Admin']))
                        <li><a><i class="fa fa-tachometer"></i> Master Data <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="/akun">Data Akun</a></li>
                                <li><a href="/customer">Data Customer</a></li>
                                <li><a href="/list-menu">Data Menu</a></li>
                            </ul>
                        </li>
                    @endif

                    @if (Auth::guard('user')->check() && in_array($role, ['Kasir', 'Koki', 'Pelayan']))
                        <li><a><i class="fa fa-desktop"></i> Transaksi <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="/pesanan">Pesanan</a></li>
                                <li><a href="/rating">Rating</a></li>
                            </ul>
                        </li>
                    @endif

                    @if (Auth::guard('user')->check() && $role == 'Owner')
                        <li><a><i class="fa fa-file"></i> Laporan <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="/laporan-penjualan">Laporan Penjualan</a></li>
                            </ul>
                        </li>
                    @endif

                    @if (!Auth::guard('user')->check())
                        <li><a href="/login"><i class="fa fa-sign-in"></i> Login</a></li>
                    @endif

                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->
    </div>
</div>
