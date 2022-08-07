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
                <li class="nav-item {{ request()->is('pelanggan/sampel-uji') || request()->is('pelanggan/pengujian')|| request()->is('pelanggan/pengujian/getOrder/*') || request()->is('pelanggan/pengujian/detailOrder/*') || request()->is('pelanggan/pengujian/tracking/*') || request()->is('pelanggan/pengujian/updateSampelParameter/*') || request()->is('pelanggan/pengujian/editSampelParameter/*') || request()->is('pelanggan/pengujian/createSampel/*') || request()->is('pelanggan/pengujian/showInvoice/*') || request()->is('pelanggan/pengambilanSampel') || request()->is('pelanggan/pengambilanSampel/createOrder') || request()->is('pelanggan/pengambilanSampel/detailOrder/*') || request()->is('pelanggan/pengambilanSampel/editOrder/*') || request()->is('pelanggan/pengambilanSampel/showInvoice/*') || request()->is('pelanggan/pengambilanSampel/tracking/*') ? 'active' : '' }} submenu">
                    <a data-toggle="collapse" href="#orderbaru" class="collapsed" aria-expanded="false">
                        <i class="fas fa-clipboard-list"></i>
                        <p>Order Baru</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->is('pelanggan/sampel-uji') || request()->is('pelanggan/pengujian') || request()->is('pelanggan/pengujian/getOrder/*') || request()->is('pelanggan/pengujian/detailOrder/*') || request()->is('pelanggan/pengujian/tracking/*') || request()->is('pelanggan/pengujian/updateSampelParameter/*') || request()->is('pelanggan/pengujian/editSampelParameter/*') || request()->is('pelanggan/pengujian/createSampel/*') || request()->is('pelanggan/pengujian/showInvoice/*') || request()->is('pelanggan/pengambilanSampel') || request()->is('pelanggan/pengambilanSampel/createOrder') || request()->is('pelanggan/pengambilanSampel/detailOrder/*') || request()->is('pelanggan/pengambilanSampel/editOrder/*') || request()->is('pelanggan/pengambilanSampel/showInvoice/*') || request()->is('pelanggan/pengambilanSampel/tracking/*') ?'show' : '' }}" id="orderbaru">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->is('pelanggan/pengambilanSampel') || request()->is('pelanggan/pengambilanSampel/createOrder') || request()->is('pelanggan/pengambilanSampel/editOrder/*') || request()->is('pelanggan/pengambilanSampel/detailOrder/*') || request()->is('pelanggan/pengambilanSampel/showInvoice/*') || request()->is('pelanggan/pengambilanSampel/tracking/*') ?'active' : '' }}">
                                <a href="{{ route('pelanggan.pengambilanSampel.index') }}">
                                    <span class="sub-item">Pengambilan Sampel</span>
                                </a>
                            </li>
                            <li class="{{ request()->is('pelanggan/pengujian') || request()->is('pelanggan/pengujian/getOrder/*') || request()->is('pelanggan/pengujian/detailOrder/*') || request()->is('pelanggan/pengujian/tracking/*') || request()->is('pelanggan/pengujian/updateSampelParameter/*') || request()->is('pelanggan/pengujian/showInvoice/*') || request()->is('pelanggan/pengujian/createSampel/*') || request()->is('pelanggan/pengujian/editSampelParameter/*') ?'active' : '' }}">
                                <a href="{{ route('pelanggan.pengujian.index') }}">
                                    <span class="sub-item">Pengujian</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ request()->is('pelanggan/pengujianSelesai')|| request()->is('pelanggan/pengujianSelesai/getOrder/*') || request()->is('pelanggan/pengujianSelesai/detailOrder/*') || request()->is('pelanggan/pengujianSelesai/tracking/*') || request()->is('pelanggan/pengujianSelesai/updateSampelParameter/*') || request()->is('pelanggan/pengujianSelesai/editSampelParameter/*') || request()->is('pelanggan/pengujianSelesai/createSampel/*') || request()->is('pelanggan/pengujianSelesai/showInvoice/*') || request()->is('pelanggan/pengambilanSampelSelesai') || request()->is('pelanggan/pengambilanSampelSelesai/createOrder') || request()->is('pelanggan/pengambilanSampelSelesai/detailOrder/*') || request()->is('pelanggan/pengambilanSampelSelesai/showInvoice/*') || request()->is('pelanggan/pengambilanSampelSelesai/tracking/*') ? 'active' : '' }} submenu">
                    <a data-toggle="collapse" href="#orderlama" class="collapsed" aria-expanded="false">
                        <i class="fas fa-clipboard-check"></i>
                        <p>Order Lama (Selesai)</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->is('pelanggan/pengujianSelesai')|| request()->is('pelanggan/pengujianSelesai/getOrder/*') || request()->is('pelanggan/pengujianSelesai/detailOrder/*') || request()->is('pelanggan/pengujianSelesai/tracking/*') || request()->is('pelanggan/pengujianSelesai/updateSampelParameter/*') || request()->is('pelanggan/pengujianSelesai/editSampelParameter/*') || request()->is('pelanggan/pengujianSelesai/createSampel/*') || request()->is('pelanggan/pengujianSelesai/showInvoice/*') || request()->is('pelanggan/pengambilanSampelSelesai') || request()->is('pelanggan/pengambilanSampelSelesai/createOrder') || request()->is('pelanggan/pengambilanSampelSelesai/detailOrder/*') || request()->is('pelanggan/pengambilanSampelSelesai/showInvoice/*') || request()->is('pelanggan/pengambilanSampelSelesai/tracking/*') ? 'show' : '' }}" id="orderlama">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->is('pelanggan/pengambilanSampelSelesai') || request()->is('pelanggan/pengambilanSampelSelesai/createOrder') || request()->is('pelanggan/pengambilanSampelSelesai/detailOrder/*') || request()->is('pelanggan/pengambilanSampelSelesai/showInvoice/*') || request()->is('pelanggan/pengambilanSampelSelesai/tracking/*') ?'active' : '' }}">
                                <a href="{{ route('pelanggan.pengambilanSampelSelesai.index') }}">
                                    <span class="sub-item">Pengambilan Sampel</span>
                                </a>
                            </li>
                            <li class="{{ request()->is('pelanggan/pengujianSelesai')|| request()->is('pelanggan/pengujianSelesai/getOrder/*') || request()->is('pelanggan/pengujianSelesai/detailOrder/*') || request()->is('pelanggan/pengujianSelesai/tracking/*') || request()->is('pelanggan/pengujianSelesai/updateSampelParameter/*') || request()->is('pelanggan/pengujianSelesai/editSampelParameter/*') || request()->is('pelanggan/pengujianSelesai/createSampel/*') || request()->is('pelanggan/pengujianSelesai/showInvoice/*') ? 'active' : '' }}">
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
                <li class="nav-item {{ request()->is('pelanggan/testimoni') ?'active' : '' }}">
                    <a href="{{ route('pelanggan.testimoni.index') }}">
                        <i class="fas fa-comment"></i>
                        <p>Testimoni</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('pelanggan/profil/changePassword') ?'active' : '' }}">
                    <a href="{{ route('pelanggan.profil.changePassword') }}">
                        <i class="fas fa-user"></i>
                        <p>Profile Saya</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
@endif