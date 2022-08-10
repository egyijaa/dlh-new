@extends('layouts.frontend')
@section('content')
<div class="body">
    <header id="header" data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': false, 'stickyStartAt': 91, 'stickySetTop': '-91px', 'stickyChangeLogo': true}">
        <div class="header-body border-0 box-shadow-none">
            <div class="border-bottom-light">
                <div class="header-container container container-xl-custom">
                    <div class="header-row py-4">
                        <div class="header-column">
                            <div class="header-row">
                                <div class="header-logo m-0">
                                    <a href="/">
                                        <img alt="Porto" width="61" height="51" src="{{ url('frontend/img/demos/logopemkot.png') }}">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="header-column justify-content-end align-items-center flex-row">
                            <div class="hstack gap-4 ps-4 py-2 font-weight-semi-bold">
                                <div class="vr opacity-2 d-none d-lg-inline-block"></div>
                                <div class="d-none d-lg-inline-block">
                                    <ul class="nav nav-pills me-1">
                                        <li class="nav-item pe-2 mx-1">
                                            <a href="http://www.facebook.com/{{ $beranda->fb }}" target="_blank" title="Facebook" class="text-color-dark text-color-hover-primary text-2"><i class="fab fa-facebook-f"></i></a>
                                        </li>
                                        <li class="nav-item px-2 mx-1">
                                            <a href="http://www.instagram.com/{{ $beranda->ig }}" target="_blank" title="Instagram" class="text-color-dark text-color-hover-primary text-2"><i class="fab fa-instagram"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>	
            </div>				
            <div class="header-nav-bar z-index-0">
                <div class="container container-xl-custom">
                    <div class="header-row py-2">
                        <div class="header-column">
                            <div class="header-row align-items-center justify-content-end">
                                <div class="header-nav header-nav-links justify-content-start pb-1">
                                    <div class="header-nav-main header-nav-main-text-capitalize header-nav-main-effect-2 header-nav-main-sub-effect-1">
                                        <nav class="collapse">
                                            <ul class="nav nav-pills" id="mainNav">
                                                <li>
                                                    <a class="nav-link" href="{{ route('home') }}">
                                                        Beranda
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="nav-link" href="{{ route('biaya') }}">
                                                        Cek Biaya
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="nav-link active" href="{{ route('cekSertifikat') }}" >
                                                        Cek Sertifikat
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="nav-link" href="/#tentang" data-hash="" data-hash-offset="0" data-hash-offset-lg="32">
                                                        Tentang Kami
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="nav-link" href="{{ url('frontend/UserManualDLH.pdf') }}" target="_blank">
                                                        Buku Panduan
                                                    </a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>

                                @guest
                                <a href="/login" class="btn btn-modern btn-primary font-weight-bold border-0 btn-arrow-effect-1">LOGIN <i class="fas fa-arrow-right ms-2"></i></a>
                                @endguest
                                @auth
                                @if (Auth::user()->role == 0)
                                <a href="{{ route('pelanggan.dashboard.index') }}" class="btn btn-modern btn-primary font-weight-bold border-0 btn-arrow-effect-1">Dashboard <i class="fas fa-arrow-right ms-2"></i></a>
                                @elseif (Auth::user()->role == 1)
                                <a href="{{ route('admin.dashboard.index') }}" class="btn btn-modern btn-primary font-weight-bold border-0 btn-arrow-effect-1">Dashboard Admin <i class="fas fa-arrow-right ms-2"></i></a>
                                @elseif (Auth::user()->role == 2)
                                <a href="{{ route('bendahara.dashboard.index') }}" class="btn btn-modern btn-primary font-weight-bold border-0 btn-arrow-effect-1">Dashboard Bendahara <i class="fas fa-arrow-right ms-2"></i></a>
                                @endif
                                    <form action="{{ url('logout') }}" method="POST" class="btn btn-modern">
                                        @csrf
                                        <button type="submit">
                                                Logout
                                            </button>
                                    </form>
                                @endauth


                                <button class="btn header-btn-collapse-nav" data-bs-toggle="collapse" data-bs-target=".header-nav-main nav">
                                    <i class="fas fa-bars"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div role="main" class="main">
        <section class="section my-0 py-5 border-0">
            <div class="container container-xl-custom pb-3">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-7">
                        <div class="card-header d-flex justify-content-center">
                            <h3 class="card-title">Cek Sertifikat Pengujian</h3>
                          </div>
                    </div>
                </div>
                
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <hr class="solid my-5">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <h2 class="font-weight-normal text-7 mb-2"><strong class="font-weight-extra-bold">Coming Soon</strong></h2>
                            <p class="mb-0 lead">Mohon maaf, pengecekan sertifikat pengujian dalam proses pengerjaan.. Untuk Sementara Anda bisa melihat sertifikat pengujian anda pada halaman dashboard pelanggan yang berada pada Menu Order Lama > Pengujian. </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <hr class="solid my-5">
                        </div>
                    </div>
                </div>


            </div>
        </section>
        
        <section class="border-0 p-relative">

            <div class="container">
                <div class="row pb-4 pt-4">
                    <div class="col-md-8">
                        <h3 class="font-weight-semibold text-9 text-capitalize mb-2">LOKASI</h3>
                        <div class="divider divider-small mt-0 mb-4">
                            <hr class="bg-primary">
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.8177994129705!2d109.32411331409578!3d-0.02927863555309829!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e1d58f96ca48811%3A0xca6dc22bf4279b0f!2sDinas%20Lingkungan%20Hidup%20Kota%20Pontianak!5e0!3m2!1sen!2sid!4v1657273551985!5m2!1sen!2sid" class="google-map m-0" style="min-height: 200px; border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>

            <div class="container pt-5 mt-3 pb-3">
                <div class="row">
                </div>
            </div>

        </section>

    </div>

       <!-- WA float button -->
       <a href="https://api.whatsapp.com/send?phone={{ $beranda->wa }}&text=Halo%20Admin%21%20Saya%20mau%20bertanya." class="float" target="_blank">
        <i class="fab fa-whatsapp my-float"></i>
      </a>

    <footer id="footer" class="position-relative bg-quaternary mt-0 border-top-0">		
        <div class="container container-xl-custom pt-5 pb-3">
            <div class="row pt-5">
                <div class="col-md-6 col-lg-3">
                    <h3 class="mb-3 text-4-5 text-color-light">Pemerintah Kota Pontianak</h3>							
                    <p class="text-3 text-color-grey mb-0">Dinas Lingkungan Hidup<br>Jalan Alianyang No. 7B Pontianak<br>78116</p>
                </div>
                <div class="col-md-6 col-lg-3 mt-4 mt-md-0">
                    <h3 class="mb-3 text-4-5 text-color-light">Kontak Kami</h3>							
                    <a href="" class="d-flex align-items-center text-decoration-none text-color-primary text-color-hover-light font-weight-medium ms-1">
                        <i class="icon icon-phone text-color-primary text-4-5 me-2"></i>
                        Telp. (0561) 748134
                    </a>
                </div>
                <div class="col-md-6 col-lg-4 mt-4 mt-lg-0">
                    <h3 class="mb-3 text-4-5 text-color-light">Layanan</h3>
                    <ul class="list list-unstyled columns-lg-2 font-weight-medium">
                        <li><a href="#" class="text-color-grey text-color-hover-primary">Pengambilan Sampling</a></li>
                        <li><a href="#" class="text-color-grey text-color-hover-primary">Pengujian Sampling</a></li>
                    </ul>
                </div>
                <div class="col-md-6 col-lg-2 mt-4 mt-lg-0">
                    <h3 class="mb-3 text-4-5 text-color-light">Follow Us</h3>
                    <ul class="social-icons social-icons-clean social-icons-medium">
                        <li class="social-icons-facebook">
                            <a href="http://www.facebook.com/{{ $beranda->fb }}" target="_blank" title="Facebook">
                                <i class="fab fa-facebook-f text-color-light"></i>
                            </a>
                        </li>
                        <li class="social-icons-instagram">
                            <a href="http://www.instagram.com/{{ $beranda->ig }}" target="_blank" title="Instagram">
                                <i class="fab fa-instagram text-color-light"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright bg-transparent mt-5">
            <div class="container container-xl-custom">
                <hr class="bg-color-light opacity-1">
                <div class="row">
                    <div class="col mt-4 mb-4 pb-5">
                        <p class="text-center text-color-grey text-3 mb-0">DLH © 2022. All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
@endsection