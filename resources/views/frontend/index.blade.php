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
                                                    <a class="nav-link active" href="{{ route('home') }}">
                                                        Beranda
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="nav-link" href="{{ route('biaya') }}">
                                                        Cek Biaya
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="nav-link" href="{{ route('cekSertifikat') }}" >
                                                        Cek Sertifikat
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="nav-link" href="#tentang" data-hash="" data-hash-offset="0" data-hash-offset-lg="32">
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
                                @elseif (Auth::user()->role == 3)
                                <a href="{{ route('helper.dashboard.index') }}" class="btn btn-modern btn-primary font-weight-bold border-0 btn-arrow-effect-1">Dashboard Helper <i class="fas fa-arrow-right ms-2"></i></a>
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

        <section class="section section-with-shape-divider border-0 py-0 my-0 bg-transparent">

            <div class="hero position-relative overflow-hidden">
                <div class="background-image-wrapper position-absolute overlay overlay-show overlay-primary overlay-op-8 top-0 left-0 right-0 bottom-0 lazyload" data-appear-animation="kenBurnsToLeft" data-appear-animation-duration="30s" data-plugin-options="{'minWindowWidth': 0}" style="background-image: url({{ url('frontend/img/lazy.png') }}); background-size: cover; background-position: left top;" data-bg-src="{{ url('frontend/img/demos/renewable-energy/hero/hero-1.jpg') }}"></div>

                <div class="hero-el-1 bg-color-tertiary z-index-2"></div>
                <div class="hero-el-2 z-index-1"></div>

                <svg class="d-none d-lg-block z-index-3 custom-svg-position-1" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1686.88 1095.86" data-appear-animation-svg="true">
                    <path class="appear-animation" data-plugin-options="{'accY': -500, 'forceAnimation': true}" data-appear-animation="customLines1anim" data-appear-animation-delay="100" data-appear-animation-duration="7s" fill="none" stroke="#d8d8d8" stroke-width="2px" stroke-miterlimit="10" d="M87.95,1.4c6.82,9.14,15.53,21.59,24.68,36.94c6.82,11.45,27.18,46.82,42.55,96.51
                        c22.8,73.68,21.39,136.02,20.51,156c-3.11,70.56-22.16,122.51-36,159.32c-10.88,28.95-11.68,24.38-59.74,125.62
                        c-43.46,91.53-49.66,109.7-52.85,119.49C6.6,758.14,2.98,804.59,2.16,829.14c-1.49,44.72,4.54,70.82,6.47,78.64
                        c3.54,14.35,10.42,41.25,29.79,70.47c6.64,10.01,30.84,44.6,76.77,69.11c42.9,22.9,81.52,24.6,110.47,25.87
                        c45.57,2.01,79.98-6.18,113.02-14.3c30.83-7.58,58.4-18.38,113.53-40c59.55-23.35,66.43-28.58,110.47-43.91
                        c35.63-12.41,57.67-19.98,89.36-25.7c25.68-4.64,55.3-9.77,94.3-6.3c12.43,1.11,53.97,5.59,102.13,27.74
                        c32.05,14.74,53.03,30.87,57.53,34.38c24.26,18.91,41.05,38.65,51.91,53.45"/>
                    <path class="appear-animation" data-plugin-options="{'accY': -500, 'forceAnimation': true}" data-appear-animation="customLines1anim" data-appear-animation-delay="100" data-appear-animation-duration="7s" fill="none" stroke="#d8d8d8" stroke-width="2px" stroke-miterlimit="10" d="M119.44,34.42c8.99,12.85,20.33,30.49,31.66,52.43c26.28,50.9,36.35,93.84,39.15,106.55
                        c3.12,14.2,10.77,52.5,9.53,102.81c-0.28,11.19-2.03,65.48-23.83,133.79c-9.82,30.78-21.07,54.56-43.57,102.13
                        c-26.78,56.6-29.14,53.79-45.62,90.21c-19.84,43.85-42.56,94.07-48.68,161.02c-2.86,31.34-5.69,66.08,7.49,108.6
                        c6.03,19.44,20.95,65.45,64,101.11c47.45,39.3,101.05,42.8,133.79,44.94c63.04,4.12,115.57-13.6,165.11-30.3
                        c5.59-1.89,23.59-8.86,59.57-22.81c100.23-38.85,99.33-40.27,122.21-47.32c41.18-12.69,80.51-24.8,133.11-21.79
                        c19.83,1.14,63.01,5.65,111.66,28.94c8.19,3.92,50.6,24.68,88.51,64.34c5.66,5.92,10.38,11.39,12.6,13.96
                        c23.78,27.59,39.5,52.94,49.36,70.81"/>
                    <path class="appear-animation" data-plugin-options="{'accY': -500, 'forceAnimation': true}" data-appear-animation="customLines1anim" data-appear-animation-delay="100" data-appear-animation-duration="7s" fill="none" stroke="#d8d8d8" stroke-width="2px" stroke-miterlimit="10" d="M149.4,68.12c6.57,8.86,14.9,20.95,23.49,35.91c4.29,7.48,19.67,34.89,32.17,73.53
                        c6.72,20.77,21.93,69.22,20.6,133.28c-1.3,62.06-17.49,108.17-28.94,139.91c-10.84,30.08-24.93,58.75-53.11,116.09
                        c-20.68,42.08-23.94,45.72-33.7,69.11c-12.01,28.77-26.1,63.09-33.02,108.6c-5.01,32.91-10.64,69.92,1.7,115.4
                        c5.5,20.27,17.08,60.94,53.45,94.64c42.55,39.43,93.06,45.28,119.49,48.34c54.36,6.29,98.94-6.87,146.04-20.77
                        c14.56-4.3,31.27-10.58,64.68-23.15c90.64-34.09,94.12-40.57,133.45-51.74c33.81-9.61,71.69-20.37,122.21-16.68
                        c58.83,4.3,99.83,25.64,107.91,29.96c40.02,21.39,65.7,49.16,77.96,62.64c8.35,9.18,14.84,17.39,19.4,23.49"/>
                    <path class="appear-animation" data-plugin-options="{'accY': -500, 'forceAnimation': true}" data-appear-animation="customLines1anim" data-appear-animation-delay="100" data-appear-animation-duration="7s" fill="none" stroke="#d8d8d8" stroke-width="2px" stroke-miterlimit="10" d="M179.69,101.14c6.75,9.74,13.52,20.4,20.09,32c22.79,40.27,33.1,74.23,35.4,82.04
                        c5.33,18.08,15.6,58.21,14.64,110.3c-0.24,12.92-1.88,65.03-24.85,127.32c-3.1,8.42-7.74,18.89-17.02,39.83
                        c-25.65,57.88-36.57,75.11-52.43,110.3c-18.12,40.19-31.28,69.39-39.83,110.64c-7.2,34.73-15.41,74.33-2.38,122.21
                        c4.55,16.73,14.43,51.38,44.94,82.04c35.67,35.85,78.11,44.69,100.43,49.02c58.53,11.37,107.23-3.46,156.26-18.38
                        c24.42-7.44,15.93-6.77,86.47-33.7c103.46-39.5,129.97-44.06,142.98-45.96c28.7-4.18,61.65-8.66,103.15,1.02
                        c7.96,1.86,47.73,11.59,90.21,42.55c30.91,22.53,50.88,47.29,62.64,64.34"/>
                    <path class="appear-animation" data-plugin-options="{'accY': -500, 'forceAnimation': true}" data-appear-animation="customLines1anim" data-appear-animation-delay="100" data-appear-animation-duration="7s" fill="none" stroke="#d8d8d8" stroke-width="2px" stroke-miterlimit="10" d="M208.89,133.57c7.42,9.37,15.01,20.15,22.21,32.43c21.75,37.04,29.38,69.66,33.96,89.87
                        c4.69,20.73,13.92,63.26,7.4,117.96c-4.84,40.58-16.18,69.74-28.09,100.34c-11.91,30.61-15.38,31.76-42.38,89.11
                        c-24.66,52.37-36.99,78.56-44.68,105.45c-8.49,29.66-18.6,66.37-13.28,113.36c2.65,23.35,6.06,53.41,27.06,84
                        c28.75,41.87,70.98,56.35,86.81,61.53c35.79,11.71,65.37,8.99,93.19,6.13c15-1.54,44-5.54,139.91-42.38
                        c72.26-27.76,81.46-35.35,120.77-43.91c27.26-5.94,54.69-11.68,91.15-8.17c55.63,5.36,93.81,28.56,102.38,33.96
                        c36.12,22.73,57.57,50.99,66.38,62.81c3.86,5.17,6.88,9.63,8.94,12.77"/>
                </svg>	

                <div class="container-fluid position-relative z-index-3 h-100">
                    <div class="row px-lg-5 mx-lg-3 justify-content-between align-items-center h-100">
                        <div class="col-xl-5 text-center text-xl-end">
                            <h2 class="font-weight-bold text-color-light line-height-4 text-3 mb-2 text-uppercase appear-animation" data-appear-animation="fadeInUpShorterPlus" data-appear-animation-delay="800" data-plugin-options="{'minWindowWidth': 0}"><span class="opacity-6">UPT Laboratorium Lingkungan</span></h2>
                            <h1 class="text-color-light font-weight-bold text-8 negative-ls-05 line-height-1 mb-4 appear-animation" data-appear-animation="fadeInUpShorterPlus" data-appear-animation-delay="1100" data-plugin-options="{'minWindowWidth': 0}">Pontianak Laboratory Information System<br><span class="font-weight-extra-bold custom-highlight-1 ws-nowrap p-1 custom-highlight-anim custom-highlight-anim-delay">(POLIS)</span></h1>
                            <a href="/login" class="btn btn-arrow-effect-1 ws-nowrap text-light text-4 bg-transparent border-0 px-0 appear-animation" data-appear-animation="fadeInUpShorterPlus" data-appear-animation-delay="1300" data-plugin-options="{'minWindowWidth': 0}">Pesan Sekarang <i class="fas fa-arrow-right ms-2 p-relative top-2"></i></a>
                        </div>
                        <div class="col-xl-3 text-xl-end d-none d-xl-block">
                            <div class="row align-items-end pb-4">
                                <div class="col-6 ps-5">
                                    <div class="appear-animation" data-appear-animation="fadeInUpShorterPlus" data-appear-animation-delay="100" data-plugin-options="{'minWindowWidth': 0}">
                                        <img src="{{ url('frontend/img/lazy.png') }}" data-src="{{ url('frontend/img/icons/lab1.webp') }}" class="img-fluid border-radius lazyload">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="appear-animation" data-appear-animation="fadeInUpShorterPlus" data-appear-animation-delay="400" data-plugin-options="{'minWindowWidth': 0}">
                                        <img src="{{ url('frontend/img/lazy.png') }}" data-src="{{ url('frontend/img/icons/lab2.webp') }}" class="img-fluid border-radius lazyload">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="appear-animation" data-appear-animation="fadeInUpShorterPlus" data-appear-animation-delay="700" data-plugin-options="{'minWindowWidth': 0}">
                                        <img src="{{ url('frontend/img/lazy.png') }}" data-src="{{ url('frontend/img/icons/lab4.webp') }}" class="img-fluid border-radius lazyload">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="custom-el-pos-2">
                <div class="shape-divider shape-divider-bottom shape-divider-reverse-y z-index-6" style="bottom: -25px; opacity: 1;">
                    <div class="shape-divider-horizontal-animation shape-divider-horizontal-animation-to-right top-9" style="animation-duration: 60s;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 69">
                            <path d="M0,18C163.64,18,316.36,0,480,0S796.36,18,960,18,1276.36,0,1440,0s316.36,18,480,18V62H0Z" style="fill:#F7F7F7;" />
                        </svg>
                    </div>
                </div>

                <div class="shape-divider shape-divider-bottom shape-divider-reverse-y z-index-6" style="opacity: 0.7;">
                    <div class="shape-divider-horizontal-animation shape-divider-horizontal-animation-to-left top-9" style="animation-duration: 40s;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 69">
                            <path d="M0,21C163.64,21,316.36,3,480,3S796.36,21,960,21,1276.36,3,1440,3s316.36,18,480,18V65H0Z" style="fill:#F7F7F7;" />
                        </svg>
                    </div>
                </div>

                <div class="shape-divider shape-divider-bottom shape-divider-reverse-y z-index-6" style="opacity: 0.5;">
                    <div class="shape-divider-horizontal-animation shape-divider-horizontal-animation-to-right top-9" style="animation-duration: 25s;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 69">
                            <path d="M0,18C163.64,18,316.36,0,480,0S796.36,18,960,18,1276.36,0,1440,0s316.36,18,480,18V62H0Z" style="fill:#F7F7F7;" />
                        </svg>
                    </div>
                </div>
            </div>
        </section>

        <section class="section my-0 py-2 border-0 bg-color-grey">
            <div class="container container-xl-custom pb-3">
                <div class="row py-2 pb-4">
                    <div class="col-lg-4">
                        <div class="card border-0 bg-color-light box-shadow-1 box-shadow-1-hover anim-hover-translate-top-10px transition-3ms pb-5">
                            <div class="card-body text-center text-lg-start m-2 appear-animation" data-appear-animation="fadeInUpShorterPlus" data-appear-animation-delay="100" data-plugin-options="{'minWindowWidth': 0}">
                                <img height="90" src="{{ url('frontend/img/demos/event/icons/successfull-stories.svg') }}" alt="" data-icon data-plugin-options="{'onlySVG': true, 'extraClass': 'svg-stroke-color-primary mb-4'}" />
                                <h4 class="font-weight-bold mt-4">Visi & Misi</h4>
                                <div class="row pt-4">
                                    <div class="col-6">     

                                        <button type="button" class="btn btn-outline btn-primary btn-lg mb-2" data-bs-toggle="modal" data-bs-target="#visi">
                                            Visi
                                        </button>
                                    </div>
                                    <div class="col-6">     

                                        <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#misi">
                                            Misi
                                        </button>
                                    </div>
                                </div>

                                <hr>
                            </div>
                        </div>
                    </div>
    
                    <div class="col-lg-4">
                        <div class="card border-0 bg-color-light box-shadow-1 box-shadow-1-hover anim-hover-translate-top-10px transition-3ms">
                            <div class="card-body text-center text-lg-start m-2 appear-animation" data-appear-animation="fadeInUpShorterPlus" data-appear-animation-delay="1200" data-plugin-options="{'minWindowWidth': 0}">
                                <img height="90" src="{{ url('frontend/img/demos/renewable-energy/icons/icon-5.svg') }}" alt="" data-icon data-plugin-options="{'onlySVG': true, 'extraClass': 'svg-stroke-color-primary mb-4'}" />
                                <h4 class="font-weight-bold mt-4">Motto</h4>
                                <p class="text-3">
                                    {{ $beranda->motto }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card border-0 bg-color-light box-shadow-1 box-shadow-1-hover anim-hover-translate-top-10px transition-3ms">
                            <div class="card-body text-center text-lg-start m-2 appear-animation" data-appear-animation="fadeInUpShorterPlus" data-appear-animation-delay="400" data-plugin-options="{'minWindowWidth': 0}">
                                <img height="90" src="{{ url('frontend/img/demos/event/icons/event-editions.svg') }}" alt="" data-icon data-plugin-options="{'onlySVG': true, 'extraClass': 'svg-stroke-color-primary mb-4'}" />
                                <h4 class="font-weight-bold mt-4">Maklumat Pelayanan</h4>
                                <p class="text-3" style="text-align: justify">
                                    {{ $beranda->maklumat_pelayanan }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- modal --}}
        <div class="modal fade" id="visi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Visi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ $beranda->visi }}
                </div>
            </div>
            </div>
        </div>

        <div class="modal fade" id="misi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Misi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ol>
                        <li>{{ $beranda->misi1 }}</li>
                        <li>{{ $beranda->misi2 }}</li>
                        <li>{{ $beranda->misi3 }}</li>
                        <li>{{ $beranda->misi4 }}</li>
                    </ol>
                </div>
            </div>
            </div>
        </div>
        
        <section class="section my-0 pt-2 pb-5 border-0 bg-transparent">
            <div class="container container-xl-custom">
                <div class="row align-items-center justify-content-around mt-4">
                    <div class="col-lg-5 text-end p-relative pt-2 max-width-custom-1">
                        <div class="p-absolute right-0">
                            <div data-plugin-float-element data-plugin-options="{'startPos': 'top', 'speed': 10.0, 'transition': true, 'transitionDuration': 1000}">
                                <img width="470" height="451" src="{{ url('frontend/img/demos/business-consulting-5/svg/icon-bg-1.svg') }}" alt="" data-icon data-plugin-options="{'onlySVG': true, 'extraClass': ''}" />
                            </div>
                        </div>
                        <div data-plugin-float-element data-plugin-options="{'startPos': 'bottom', 'speed': 10.0, 'transition': true, 'transitionDuration': 1000}">
                            <img width="376" height="350" src="{{ url('frontend/img/icons/accounting-auditor-4.svg') }}" alt="" data-icon data-plugin-options="{'onlySVG': true, 'extraClass': 'svg-fill-color-primary mt-5 pt-5'}" />
                        </div>
                    </div>
                    <div class="col-lg-4 text-center text-lg-start">
                        <h3 class="mt-5 pt-4">{{ $beranda->judul1 }}</h3>
                        <p>{{ $beranda->isi1 }}</p>
                    </div>
                </div>
                <div class="row align-items-center justify-content-around mt-5">
                    <div class="col-lg-4 text-center text-lg-start">
                        <h3 class="mt-5 pt-4">{{ $beranda->judul2 }}</h3>
                        <p>{{ $beranda->isi2 }}</p>
                    </div>
                    <div class="col-lg-5 p-relative pt-5 max-width-custom-1">
                        <div class="p-absolute left-0">
                            <div data-plugin-float-element data-plugin-options="{'startPos': 'top', 'speed': 10.0, 'transition': true, 'transitionDuration': 1000}">
                                <img width="470" height="451" src="{{ url('frontend/img/demos/business-consulting-5/svg/icon-bg-2.svg') }}" alt="" data-icon data-plugin-options="{'onlySVG': true, 'extraClass': ''}" />
                            </div>
                        </div>
                        <div data-plugin-float-element data-plugin-options="{'startPos': 'bottom', 'speed': 10.0, 'transition': true, 'transitionDuration': 1000}">
                            <img width="376" height="350" src="{{ url('frontend/img/icons/accounting-auditor-3.svg') }}" alt="" data-icon data-plugin-options="{'onlySVG': true, 'extraClass': 'svg-fill-color-secondary mt-5 pt-5'}" />
                        </div>
                    </div>
                </div>
                <div class="row align-items-center justify-content-around mt-5">
                    <div class="col-lg-5 text-end p-relative pt-5 max-width-custom-1">
                        <div class="p-absolute right-0">
                            <div data-plugin-float-element data-plugin-options="{'startPos': 'top', 'speed': 10.0, 'transition': true, 'transitionDuration': 1000}">
                                <img width="470" height="451" src="{{ url('frontend/img/demos/business-consulting-5/svg/icon-bg-1.svg') }}" alt="" data-icon data-plugin-options="{'onlySVG': true, 'extraClass': ''}" />
                            </div>
                        </div>
                        <div data-plugin-float-element data-plugin-options="{'startPos': 'bottom', 'speed': 10.0, 'transition': true, 'transitionDuration': 1000}">
                            <img width="376" height="350" src="{{ url('frontend/img/icons/accounting-auditor-1.svg') }}" alt="" data-icon data-plugin-options="{'onlySVG': true, 'extraClass': 'svg-fill-color-primary mt-5 pt-5'}" />
                        </div>
                    </div>
                    <div class="col-lg-4 text-center text-lg-start">
                        <h3 class="mt-5 pt-4">{{ $beranda->judul3 }}</h3>
                        <p>{{ $beranda->isi3 }}</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="section section-text-light section-center border-0 bg-color bg-color-dark my-0">
            <div class="container position-relative">
                <div class="row py-5 counters counters-text-light">
                    <div class="col-sm-6 col-lg-3 mb-4 mb-lg-0">
                        <div class="counter">
                            <img width="44" height="50" src="{{ url('frontend/img/demos/event/icons/event-editions.svg') }}" alt="" data-icon data-plugin-options="{'onlySVG': true, 'extraClass': 'svg-fill-color-light d-inline-block p-relative bottom-1'}" />
                            <strong class="pt-3 custom-font-secondary font-weight-bold" data-to="{{ $sertifikat_pengujian }}" data-append="">{{ $sertifikat_pengujian }}</strong>
                            <label class="pt-2 text-4">Sertifikat Uji</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 mb-4 mb-lg-0">
                        <div class="counter">
                            <img width="60" height="50" src="{{ url('frontend/img/demos/event/icons/event-visitors.svg') }}" alt="" data-icon data-plugin-options="{'onlySVG': true, 'extraClass': 'd-inline-block p-relative bottom-1'}" />
                            <strong class="pt-3 custom-font-secondary font-weight-bold" data-to="{{ $pelanggan }}" data-append="">{{ $pelanggan }}</strong>
                            <label class="pt-2 text-4">Pelanggan</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 mb-4 mb-sm-0">
                        <div class="counter">
                            <img width="46" height="50" src="{{ url('frontend/img/demos/event/icons/successfull-stories.svg') }}" alt="" data-icon data-plugin-options="{'onlySVG': true, 'extraClass': 'svg-fill-color-light d-inline-block p-relative bottom-1'}" />
                            <strong class="pt-3 custom-font-secondary font-weight-bold" data-to="{{ $sampel_total }}" data-append="">{{ $sampel_total }}</strong>
                            <label class="pt-2 text-4">Sampel Pengujian</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="counter">
                            <img width="41" height="50" src="{{ url('frontend/img/demos/event/icons/Picture1.svg') }}" alt="" data-icon data-plugin-options="{'onlySVG': true, 'extraClass': 'd-inline-block p-relative bottom-1'}" />
                            <strong class="pt-3 custom-font-secondary font-weight-bold" data-to="{{ $total_order }}" data-append="">{{ $total_order }}</strong>
                            <label class="pt-2 text-4">Total Order</label>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- jam layanan --}}
        <section class="border-0 p-relative">

            <div class="container">
                <div class="row pt-5 pb-2">
                    <div class="col-md-8">
                        <h3 class="font-weight-semibold text-9 text-capitalize mb-2">JAM PELAYANAN</h3>
                        <div class="divider divider-small mt-0 mb-4">
                            <hr class="bg-primary">
                        </div>
                    </div>

                        <img src="{{ url('frontend/jam1.png') }}" alt="">
                    
                </div>
            </div>

        </section>


        <section class="section section-with-shape-divider border-0 m-0">
            <div class="shape-divider shape-divider-reverse-x" style="height: 120px;">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 2000 120" preserveAspectRatio="xMinYMin">
                    <polygon fill="#FFF" points="-11,2 693,112 2019,6 2019,135 -11,135 "/>
                </svg>
            </div>
            <div class="shape-divider shape-divider-bottom shape-divider-reverse-y" style="height: 120px;">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 2000 120" preserveAspectRatio="xMinYMin">
                    <polygon fill="#FFF" points="-11,2 693,112 2019,6 2019,135 -11,135 "/>
                </svg>
            </div>
            <div class="container py-5 my-5">
                <div class="row mb-5">
                    <div class="col">
                        <div class="overflow-hidden">
                            <h2 class="text-color-primary font-weight-medium positive-ls-3 text-4 mb-0 appear-animation" data-appear-animation="maskUp" data-appear-animation-delay="200">TESTIMONIALS</h2>
                        </div>
                        <div class="overflow-hidden mb-3">
                            <h3 class="font-weight-bold text-transform-none text-9 line-height-2 mb-0 appear-animation" data-appear-animation="maskUp" data-appear-animation-delay="400">Apa kata mereka?</h3>
                        </div>
                        <p class="custom-font-secondary custom-font-size-1 line-height-7 mb-0 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="600"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="750">
                        <div class="owl-carousel nav-style-1 nav-svg-arrows-1 nav-dark" data-plugin-options="{'responsive': {'0': {'items': 1}, '476': {'items': 2}, '768': {'items': 2}, '992': {'items': 2}, '1200': {'items': 2}}, 'autoplay': true, 'autoplayTimeout': 5000, 'autoplayHoverPause': true, 'dots': false, 'nav': true, 'loop': true, 'margin': 60, 'stagePadding': 50}">
                            @forelse ($testimoni as $t)
                            <div>
                                <div class="custom-testimonial-style-1 testimonial testimonial-style-3">
                                    <blockquote>
                                        <p class="mb-0">{{ $t->komentar }}</p>
                                    </blockquote>
                                    <div class="testimonial-author">
                                        <div class="testimonial-author-thumbnail">
                                            <img src="{{ url('admin/img/user.png') }}" class="img-fluid rounded-circle" alt="">
                                        </div>
                                        <p class="ms-3"><strong class="font-weight-semibold text-color-dark text-4">{{ $t->user->name }}</strong></p>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div>
                                <div class="custom-testimonial-style-1 testimonial testimonial-style-3">
                                    <blockquote>
                                        <p class="mb-0">Dengan adanya layanan website ini sangat memudahkan kami dalam proses pelayanan..</p>
                                    </blockquote>
                                    <div class="testimonial-author">
                                        <div class="testimonial-author-thumbnail">
                                            <img src="{{ url('admin/img/user.png') }}" class="img-fluid rounded-circle" alt="">
                                        </div>
                                        <p class="ms-3"><strong class="font-weight-semibold text-color-dark text-4">Egy Hanif</strong></p>
                                    </div>
                                </div>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section my-0 py-3 border-0 bg-transparent">
            <div id="tentang" class="container container-xl-custom pt-2 pb-3">
                <div class="row py-5">
                    <div class="col-lg-6 pt-5">
                        <h3 class="mb-3">QNA ~ POLIS</h3>
                        <p class="mb-4 pb-2">Seputar pertanyaan terkait Aplikasi POLIS...</p>

                        <div class="hstack gap-4 pt-3">
                            <div>
                                <a href="#" class="btn btn-modern btn-primary font-weight-bold border-0 py-3 px-5 btn-arrow-effect-1 ws-nowrap">Ada Pertanyaan?<i class="fab fa-whatsapp ms-2"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-5 mt-lg-0">
                        <div class="accordion accordion-modern-status accordion-modern-status-primary" id="accordion100">
                            <div class="card card-default">
                                <div class="card-header" id="collapse100HeadingOne">
                                    <h4 class="card-title m-0">
                                        <a class="accordion-toggle text-color-dark font-weight-bold border-radius text-3-5 collapsed" data-bs-toggle="collapse" data-bs-target="#collapse100One" aria-expanded="false" aria-controls="collapse100One">
                                            {{ $beranda->pertanyaan1 }}
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse100One" class="collapse" aria-labelledby="collapse100HeadingOne" data-bs-parent="#accordion100">
                                    <div class="card-body">
                                        <p class="mb-0">{{ $beranda->jawaban1 }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-default">
                                <div class="card-header" id="collapse100HeadingTwo">
                                    <h4 class="card-title m-0">
                                        <a class="accordion-toggle text-color-dark font-weight-bold border-radius text-3-5 collapsed" data-bs-toggle="collapse" data-bs-target="#collapse100Two" aria-expanded="false" aria-controls="collapse100Two">
                                            {{ $beranda->pertanyaan2 }}
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse100Two" class="collapse" aria-labelledby="collapse100HeadingTwo" data-bs-parent="#accordion100">
                                    <div class="card-body">
                                        <p class="mb-0">{{ $beranda->jawaban2 }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-default">
                                <div class="card-header" id="collapse100HeadingThree">
                                    <h4 class="card-title m-0">
                                        <a class="accordion-toggle text-color-dark font-weight-bold border-radius text-3-5 collapsed" data-bs-toggle="collapse" data-bs-target="#collapse100Three" aria-expanded="false" aria-controls="collapse100Three">
                                            {{ $beranda->pertanyaan3 }}
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse100Three" class="collapse" aria-labelledby="collapse100HeadingThree" data-bs-parent="#accordion100">
                                    <div class="card-body">
                                        <p class="mb-0">{{ $beranda->jawaban3 }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-default">
                                <div class="card-header" id="collapse100HeadingFour">
                                    <h4 class="card-title m-0">
                                        <a class="accordion-toggle text-color-dark font-weight-bold border-radius text-3-5 collapsed" data-bs-toggle="collapse" data-bs-target="#collapse100Four" aria-expanded="false" aria-controls="collapse100Four">
                                            {{ $beranda->pertanyaan4 }}
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse100Four" class="collapse" aria-labelledby="collapse100HeadingFour" data-bs-parent="#accordion100">
                                    <div class="card-body">
                                        <p class="mb-0">{{ $beranda->jawaban4 }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="border-0 p-relative">

            <div class="container">
                <div class="row pb-4">
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