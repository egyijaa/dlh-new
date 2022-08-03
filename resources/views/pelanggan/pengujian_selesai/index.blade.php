@extends('layouts.admin')
@section('content')

<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Order Pengujian (Selesai)</h4>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header justify-content-between d-flex d-inline">
                        <h4 class="card-title">Order Pengujian (Selesai)</h4>
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
                                        <th style="width: 25%">Aksi</th>
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
                                        <td>{{Str::limit($p->nama_pemesan, 20)}}</td>
                                        <td>{{ date('d M Y', strtotime($p->tanggal_isi)) }}</td>
                                        <td><span class="
                                            @if($p->id_status_pengujian == 1 || $p->id_status_pengujian == 5 || $p->id_status_pengujian == 5 || $p->id_status_pengujian == 6 || $p->id_status_pengujian == 7 || $p->id_status_pengujian == 8 || $p->id_status_pengujian == 9 || $p->id_status_pengujian == 10 || $p->id_status_pengujian == 11 || $p->id_status_pengujian == 12 || $p->id_status_pengujian == 13)
                                            badge badge-primary mt-1
                                            @elseif ($p->id_status_pengujian == 4)
                                            badge badge-success mt-1
                                            @elseif ($p->id_status_pengujian == 3)
                                            badge badge-danger mt-1
                                            @else 
                                            badge badge-warning mt-1
                                            @endif
                                            ">{{ $p->statusPengujian->status_pelanggan }}</span>
                                        <hr class="my-1">
                                        @if ($p->id_status_pengujian >= 5)
                                        <span class="badge badge-success my-1">Sudah Bayar</span> |
                                        @endif
                                        <a href="{{ route('pelanggan.pengujianSelesai.tracking', $p->id) }}"><i class="fas fa-angle-double-right my-1" style="font-size: 11px">Tracking</i></a>
                                        </td>
                                        <td>@currency($p->total_harga)</td>
                                        <td>
                                           <form action="{{ route('pelanggan.pengujianSelesai.sampel') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id_order" value="{{ $p->id }}">
                                                <button type="submit" class="btn btn-primary btn-xs mt-1">
                                                    @if ($p->statusPengujian->id == 1)
                                                        Pilih
                                                    @else
                                                        Lihat
                                                    @endif
                                                    Sampel</button>
                                            </form> 
                                            <a href="{{ route('pelanggan.pengujianSelesai.detailOrder', $p->id) }}" class="btn btn-info btn-xs my-1">Detail Order</a>

                                            @if ($p->statusPengujian->id >= 4)
                                            <a href="{{ route('pelanggan.pengujianSelesai.showInvoice', $p->id) }}"><i class="btn btn-xs btn-primary shadow-sm my-1">Lihat Invoice</i></a> 
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