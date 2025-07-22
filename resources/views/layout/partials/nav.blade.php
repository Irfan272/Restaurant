<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>

        <div style="float: left; padding: 10px; font-size: 25px; font-weight: bold;">
            KEDAI GEPREK BANGBRE
        </div>

        <nav class="nav navbar-nav">
            <ul class="navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                    @if (Auth::guard('user')->check())
                        <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true"
                            id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                            <h6 class="mb-0 text-gray-600">Welcome, {{ Auth::guard('user')->user()->name }}</h6>
                        </a>
                        <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                            @if(Auth::guard('user')->user()->role == 'Customer')
                                <a class="dropdown-item" href="/customer/edit/{{ Auth::guard('user')->user()->id }}">
                                    <i class="fa fa-user pull-left"></i> Profil Saya
                                </a>
                            @endif
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fa fa-sign-out pull-left"></i> Log Out
                                </button>
                            </form>
                        </div>
                    @else
                        <!-- Jika belum login -->
                        <a href="/login" class="user-profile">
                            <h6 class="mb-0 text-gray-600"><i class="fa fa-sign-in"></i> Login</h6>
                        </a>
                    @endif
                </li>
            </ul>
        </nav>
    </div>
</div>