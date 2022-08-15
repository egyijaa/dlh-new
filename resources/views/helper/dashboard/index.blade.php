@extends('layouts.admin')
@section('content')

<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Dashboard</h4>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-primary card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="flaticon-users"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Pelanggan yang belum diverif</p>
                                    <h4 class="card-title">{{ $pelanggan }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-info card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="flaticon-interface-6"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Sampel</p>
                                    <h4 class="card-title">{{ $sampel }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-success card-round">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="flaticon-analytics"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Pendapatan Total</p>
                                    @php
                                        $pendapatan_total = $pendapatan_pengujian + $pendapatan_pengambilan;
                                    @endphp

                                    <h4 class="card-title">@currency($pendapatan_total)</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-secondary card-round">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="flaticon-success"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Sertifikat</p>
                                    <h4 class="card-title">{{ $sertifikat }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
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
                                            <div class="card-title">Orderan yg Perlu dicek</div>
                                        </div>
                                        <div class="card-body">
                                            <div class="overflow-auto" style="height:300px;
                                            overflow-y: scroll;">
                                            <ol class="activity-feed">
                                                @forelse ($cek_pengambilan as $cp)
                                                <li class="feed-item feed-item-info">
                                                    <time class="date">{{ $cp->updated_at->diffForHumans() }}</time>
                                                    <span class="text">Orderan {{ $cp->nomor_pre }}</span> <br>
                                                    <span class="text"> <a href="{{ route('helper.pengambilanSampel.detailOrder', $cp->id) }}" class="btn btn-xs btn-info shadow-sm my-1">
                                                        <i class="fas fa-pencil fa-sm text-white-50"></i>Detail order
                                                    </a></span>
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
                                <div class="col-md-3">
                                    <div class="card full-height">
                                        <div class="card-header">
                                            <div class="card-title">Notif Pembayaran Masuk</div>
                                        </div>
                                        <div class="card-body">
                                            <div class="overflow-auto" style="height:300px;
                                            overflow-y: scroll;">
                                            <ol class="activity-feed">
                                                @forelse ($info_bayar_pengambilan as $pengambilan)
                                                <li class="feed-item feed-item-info">
                                                    <time class="date">{{ $pengambilan->updated_at->diffForHumans() }}</time>
                                                    <span class="text">Orderan {{ $pengambilan->nomor_pre }}</span> <br>
                                                    <span class="text">Ada Mengirim Bukti Pembayaran
                                                    </span>
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
                                                        <p class="card-category">Pendapatan</p>
                                                        <h4 class="card-title">@currency($pendapatan_pengambilan)</h4>
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
                                            <div class="card-title">Orderan yg Perlu dicek</div>
                                        </div>
                                        <div class="card-body">
                                            <div class="overflow-auto" style="height:300px;
                                            overflow-y: scroll;">
                                            <ol class="activity-feed">
                                                @forelse ($cek_pengujian as $cpu)
                                                <li class="feed-item feed-item-info">
                                                    <time class="date">{{ $cpu->updated_at->diffForHumans() }}</time>
                                                    <span class="text">Orderan {{ $cpu->nomor_pre }}</span> <br>
                                                    <span class="text"></span>
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
                                <div class="col-md-3">
                                    <div class="card full-height">
                                        <div class="card-header">
                                            <div class="card-title">Notif Pembayaran Masuk</div>
                                        </div>
                                        <div class="card-body">
                                            <div class="overflow-auto" style="height:300px;
                                            overflow-y: scroll;">
                                            <ol class="activity-feed">
                                                @forelse ($info_bayar_pengujian as $pengujian)
                                                <li class="feed-item feed-item-info">
                                                    <time class="date">{{ $pengujian->updated_at->diffForHumans() }}</time>
                                                    <span class="text">Orderan {{ $pengujian->nomor_pre }}</span> <br>
                                                    <span class="text">Ada Mengirim Bukti Pembayaran
                                                    </span>
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
                                                        <p class="card-category">Pendapatan</p>
                                                        <h4 class="card-title">@currency($pendapatan_pengujian)</h4>
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
    </div>
</div>
@endsection