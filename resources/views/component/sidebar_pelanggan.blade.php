@if (auth()->user()->aktivasi == 0)
<div class="sidebar sidebar-style-2">			
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
        
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
                <li class="nav-item {{ request()->is('pelanggan/sampel-uji') || request()->is('pelanggan/pengujian')|| request()->is('pelanggan/pengujian/getOrder/*') || request()->is('pelanggan/pengujian/tracking/*') || request()->is('pelanggan/pengujian/updateSampelParameter/*') || request()->is('pelanggan/pengujian/editSampelParameter/*') || request()->is('pelanggan/pengujian/createSampel/*') || request()->is('pelanggan/pengambilanSampel') || request()->is('pelanggan/pengambilanSampel/createOrder') ? 'active' : '' }} submenu">
                    <a data-toggle="collapse" href="#orderbaru" class="collapsed" aria-expanded="false">
                        <i class="fas fa-clipboard-list"></i>
                        <p>Order Baru</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->is('pelanggan/sampel-uji') || request()->is('pelanggan/pengujian') || request()->is('pelanggan/pengujian/getOrder/*') || request()->is('pelanggan/pengujian/tracking/*') || request()->is('pelanggan/pengujian/updateSampelParameter/*') || request()->is('pelanggan/pengujian/editSampelParameter/*') || request()->is('pelanggan/pengujian/createSampel/*') || request()->is('pelanggan/pengambilanSampel') || request()->is('pelanggan/pengambilanSampel/createOrder')  ?'show' : '' }}" id="orderbaru">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->is('pelanggan/pengambilanSampel') || request()->is('pelanggan/pengambilanSampel/createOrder') ?'active' : '' }}">
                                <a href="{{ route('pelanggan.pengambilanSampel.index') }}">
                                    <span class="sub-item">Pengambilan Sampel</span>
                                </a>
                            </li>
                            <li class="{{ request()->is('pelanggan/pengujian') ||  request()->is('pelanggan/pengujian/getOrder/*') || request()->is('pelanggan/pengujian/tracking/*') || request()->is('pelanggan/pengujian/updateSampelParameter/*') || request()->is('pelanggan/pengujian/createSampel/*') || request()->is('pelanggan/pengujian/editSampelParameter/*') ?'active' : '' }}">
                                <a href="{{ route('pelanggan.pengujian.index') }}">
                                    <span class="sub-item">Pengujian</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item submenu">
                    <a data-toggle="collapse" href="#orderlama" class="collapsed" aria-expanded="false">
                        <i class="fas fa-clipboard-check"></i>
                        <p>Order Lama (Selesai)</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="orderlama">
                        <ul class="nav nav-collapse">
                            <li class="">
                                <a href="">
                                    <span class="sub-item">Pengambilan Sampel</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="{{ route('pelanggan.pengujianSelesai.index') }}">
                                    <span class="sub-item">Pengujian</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ request()->is('pelanggan/daftarHarga/pengujian') || request()->is('pelanggan/daftarHarga/pengambilanSampel') ? 'active' : '' }} submenu">
                    <a data-toggle="collapse" href="#daftarharga" class="collapsed" aria-expanded="false">
                        <i class="fas fa-money-bill-wave"></i>
                        <p>Daftar Harga</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->is('pelanggan/daftarHarga/pengujian') || request()->is('pelanggan/daftarHarga/pengambilanSampel') ? 'show' : '' }}" id="daftarharga">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->is('pelanggan/daftarHarga/pengambilanSampel') ? 'active' : '' }}">
                                <a href="{{ route('pelanggan.daftarHarga.pengambilanSampel') }}">
                                    <span class="sub-item">Pengambilan Sampel</span>
                                </a>
                            </li>
                            <li class="{{ request()->is('pelanggan/daftarHarga/pengujian') ? 'active' : '' }}">
                                <a href="{{ route('pelanggan.daftarHarga.pengujian') }}">
                                    <span class="sub-item">Pengujian</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ request()->is('pelanggan/profil/changePassword/*') ?'active' : '' }}">
                    <a href="{{ route('pelanggan.profil.changePassword', Auth::user()->id) }}">
                        <i class="fas fa-user"></i>
                        <p>Profile Saya</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
@endif