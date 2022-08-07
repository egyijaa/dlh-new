@extends('layouts.admin')
@section('content')

<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Selamat Datang {{ auth()->user()->name }}</h4>
        </div>
        @if (auth()->user()->aktivasi == 0)
            <h5>Mohon menunggu akun anda diverifikasi oleh admin untuk bisa menggunakan layanan kami. <br> Silahkan Cek email anda untuk melihat konfirmasi aktivasi akun anda. Terima Kasih</h5>
        @else
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Dashboard</h4>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-pills nav-secondary  nav-pills-no-bd nav-pills-icons justify-content-center" id="pills-tab-with-icon" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-home-tab-icon" data-toggle="pill" href="#pills-home-icon" role="tab" aria-controls="pills-home-icon" aria-selected="true">
                                    <i class="flaticon-layers-1"></i>
                                    Pengambilan Sampel
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-profile-tab-icon" data-toggle="pill" href="#pills-profile-icon" role="tab" aria-controls="pills-profile-icon" aria-selected="false">
                                    <i class="flaticon-list"></i>
                                    Pengujian
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content mt-2 mb-3" id="pills-with-icon-tabContent">
                            <div class="tab-pane fade show active" id="pills-home-icon" role="tabpanel" aria-labelledby="pills-home-tab-icon">
                                <hr>
                                <h2>Pengambilan Sampel</h2>
                               <div class="row">
                                <div class="col-md-3">
                                    <div class="card full-height">
                                        <div class="card-header">
                                            <div class="card-title">Notifikasi</div>
                                        </div>
                                        <div class="card-body">
                                            <div class="overflow-auto" style="height:300px;
                                            overflow-y: scroll;">
                                            <ol class="activity-feed">
                                                @forelse ($timeline_pengambilan as $pengambilan)
                                                <li class="feed-item feed-item-info">
                                                    <time class="date">{{ $pengambilan->created_at->diffForHumans() }}</time>
                                                    <span class="text"><u>{{ $pengambilan->pengambilanSampelOrder->nomor_pre }}</u></span> <br>
                                                    <span class="text">{{ $pengambilan->statusPengambilanSampel->status_pelanggan }}</span>
                                                </li>
                                                @empty
                                                <p class="text-center">Tidak ada notifikasi</p>
                                                <hr>
                                                @endforelse
                                            </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="card card-stats card-primary card-round">
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-5">
                                                    <div class="icon-big text-center">
                                                        <i class="flaticon-chart-pie"></i>
                                                    </div>
                                                </div>
                                                <div class="col-7 col-stats">
                                                    <div class="numbers">
                                                        <p class="card-category">Order baru</p>
                                                        <h4 class="card-title">{{ $pengambilan_baru }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="card card-stats card-warning card-round">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-5">
                                                    <div class="icon-big text-center">
                                                        <i class="flaticon-coins text-success"></i>
                                                    </div>
                                                </div>
                                                <div class="col-7 col-stats">
                                                    <div class="numbers">
                                                        <p class="card-category">Belum Bayar</p>
                                                        <h4 class="card-title">{{ $pengambilan_belum_bayar }}</h4> orderan
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="card card-stats card-success card-round">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-5">
                                                    <div class="icon-big text-center">
                                                        <i class="flaticon-success"></i>
                                                    </div>
                                                </div>
                                                <div class="col-7 col-stats">
                                                    <div class="numbers">
                                                        <p class="card-category">Order Selesai</p>
                                                        <h4 class="card-title">{{ $pengambilan_selesai }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               </div>
                            </div>
                            <div class="tab-pane fade" id="pills-profile-icon" role="tabpanel" aria-labelledby="pills-profile-tab-icon">
                               <hr>
                               <h2>Pengujian</h2>
                               <div class="row">
                                <div class="col-md-3">
                                    <div class="card full-height">
                                        <div class="card-header">
                                            <div class="card-title">Notifikasi</div>
                                        </div>
                                        <div class="card-body">
                                            <div class="overflow-auto" style="height:300px;
                                            overflow-y: scroll;">
                                            <ol class="activity-feed">
                                                @forelse ($timeline_pengujian as $pengujian)
                                                <li class="feed-item feed-item-info">
                                                    <time class="date">{{ $pengujian->created_at->diffForHumans() }}</time>
                                                    <span class="text"><u>{{ $pengujian->pengujianOrder->nomor_pre }}</u></span> <br>
                                                    <span class="text">{{ $pengujian->statusPengujian->status_pelanggan }}</span>
                                                </li>
                                                @empty
                                                <p class="text-center">Tidak ada notifikasi</p>
                                                <hr>
                                                @endforelse
                                            </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="card card-stats card-primary card-round">
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-5">
                                                    <div class="icon-big text-center">
                                                        <i class="flaticon-chart-pie"></i>
                                                    </div>
                                                </div>
                                                <div class="col-7 col-stats">
                                                    <div class="numbers">
                                                        <p class="card-category">Order baru</p>
                                                        <h4 class="card-title">{{ $pengujian_baru }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="card card-stats card-warning card-round">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-5">
                                                    <div class="icon-big text-center">
                                                        <i class="flaticon-coins text-success"></i>
                                                    </div>
                                                </div>
                                                <div class="col-7 col-stats">
                                                    <div class="numbers">
                                                        <p class="card-category">Belum Bayar</p>
                                                        <h4 class="card-title">{{ $pengujian_belum_bayar }}</h4> orderan
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="card card-stats card-success card-round">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-5">
                                                    <div class="icon-big text-center">
                                                        <i class="flaticon-success"></i>
                                                    </div>
                                                </div>
                                                <div class="col-7 col-stats">
                                                    <div class="numbers">
                                                        <p class="card-category">Order Selesai</p>
                                                        <h4 class="card-title">{{ $pengujian_selesai }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection