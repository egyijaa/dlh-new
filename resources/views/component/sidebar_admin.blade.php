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
                <li class="nav-item {{ request()->is('admin/sampel-uji') || request()->is('admin/parameter-sampel') || request()->is('admin/pejabat') || request()->is('admin/beranda') || request()->is('admin/testimoni') ?'active' : '' }} submenu">
                    <a data-toggle="collapse" href="#datamaster" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Data Master</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->is('admin/sampel-uji') || request()->is('admin/parameter-sampel') || request()->is('admin/pejabat') || request()->is('admin/beranda') || request()->is('admin/testimoni') ?'show' : '' }}" id="datamaster">
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
                                    <span class="sub-item">Jabatan</span>
                                </a>
                            </li>
                            <li class="{{ request()->is('admin/beranda') ?'active' : '' }}">
                                <a href="{{ route('admin.beranda.index') }}">
                                    <span class="sub-item">Konten Beranda</span>
                                </a>
                            </li>
                            <li class="{{ request()->is('admin/testimoni') ?'active' : '' }}">
                                <a href="{{ route('admin.testimoni.index') }}">
                                    <span class="sub-item">Testimoni</span>
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
                <li class="nav-item {{ request()->is('admin/pengambilanSampel') || request()->is('admin/pengambilanSampel/detailOrder/*') || request()->is('admin/pengambilanSampel/editOrder/*') || request()->is('admin/pengambilanSampel/beritaAcara/*') || request()->is('admin/pengambilanSampel/editBaPelanggan/*') || request()->is('admin/pengambilanSampel/showBuktiPembayaran/*') || request()->is('admin/pengambilanSampelSelesai') || request()->is('admin/pengambilanSampelSelesai/detailOrder/*') || request()->is('admin/pengambilanSampelSelesai/beritaAcara/*') || request()->is('admin/pengambilanSampelSelesai/editBaPelanggan/*') || request()->is('admin/pengambilanSampelSelesai/showBuktiPembayaran/*') ?'active' : '' }} submenu">
                    <a data-toggle="collapse" href="#pengambilansampel" class="collapsed" aria-expanded="false">
                        <i class="fas fa-fill-drip"></i>
                        <p>Pengambilan Sampel</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->is('admin/pengambilanSampel') || request()->is('admin/pengambilanSampel/detailOrder/*') || request()->is('admin/pengambilanSampel/editOrder/*') || request()->is('admin/pengambilanSampel/beritaAcara/*') || request()->is('admin/pengambilanSampel/editBaPelanggan/*') || request()->is('admin/pengambilanSampel/showBuktiPembayaran/*') || request()->is('admin/pengambilanSampelSelesai') || request()->is('admin/pengambilanSampelSelesai/detailOrder/*') || request()->is('admin/pengambilanSampelSelesai/beritaAcara/*') || request()->is('admin/pengambilanSampelSelesai/editBaPelanggan/*') || request()->is('admin/pengambilanSampelSelesai/showBuktiPembayaran/*') ?'show' : '' }}" id="pengambilansampel">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->is('admin/pengambilanSampel') || request()->is('admin/pengambilanSampel/detailOrder/*') || request()->is('admin/pengambilanSampel/editOrder/*') || request()->is('admin/pengambilanSampel/beritaAcara/*') || request()->is('admin/pengambilanSampel/editBaPelanggan/*') || request()->is('admin/pengambilanSampel/showBuktiPembayaran/*') ?'active' : '' }}">
                                <a href="{{ route('admin.pengambilanSampel.index') }}">
                                    <span class="sub-item">Order baru</span>
                                </a>
                            </li>
                            <li class="{{ request()->is('admin/pengambilanSampelSelesai') || request()->is('admin/pengambilanSampelSelesai/detailOrder/*') || request()->is('admin/pengambilanSampelSelesai/beritaAcara/*') || request()->is('admin/pengambilanSampelSelesai/editBaPelanggan/*') || request()->is('admin/pengambilanSampelSelesai/showBuktiPembayaran/*') ?'active' : '' }}">
                                <a href="{{ route('admin.pengambilanSampelSelesai.index') }}">
                                    <span class="sub-item">Order Lama (Selesai)</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ request()->is('admin/pengujian') || request()->is('admin/pengujian/detailOrder/*') || request()->is('admin/pengujian/editSampelParameter/*') || request()->is('admin/pengujian/showBuktiPembayaran/*') || request()->is('admin/pengujian/getOrder/*') || request()->is('admin/pengujian/getOrder/hasilUji/*/sampel/*') || request()->is('admin/pengujian/editShuPelanggan/*') || request()->is('admin/pengujianSelesai') || request()->is('admin/pengujianSelesai/detailOrder/*') || request()->is('admin/pengujianSelesai/showBuktiPembayaran/*') || request()->is('admin/pengujianSelesai/getOrder/*') || request()->is('admin/pengujianSelesai/getOrder/hasilUji/*/sampel/*') || request()->is('admin/pengujianSelesai/editShuPelanggan/*') ? 'active' : '' }} submenu">
                    <a data-toggle="collapse" href="#pengujian" class="collapsed" aria-expanded="false">
                        <i class="fas fa-clipboard-list"></i>
                        <p>Pengujian</p>
                        <span class="caret"></span>
                    </a> 
                    <div class="collapse {{ request()->is('admin/pengujian') || request()->is('admin/pengujian/detailOrder/*') || request()->is('admin/pengujian/editSampelParameter/*') || request()->is('admin/pengujian/showBuktiPembayaran/*') || request()->is('admin/pengujian/getOrder/*') || request()->is('admin/pengujian/getOrder/hasilUji/*/sampel/*') || request()->is('admin/pengujian/editShuPelanggan/*') || request()->is('admin/pengujianSelesai') ||  request()->is('admin/pengujianSelesai/detailOrder/*') || request()->is('admin/pengujianSelesai/showBuktiPembayaran/*') || request()->is('admin/pengujianSelesai/getOrder/*') || request()->is('admin/pengujianSelesai/getOrder/hasilUji/*/sampel/*') || request()->is('admin/pengujianSelesai/editShuPelanggan/*') ?'show' : '' }}" id="pengujian">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->is('admin/pengujian') || request()->is('admin/pengujian/detailOrder/*') || request()->is('admin/pengujian/editSampelParameter/*') || request()->is('admin/pengujian/showBuktiPembayaran/*') || request()->is('admin/pengujian/getOrder/*') || request()->is('admin/pengujian/getOrder/hasilUji/*/sampel/*') || request()->is('admin/pengujian/editShuPelanggan/*') ?'active' : '' }}">
                                <a href="{{ route('admin.pengujian.index') }}">
                                    <span class="sub-item">Order baru</span>
                                </a>
                            </li>
                            <li class="{{ request()->is('admin/pengujianSelesai') || request()->is('admin/pengujianSelesai/detailOrder/*') || request()->is('admin/pengujianSelesai/showBuktiPembayaran/*') || request()->is('admin/pengujianSelesai/getOrder/*') || request()->is('admin/pengujianSelesai/getOrder/hasilUji/*/sampel/*') || request()->is('admin/pengujianSelesai/editShuPelanggan/*') ?'active' : '' }}">
                                <a href="{{ route('admin.pengujianSelesai.index') }}">
                                    <span class="sub-item">Order Lama (Selesai)</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ request()->is('admin/profil/changePassword/*') ?'active' : '' }}">
                    <a href="{{ route('admin.profil.changePassword', Auth::user()->id) }}">
                        <i class="fas fa-user"></i>
                        <p>Profile Saya</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>