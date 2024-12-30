<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark mt-2">
            <span class="logo-sm">
                <i class="ri-bar-chart-2-line"></i>
            </span>
            <span class="logo-lg">
                <h1 class="text-white"><i class="ri-bar-chart-2-line"></i> E-Finance</h1>
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light mt-2">
            <span class="logo-sm">
                <i class="ri-bar-chart-2-line"></i>
            </span>
            <span class="logo-lg">
                <h1 class="text-white"><i class="ri-bar-chart-2-line"></i> E-Finance</h1>
            </span>
        </a>
        <button
            type="button"
            class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu"></div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a
                        class="nav-link menu-link"
                        href="{{ route('dashboard') }}">
                        <i class="ri-dashboard-2-line"></i>
                        <span data-key="t-dashboards">Dashboards</span>
                    </a>
                </li>

                @if (Auth::user()->role == 'Administrator')
                <li class="nav-item">
                    <a
                        class="nav-link menu-link"
                        href="{{ route('admin.pegawai') }}">
                        <i class="ri-user-3-line"></i>
                        <span data-key="t-dashboards">Data Pegawai</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        class="nav-link menu-link"
                        href="#account"
                        data-bs-toggle="collapse"
                        role="button"
                        aria-expanded="false"
                        aria-controls="account">
                        <i class="ri-calculator-line"></i>
                        <span data-key="t-multi-level">Account</span>
                    </a>
                    <div class="collapse menu-dropdown" id="account">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.account') }}" class="nav-link {{ route('admin.account') == url()->current() ? 'active' : '' }}" data-key="t-level-1.1">
                                    Data Account
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.detail_account') }}" class="nav-link {{ route('admin.detail_account') == url()->current() ? 'active' : '' }}" data-key="t-level-1.2">
                                    Detail Account
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif

                @if (Auth::user()->role == 'Pimpinan')
                <li class="nav-item">
                    <a href="{{ route('pimpinan.pengajuan_dana') }}" class="nav-link menu-link">
                        <i class="ri-file-list-3-line"></i>
                        <span data-key="t-dashboards">Pengajuan Dana</span>
                    </a>
                </li>
                @endif


                @if (Auth::user()->role == 'Bendahara')
                <li class="nav-item">
                    <a
                        class="nav-link menu-link"
                        href="#keuangan"
                        data-bs-toggle="collapse"
                        role="button"
                        aria-expanded="false"
                        aria-controls="keuangan">
                        <i class="ri-money-dollar-circle-line"></i>
                        <span data-key="t-multi-level">Keuangan</span>
                    </a>
                    <div class="collapse menu-dropdown" id="keuangan">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('keuangan.saldo') }}" class="nav-link" data-key="t-level-2.1">
                                    Saldo
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('keuangan.pemasukan') }}" class="nav-link" data-key="t-level-2.2">
                                    Uang Masuk
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('keuangan.pengeluaran') }}" class="nav-link" data-key="t-level-2.3">
                                    Uang Keluar
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('keuangan.laporan') }}" class="nav-link" data-key="t-level-2.4">
                                    Laporan
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('keuangan.pengajuan_dana') }}" class="nav-link menu-link">
                                    <span data-key="t-dashboards">Pengajuan Dana</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif

                @if (Auth::user()->role == 'User')
                <li class="nav-item">
                    <a href="{{ route('karyawan.pengajuan') }}" class="nav-link menu-link">
                        <i class="ri-file-list-3-line"></i>
                        <span data-key="t-dashboards">Pengajuan Dana</span>
                    </a>
                </li>
                @endif

                <li class="nav-item">
                    <a
                        class="nav-link menu-link"
                        href="#sidebarMultilevel"
                        data-bs-toggle="collapse"
                        role="button"
                        aria-expanded="false"
                        aria-controls="sidebarMultilevel">
                        <i class="ri-share-line"></i>
                        <span data-key="t-multi-level">Multi Level</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarMultilevel">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-key="t-level-1.1">
                                    Level 1.1
                                </a>
                            </li>
                            <li class="nav-item">
                                <a
                                    href="#sidebarAccount"
                                    class="nav-link"
                                    data-bs-toggle="collapse"
                                    role="button"
                                    aria-expanded="false"
                                    aria-controls="sidebarAccount"
                                    data-key="t-level-1.2">
                                    Level 1.2
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarAccount">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link" data-key="t-level-2.1">
                                                Level 2.1
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a
                                                href="#sidebarCrm"
                                                class="nav-link"
                                                data-bs-toggle="collapse"
                                                role="button"
                                                aria-expanded="false"
                                                aria-controls="sidebarCrm"
                                                data-key="t-level-2.2">
                                                Level 2.2
                                            </a>
                                            <div class="collapse menu-dropdown" id="sidebarCrm">
                                                <ul class="nav nav-sm flex-column">
                                                    <li class="nav-item">
                                                        <a
                                                            href="#"
                                                            class="nav-link"
                                                            data-key="t-level-3.1">
                                                            Level 3.1
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a
                                                            href="#"
                                                            class="nav-link"
                                                            data-key="t-level-3.2">
                                                            Level 3.2
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->