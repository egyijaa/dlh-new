<div class="sidebar sidebar-style-2">			
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-primary">
                <li class="nav-item {{ request()->is('helper/dashboard') ?'active' : '' }}">
                    <a href="{{ route('helper.dashboard.index') }}">
                        <i class="fas fa-desktop"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('helper/pengambilanSampel') || request()->is('helper/pengambilanSampel/detailOrder/*') || request()->is('helper/pengambilanSampel/editOrder/*') || request()->is('helper/pengambilanSampel/beritaAcara/*') || request()->is('helper/pengambilanSampel/editBaPelanggan/*') || request()->is('helper/pengambilanSampel/showBuktiPembayaran/*') || request()->is('helper/pengambilanSampelSelesai') || request()->is('helper/pengambilanSampelSelesai/detailOrder/*') || request()->is('helper/pengambilanSampelSelesai/beritaAcara/*') || request()->is('helper/pengambilanSampelSelesai/editBaPelanggan/*') || request()->is('helper/pengambilanSampelSelesai/showBuktiPembayaran/*') ?'active' : '' }} submenu">
                    <a data-toggle="collapse" href="#pengambilansampel" class="collapsed" aria-expanded="false">
                        <i class="fas fa-fill-drip"></i>
                        <p>Pengambilan Sampel</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->is('helper/pengambilanSampel') || request()->is('helper/pengambilanSampel/detailOrder/*') || request()->is('helper/pengambilanSampel/editOrder/*') || request()->is('helper/pengambilanSampel/beritaAcara/*') || request()->is('helper/pengambilanSampel/editBaPelanggan/*') || request()->is('helper/pengambilanSampel/showBuktiPembayaran/*') || request()->is('helper/pengambilanSampelSelesai') || request()->is('helper/pengambilanSampelSelesai/detailOrder/*') || request()->is('helper/pengambilanSampelSelesai/beritaAcara/*') || request()->is('helper/pengambilanSampelSelesai/editBaPelanggan/*') || request()->is('helper/pengambilanSampelSelesai/showBuktiPembayaran/*') ?'show' : '' }}" id="pengambilansampel">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->is('helper/pengambilanSampel') || request()->is('helper/pengambilanSampel/detailOrder/*') || request()->is('helper/pengambilanSampel/editOrder/*') || request()->is('helper/pengambilanSampel/beritaAcara/*') || request()->is('helper/pengambilanSampel/editBaPelanggan/*') || request()->is('helper/pengambilanSampel/showBuktiPembayaran/*') ?'active' : '' }}">
                                <a href="{{ route('helper.pengambilanSampel.index') }}">
                                    <span class="sub-item">Order baru</span>
                                </a>
                            </li>
                            <li class="{{ request()->is('helper/pengambilanSampelSelesai') || request()->is('helper/pengambilanSampelSelesai/detailOrder/*') || request()->is('helper/pengambilanSampelSelesai/beritaAcara/*') || request()->is('helper/pengambilanSampelSelesai/editBaPelanggan/*') || request()->is('helper/pengambilanSampelSelesai/showBuktiPembayaran/*') ?'active' : '' }}">
                                <a href="{{ route('helper.pengambilanSampelSelesai.index') }}">
                                    <span class="sub-item">Order Lama (Selesai)</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ request()->is('helper/profil/changePassword') ?'active' : '' }}">
                    <a href="{{ route('helper.profil.changePassword') }}">
                        <i class="fas fa-user"></i>
                        <p>Profile Saya</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>