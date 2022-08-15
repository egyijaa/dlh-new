@extends('layouts.admin')
@section('content')

<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Orderan Pengambilan Sampel</h4>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header justify-content-between d-flex d-inline">
                        <h4 class="card-title">Orderan Pengambilan Sampel</h4>
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
                                    @foreach($pengambilan as $p)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $p->nomor_pre }}</td>
                                        <td>{{ $p->nama_pemesan }}</td>
                                        <td>{{ date('d M Y', strtotime($p->tanggal_isi)) }}</td>
                                        <td>
                                            <span class="
                                            @if($p->id_status_pengambilan_sampel == 1 || $p->id_status_pengambilan_sampel == 5 || $p->id_status_pengambilan_sampel == 6 || $p->id_status_pengambilan_sampel == 7 || $p->id_status_pengambilan_sampel == 8)
                                            badge badge-primary mt-1
                                            @elseif ($p->id_status_pengambilan_sampel == 4 || $p->id_status_pengambilan_sampel == 9)
                                            badge badge-success mt-1
                                            @elseif ($p->id_status_pengambilan_sampel == 3)
                                            badge badge-danger mt-1
                                            @else 
                                            badge badge-warning mt-1
                                            @endif
                                            ">{{ $p->statusPengambilanSampel->status_admin }}</span>


                                        @if ($p->bukti_bayar)
                                        <hr class="my-1">
                                        @if ($p->id_status_pengambilan_sampel >= 5)
                                        <span class="badge badge-success mb-1">Sudah Bayar</span>
                                        @endif
                                        @endif
                                        </td>
                                        <td>@currency($p->total_harga)</td>
                                        <td>
                                            <a href="{{ route('helper.pengambilanSampel.detailOrder', $p->id) }}" class="btn btn-xs btn-info shadow-sm my-1">
                                                <i class="fas fa-pencil fa-sm text-white-50"></i>Detail order
                                            </a>
                                            
                                            @if ($p->id_status_pengambilan_sampel >= 5)
                                            <a href="{{ route('helper.pengambilanSampel.beritaAcara', $p->id) }}" class="btn btn-xs btn-primary shadow-sm my-1">
                                                <i class="fas fa-pencil fa-sm text-white-50"></i>Berita Acara
                                            </a> 
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
<script>
    
</script>
@endpush