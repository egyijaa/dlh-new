@extends('layouts.admin')
@section('content')

<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Order Pengambilan Sampel (Selesai)</h4>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header justify-content-between d-flex d-inline">
                        <h4 class="card-title">Order Pengambilan Sampel (Selesai)</h4>
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
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach($pengambilan as $p)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $p->nomor_pre }}</td>
                                        <td>{{ $p->nama_pemesan }}</td>
                                        <td>{{ date('d M Y', strtotime($p->tanggal_isi)) }}</td>
                                        <td><span class="
                                            @if($p->id_status_pengambilan_sampel == 1 || $p->id_status_pengambilan_sampel == 5 || $p->id_status_pengambilan_sampel == 5 || $p->id_status_pengambilan_sampel == 6 || $p->id_status_pengambilan_sampel == 7 || $p->id_status_pengambilan_sampel == 8)
                                            badge badge-primary
                                            @elseif ($p->id_status_pengambilan_sampel == 4 || $p->id_status_pengambilan_sampel == 9)
                                            badge badge-success
                                            @elseif ($p->id_status_pengambilan_sampel == 3)
                                            badge badge-danger
                                            @else 
                                            badge badge-warning
                                            @endif
                                            ">{{ $p->statusPengambilanSampel->status_pelanggan }}</span>
                                        
                                        @if ($p->id_status_pengambilan_sampel >= 5)
                                        <span class="badge badge-success my-1">Sudah Bayar</span>
                                        @endif
                                        <br>
                                        <a href="{{ route('pelanggan.pengambilanSampelSelesai.tracking', $p->id) }}"><i class="fas fa-angle-double-right" style="font-size: 11px">Tracking</i></a>
                                        </td>
                                        <td>@currency($p->total_harga)</td>
                                        <td>
                                            <a href="{{ route('pelanggan.pengambilanSampelSelesai.detailOrder', $p->id) }}" class="btn btn-info btn-sm mt-1">Detail Order</a>
                                    
                                            @if ($p->statusPengambilanSampel->id >= 4)
                                            <a href="{{ route('pelanggan.pengambilanSampelSelesai.showInvoice', $p->id) }}"><i class="btn btn-sm btn-primary shadow-sm my-1">Lihat Invoice</i></a> 
                                            @endif
                                            @if ($p->foto_ba1 && $p->foto_ba2)
                                            <a href="{{ route('pelanggan.pengambilanSampelSelesai.cetakBaPelanggan', $p->id) }}" target="_blank"><i class="btn btn-sm btn-primary shadow-sm my-2">PDF Berita Acara</i></a> 
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