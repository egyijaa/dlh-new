<div class="sidebar sidebar-style-2">			
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-primary">
                <li class="nav-item {{ request()->is('bendahara/dashboard') ?'active' : '' }}">
                    <a href="{{ route('bendahara.dashboard.index') }}">
                        <i class="fas fa-desktop"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('bendahara/pengambilanSampel') || request()->is('bendahara/pengambilanSampel/detailOrder/*') || request()->is('bendahara/pengambilanSampel/editOrder/*') || request()->is('bendahara/pengambilanSampel/beritaAcara/*') || request()->is('bendahara/pengambilanSampel/editBaPelanggan/*') || request()->is('bendahara/pengambilanSampel/showBuktiPembayaran/*') || request()->is('bendahara/pengambilanSampelSelesai') || request()->is('bendahara/pengambilanSampelSelesai/detailOrder/*') || request()->is('bendahara/pengambilanSampelSelesai/beritaAcara/*') || request()->is('bendahara/pengambilanSampelSelesai/editBaPelanggan/*') || request()->is('bendahara/pengambilanSampelSelesai/showBuktiPembayaran/*') ?'active' : '' }} submenu">
                    <a data-toggle="collapse" href="#pengambilansampel" class="collapsed" aria-expanded="false">
                        <i class="fas fa-fill-drip"></i>
                        <p>Pengambilan Sampel</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->is('bendahara/pengambilanSampel') || request()->is('bendahara/pengambilanSampel/detailOrder/*') || request()->is('bendahara/pengambilanSampel/editOrder/*') || request()->is('bendahara/pengambilanSampel/beritaAcara/*') || request()->is('bendahara/pengambilanSampel/editBaPelanggan/*') || request()->is('bendahara/pengambilanSampel/showBuktiPembayaran/*') || request()->is('bendahara/pengambilanSampelSelesai') || request()->is('bendahara/pengambilanSampelSelesai/detailOrder/*') || request()->is('bendahara/pengambilanSampelSelesai/beritaAcara/*') || request()->is('bendahara/pengambilanSampelSelesai/editBaPelanggan/*') || request()->is('bendahara/pengambilanSampelSelesai/showBuktiPembayaran/*') ?'show' : '' }}" id="pengambilansampel">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->is('bendahara/pengambilanSampel') || request()->is('bendahara/pengambilanSampel/detailOrder/*') || request()->is('bendahara/pengambilanSampel/editOrder/*') || request()->is('bendahara/pengambilanSampel/beritaAcara/*') || request()->is('bendahara/pengambilanSampel/editBaPelanggan/*') || request()->is('bendahara/pengambilanSampel/showBuktiPembayaran/*') ?'active' : '' }}">
                                <a href="{{ route('bendahara.pengambilanSampel.index') }}">
                                    <span class="sub-item">Order baru</span>
                                </a>
                            </li>
                            <li class="{{ request()->is('bendahara/pengambilanSampelSelesai') || request()->is('bendahara/pengambilanSampelSelesai/detailOrder/*') || request()->is('bendahara/pengambilanSampelSelesai/beritaAcara/*') || request()->is('bendahara/pengambilanSampelSelesai/editBaPelanggan/*') || request()->is('bendahara/pengambilanSampelSelesai/showBuktiPembayaran/*') ?'active' : '' }}">
                                <a href="{{ route('bendahara.pengambilanSampelSelesai.index') }}">
                                    <span class="sub-item">Order Lama (Selesai)</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ request()->is('bendahara/pengujian') || request()->is('bendahara/pengujian/detailOrder/*') || request()->is('bendahara/pengujian/editSampelParameter/*') || request()->is('bendahara/pengujian/showBuktiPembayaran/*') || request()->is('bendahara/pengujian/getOrder/*') || request()->is('bendahara/pengujian/getOrder/hasilUji/*/sampel/*') || request()->is('bendahara/pengujian/editShuPelanggan/*') || request()->is('bendahara/pengujianSelesai') || request()->is('bendahara/pengujianSelesai/detailOrder/*') || request()->is('bendahara/pengujianSelesai/showBuktiPembayaran/*') || request()->is('bendahara/pengujianSelesai/getOrder/*') || request()->is('bendahara/pengujianSelesai/getOrder/hasilUji/*/sampel/*') || request()->is('bendahara/pengujianSelesai/editShuPelanggan/*') ? 'active' : '' }} submenu">
                    <a data-toggle="collapse" href="#pengujian" class="collapsed" aria-expanded="false">
                        <i class="fas fa-clipboard-list"></i>
                        <p>Pengujian</p>
                        <span class="caret"></span>
                    </a> 
                    <div class="collapse {{ request()->is('bendahara/pengujian') || request()->is('bendahara/pengujian/detailOrder/*') || request()->is('bendahara/pengujian/editSampelParameter/*') || request()->is('bendahara/pengujian/showBuktiPembayaran/*') || request()->is('bendahara/pengujian/getOrder/*') || request()->is('bendahara/pengujian/getOrder/hasilUji/*/sampel/*') || request()->is('bendahara/pengujian/editShuPelanggan/*') || request()->is('bendahara/pengujianSelesai') ||  request()->is('bendahara/pengujianSelesai/detailOrder/*') || request()->is('bendahara/pengujianSelesai/showBuktiPembayaran/*') || request()->is('bendahara/pengujianSelesai/getOrder/*') || request()->is('bendahara/pengujianSelesai/getOrder/hasilUji/*/sampel/*') || request()->is('bendahara/pengujianSelesai/editShuPelanggan/*') ?'show' : '' }}" id="pengujian">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->is('bendahara/pengujian') || request()->is('bendahara/pengujian/detailOrder/*') || request()->is('bendahara/pengujian/editSampelParameter/*') || request()->is('bendahara/pengujian/showBuktiPembayaran/*') || request()->is('bendahara/pengujian/getOrder/*') || request()->is('bendahara/pengujian/getOrder/hasilUji/*/sampel/*') || request()->is('bendahara/pengujian/editShuPelanggan/*') ?'active' : '' }}">
                                <a href="{{ route('bendahara.pengujian.index') }}">
                                    <span class="sub-item">Order baru</span>
                                </a>
                            </li>
                            <li class="{{ request()->is('bendahara/pengujianSelesai') || request()->is('bendahara/pengujianSelesai/detailOrder/*') || request()->is('bendahara/pengujianSelesai/showBuktiPembayaran/*') || request()->is('bendahara/pengujianSelesai/getOrder/*') || request()->is('bendahara/pengujianSelesai/getOrder/hasilUji/*/sampel/*') || request()->is('bendahara/pengujianSelesai/editShuPelanggan/*') ?'active' : '' }}">
                                <a href="{{ route('bendahara.pengujianSelesai.index') }}">
                                    <span class="sub-item">Order Lama (Selesai)</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ request()->is('bendahara/profil/changePassword') ?'active' : '' }}">
                    <a href="{{ route('bendahara.profil.changePassword') }}">
                        <i class="fas fa-user"></i>
                        <p>Profile Saya</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>