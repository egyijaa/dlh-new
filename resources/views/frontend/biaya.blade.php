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
                                    <a href="demo-renewable-energy.html">
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
                                            <a href="http://www.facebook.com/" target="_blank" title="Facebook" class="text-color-dark text-color-hover-primary text-2"><i class="fab fa-facebook-f"></i></a>
                                        </li>
                                        <li class="nav-item px-2 mx-1">
                                            <a href="http://www.twitter.com/" target="_blank" title="Twitter" class="text-color-dark text-color-hover-primary text-2"><i class="fab fa-twitter"></i></a>
                                        </li>
                                        <li class="nav-item px-2 mx-1">
                                            <a href="http://www.instagram.com/" target="_blank" title="Instagram" class="text-color-dark text-color-hover-primary text-2"><i class="fab fa-instagram"></i></a>
                                        </li>
                                        <li class="nav-item px-2 mx-1 me-0 pe-0">
                                            <a href="http://www.linkedin.com/" target="_blank" title="Linkedin" class="text-color-dark text-color-hover-primary text-2"><i class="fab fa-linkedin-in"></i></a>
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
                                                    <a class="nav-link active" href="{{ route('biaya') }}">
                                                        Cek Biaya
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="nav-link" href="#">
                                                        Cek Sertifikat
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="nav-link" href="#">
                                                        Metode Pembayaran
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="nav-link" href="/#tentang" data-hash="" data-hash-offset="0" data-hash-offset-lg="32">
                                                        Tentang Kami
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
                            <h3 class="card-title">Daftar Harga</h3>
                          </div>
                    </div>
                </div>
                <div class="row row-gutter-sm justify-content-center pb-5 mb-1">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                              <th>No</th>
                              <th>Jenis Sampel</th>
                              <th>Parameter</th>
                              <th>Harga</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                            @foreach ($parameter as $item)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{  $item->sampelUji->nama_sampel  }}</td>
                                    <td>{{ $item->nama_parameter }}</td>
                                    <td> @currency($item->harga)</td>
                                </tr>
                            @endforeach

                            </tbody>
                          </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="overflow-hidden mb-4">
                            <h2 class="text-color-dark font-weight-bold text-center text-8 line-height-2 mb-0 appear-animation" data-appear-animation="maskUp" data-appear-animation-delay="500">Proses Layanan Kami</h2>
                        </div>
                    </div>
                </div>
                <div class="row pt-lg-4">
                    <div class="col position-relative">
                        <div class="process custom-process-style-1 d-flex w-100 flex-column flex-lg-row pb-2 mb-4">
                            <div class="process-step col-12 col-lg-3 mb-5 mb-lg-4 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="200">
                                <div class="process-step-circle">
                                    <strong class="process-step-circle-content text-color-primary text-8">1</strong>
                                </div>
                                <div class="process-step-content px-5">
                                    <h4 class="text-color-dark font-weight-bold text-4 line-height-1 mb-3">1. Pendaftaran</h4>
                                    <p class="custom-font-secondary custom-text-size-1 px-3 mb-0">Silahkan Login / Register di website POLIS untuk membuat akun</p>
                                </div>
                            </div>
                            <div class="process-step col-12 col-lg-3 mb-5 mb-lg-4 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="400">
                                <div class="process-step-circle">
                                    <strong class="process-step-circle-content text-color-primary text-8">2</strong>
                                </div>
                                <div class="process-step-content px-5">
                                    <h4 class="text-color-dark font-weight-bold text-4 line-height-1 mb-3">2. Pemesanan</h4>
                                    <p class="custom-font-secondary custom-text-size-1 px-3 mb-0">Pilih Menu order baru, kemudian pilih layanan yang diinginkan</p>
                                </div>
                            </div>
                            <div class="process-step col-12 col-lg-3 mb-5 mb-lg-4 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="600">
                                <div class="process-step-circle">
                                    <strong class="process-step-circle-content text-color-primary text-8">3</strong>
                                </div>
                                <div class="process-step-content px-5">
                                    <h4 class="text-color-dark font-weight-bold text-4 line-height-1 mb-3">3. Proses Layanan</h4>
                                    <p class="custom-font-secondary custom-text-size-1 px-3 mb-0">Silahkan isi formulir secara lengkap dari masing-masing layanan yang telah diberikan</p>
                                </div>
                            </div>
                            <div class="process-step col-12 col-lg-3 mb-5 mb-lg-4 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="400">
                                <div class="process-step-circle">
                                    <strong class="process-step-circle-content text-color-primary text-8">4</strong>
                                </div>
                                <div class="process-step-content px-5">
                                    <h4 class="text-color-dark font-weight-bold text-4 line-height-1 mb-3">4. Pengambilan Hasil</h4>
                                    <p class="custom-font-secondary custom-text-size-1 px-3 mb-0">Hasil dapat diambil di kantor DLH</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="border-0 p-relative">

            <div class="container">
                <div class="row pt-5 pb-4">
                    <div class="col-md-8">
                        <h3 class="font-weight-semibold text-9 text-capitalize mb-2">Our Locations</h3>
                        <div class="divider divider-small mt-0 mb-4">
                            <hr class="bg-primary">
                        </div>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <a href="#" class="btn btn-tertiary border-0 text-3-5 font-weight-semi-bold btn-px-5 btn-py-3 d-none d-md-inline-block">Request Rate</a>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.8177994129705!2d109.32411331409578!3d-0.02927863555309829!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e1d58f96ca48811%3A0xca6dc22bf4279b0f!2sDinas%20Lingkungan%20Hidup%20Kota%20Pontianak!5e0!3m2!1sen!2sid!4v1657273551985!5m2!1sen!2sid" class="google-map m-0" style="min-height: 600px; border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>

            <div class="container pt-5 mt-3 pb-3">
                <div class="row">
                </div>
            </div>

        </section>

    </div>
    <footer id="footer" class="position-relative bg-quaternary mt-0 border-top-0">		
        <div class="container container-xl-custom pt-5 pb-3">
            <div class="row pt-5">
                <div class="col-md-6 col-lg-3">
                    <h3 class="mb-3 text-4-5 text-color-light">Pemerintah Kota Pontianak</h3>							
                    <p class="text-3 text-color-grey mb-0">Dinas Lingkungan Hidup<br>Jalan Alianyang No. 7B Pontianak<br>78116</p>
                </div>
                <div class="col-md-6 col-lg-3 mt-4 mt-md-0">
                    <h3 class="mb-3 text-4-5 text-color-light">Kontak Kami</h3>							
                    <a href="tel:0123456789" class="d-flex align-items-center text-decoration-none text-color-primary text-color-hover-light font-weight-medium ms-1">
                        <i class="icon icon-phone text-color-primary text-4-5 me-2"></i>
                        Telp. (0561) 766980
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
                            <a href="http://www.facebook.com/" target="_blank" title="Facebook">
                                <i class="fab fa-facebook-f text-color-light"></i>
                            </a>
                        </li>
                        <li class="social-icons-twitter">
                            <a href="http://www.twitter.com/" target="_blank" title="Twitter">
                                <i class="fab fa-twitter text-color-light"></i>
                            </a>
                        </li>
                        <li class="social-icons-instagram">
                            <a href="http://www.instagram.com/" target="_blank" title="Instagram">
                                <i class="fab fa-instagram text-color-light"></i>
                            </a>
                        </li>
                        <li class="social-icons-linkedin">
                            <a href="http://www.linkedin.com/" target="_blank" title="Linkedin">
                                <i class="fab fa-linkedin text-color-light"></i>
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