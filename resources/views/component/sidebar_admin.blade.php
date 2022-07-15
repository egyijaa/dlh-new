<div class="sidebar sidebar-style-2">			
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-primary">
                <li class="nav-item {{ request()->is('admin/dashboard') ?'active' : '' }}">
                    <a href="{{ route('admin.dashboard.index') }}">
                        <i class="fas fa-desktop"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('admin/sampel-uji') || request()->is('admin/parameter-sampel') || request()->is('admin/pejabat') ?'active' : '' }} submenu">
                    <a data-toggle="collapse" href="#datamaster" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Data Master</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->is('admin/sampel-uji') || request()->is('admin/parameter-sampel') || request()->is('admin/pejabat') ?'show' : '' }}" id="datamaster">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->is('admin/sampel-uji') ?'active' : '' }}">
                                <a href="{{ route('admin.sampel-uji.index') }}">
                                    <span class="sub-item">Sampel Uji</span>
                                </a>
                            </li>
                            <li class="{{ request()->is('admin/parameter-sampel') ?'active' : '' }}">
                                <a href="{{ route('admin.parameter-sampel.index') }}">
                                    <span class="sub-item">Parameter Sampel</span>
                                </a>
                            </li>
                            <li class="{{ request()->is('admin/pejabat') ?'active' : '' }}">
                                <a href="{{ route('admin.pejabat.index') }}">
                                    <span class="sub-item">Pejabat</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ request()->is('admin/akun') || request()->is('admin/akun/pelanggan') ?'active' : '' }} submenu">
                    <a data-toggle="collapse" href="#akun" class="collapsed" aria-expanded="false">
                        <i class="fas fa-user-alt"></i>
                        <p>Akun</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->is('admin/akun') || request()->is('admin/akun/pelanggan') ?'show' : '' }}" id="akun">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->is('admin/akun') ?'active' : '' }}">
                                <a href="{{ route('admin.akun.index') }}">
                                    <span class="sub-item">Admin</span>
                                </a>
                            </li>
                            <li class="{{ request()->is('admin/akun/pelanggan') ?'active' : '' }}">
                                <a href="{{ route('admin.akun.pelangganIndex') }}">
                                    <span class="sub-item">Pelanggan</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ request()->is('admin/pengujian') ?'active' : '' }} submenu">
                    <a data-toggle="collapse" href="#pengujian" class="collapsed" aria-expanded="false">
                        <i class="fas fa-clipboard-list"></i>
                        <p>Pengujian</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->is('admin/pengujian') ?'show' : '' }}" id="pengujian">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->is('admin/pengujian') ?'active' : '' }}">
                                <a href="{{ route('admin.pengujian.index') }}">
                                    <span class="sub-item">Order baru</span>
                                </a>
                            </li>
                            <li class="{{ request()->is('admin/akun/pelanggan') ?'active' : '' }}">
                                <a href="{{ route('admin.akun.pelangganIndex') }}">
                                    <span class="sub-item">Order Lama (Selesai)</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="widgets.html">
                        <i class="fas fa-desktop"></i>
                        <p>Widgets</p>
                        <span class="badge badge-success">4</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>