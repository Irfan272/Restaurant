<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0; margin-top:10px;">
            <a href="/dashboard" class="site_title"><img src="{{ asset('assets/Logo.png') }}" style="width: 70px"
                    height="auto"><span class="pl-2">E-KASIR </span></a>
        </div>

        <div class="clearfix"></div>
        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>Menu</h3>
                <ul class="nav side-menu">
                    @if (Auth::guard('user')->user()->role == 'Admin' || Auth::guard('user')->user()->role == 'Koki')
                        <li><a href="/dashboard"><i class="fa fa-home"></i> Dashboard</a>
                    @endif

                    <li><a href="/makanan"><i class="fa fa-cutlery"></i> Makanan</a>
                    <li><a href="/minuman"><i class="fa fa-coffee"></i> Minuman</a>
                    <li><a href="/order"><i class="fa fa-cart-plus"></i> Order</a>
                    </li>
                    @if (Auth::guard('user')->user()->role == 'Admin')
                        <li><a><i class="fa fa-tachometer"></i> Master Data <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">

                                <li><a href="/akun">Data Akun</a></li>
                                <li><a href="/category">Data Category</a></li>
                                <li><a href="/list-menu">Data Menu</a></li>

                            </ul>
                        </li>
                    @endif
                    @if (Auth::guard('user')->user()->role == 'Admin' || Auth::guard('user')->user()->role == 'Koki')
                        <li><a><i class="fa fa-desktop"></i> Transaksi <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="/pesanan">Pesanan</a></li>
                                <li><a href="/rating">Rating</a></li>
                                {{-- <li><a href="/reservasi">reservasi</a></li> --}}

                            </ul>
                        </li>
                    @endif
                    @if (Auth::guard('user')->user()->role == 'Admin' || Auth::guard('user')->user()->role == 'Owner')
                        <li><a><i class="fa fa-file"></i> Laporan <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="/laporan-penjualan">Laporan Penjualan</a></li>

                            </ul>

                        </li>
                    @endif
                    <li>

                    </li>
                </ul>
            </div>

        </div>
        <!-- /sidebar menu -->


        <!-- /menu footer buttons -->
    </div>
</div>
