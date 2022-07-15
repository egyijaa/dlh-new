@if (auth()->user()->aktivasi == 0)
<div class="sidebar sidebar-style-2">			
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-primary">
                <li class="nav-item {{ request()->is('pelanggan/dashboard') ?'active' : '' }}">
                    <a href="">
                        <i class="fas fa-desktop"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('pelanggan/sampel-uji') || request()->is('pelanggan/pengujian')|| request()->is('pelanggan/pengujian/getOrder/*') ? 'active' : '' }} submenu">
                    <a data-toggle="collapse" href="#datamaster" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Order Baru</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->is('pelanggan/sampel-uji') || request()->is('pelanggan/pengujian') || request()->is('pelanggan/pengujian/getOrder/*')  ?'show' : '' }}" id="datamaster">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->is('pelanggan/sampel-uji') ?'active' : '' }}">
                                <a href="">
                                    <span class="sub-item">Pengambilan Sampel</span>
                                </a>
                            </li>
                            <li class="{{ request()->is('pelanggan/pengujian') ||  request()->is('pelanggan/pengujian/getOrder/*')  ?'active' : '' }}">
                                <a href="">
                                    <span class="sub-item">Pengujian</span>
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
@else
<div class="sidebar sidebar-style-2">			
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-primary">
                <li class="nav-item {{ request()->is('pelanggan/dashboard') ?'active' : '' }}">
                    <a href="{{ route('pelanggan.dashboard.index') }}">
                        <i class="fas fa-desktop"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('pelanggan/sampel-uji') || request()->is('pelanggan/pengujian')|| request()->is('pelanggan/pengujian/getOrder/*') ? 'active' : '' }} submenu">
                    <a data-toggle="collapse" href="#datamaster" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Order Baru</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->is('pelanggan/sampel-uji') || request()->is('pelanggan/pengujian') || request()->is('pelanggan/pengujian/getOrder/*')  ?'show' : '' }}" id="datamaster">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->is('pelanggan/sampel-uji') ?'active' : '' }}">
                                <a href="">
                                    <span class="sub-item">Pengambilan Sampel</span>
                                </a>
                            </li>
                            <li class="{{ request()->is('pelanggan/pengujian') ||  request()->is('pelanggan/pengujian/getOrder/*')  ?'active' : '' }}">
                                <a href="{{ route('pelanggan.pengujian.index') }}">
                                    <span class="sub-item">Pengujian</span>
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
@endif