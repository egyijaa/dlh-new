@extends('layouts.admin')
@section('content')

<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Orderan Pengujian</h4>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header justify-content-between d-flex d-inline">
                        <h4 class="card-title">Orderan Pengujian</h4>
                      </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover" >
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No. Order</th>
                                        <th>Nama</th>
                                        <th>Tanggal Order</th>
                                        <th>Status</th>
                                        <th>Sub Total</th>
                                        <th style="width: 30%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach($pengujian as $p)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $p->nomor_pre }}</td>
                                        <td>{{ $p->nama_pemesan }}</td>
                                        <td>{{ date('d M Y', strtotime($p->tanggal_isi)) }}</td>
                                        <td>
                                            <span class="
                                            @if($p->id_status_pengujian == 1 || $p->id_status_pengujian == 5 || $p->id_status_pengujian == 5 || $p->id_status_pengujian == 6 || $p->id_status_pengujian == 7 || $p->id_status_pengujian == 8 || $p->id_status_pengujian == 9 || $p->id_status_pengujian == 10 || $p->id_status_pengujian == 11 || $p->id_status_pengujian == 12)
                                            badge badge-primary mt-1
                                            @elseif ($p->id_status_pengujian == 4 || $p->id_status_pengujian == 13)
                                            badge badge-success mt-1
                                            @elseif ($p->id_status_pengujian == 3)
                                            badge badge-danger mt-1
                                            @else 
                                            badge badge-warning mt-1
                                            @endif
                                            ">{{ $p->statusPengujian->status_admin }}</span>
                                        @if ($p->bukti_bayar)
                                        <hr class="my-1">
                                        @if ($p->id_status_pengujian >= 5)
                                        <span class="badge badge-success mb-1">Sudah Bayar</span>
                                        @endif
                                        <a href="{{ route('admin.pengujianSelesai.showBuktiPembayaran', $p->id) }}" class="btn btn-primary btn-xs mb-2">Lihat Bukti Pembayaran</a>
                                        @endif
                                        </td>
                                        <td>@currency($p->total_harga)</td>
                                        <td>
                                            <a href="{{ route('admin.pengujianSelesai.detailOrder', $p->id) }}" class="btn btn-xs btn-info shadow-sm my-1">
                                                <i class="fas fa-pencil fa-sm text-white-50"></i>Detail order
                                            </a>
                                            <a href="{{ route('admin.pengujianSelesai.getOrder', $p->id) }}" class="btn btn-xs btn-primary shadow-sm my-1">
                                                <i class="fas fa-pencil fa-sm text-white-50"></i>Lihat Sampel
                                            </a>
                                            @if ($p->id_status_pengujian >= 4)
                                            <a href="{{ route('admin.pengujianSelesai.cetakInvoice', $p->id) }}" target="_blank"><i class="btn btn-xs my-1 btn-primary shadow-sm">Lihat  Invoice</i></a> 
                                            <a href="{{ route('admin.pengujianSelesai.cetakSkr', $p->id) }}" target="_blank"><i class="btn btn-xs my-1 btn-primary shadow-sm">Cetak SKR</i></a> 
                                            @endif
                                            @if ($p->id_status_pengujian >= 5)
                                            <a href="{{ route('admin.pengujianSelesai.cetakTbp', $p->id) }}" target="_blank"><i class="btn btn-xs btn-primary my-1 shadow-sm">Cetak TBP</i></a> 
                                            @endif

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
@endpush