@extends('layouts.admin')
@section('content')

<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <a href="{{ route('pelanggan.pengambilanSampelSelesai.index') }}"><i class="fas fa-arrow-left"> Kembali</i></a>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header justify-content-between d-flex d-inline">
                        <h4 class="card-title">{{ $pengambilan_order->nomor_pre }}</h4>
                        <a href="{{ route('pelanggan.pengambilanSampelSelesai.cetakInvoice', $pengambilan_order->id) }}" target="_blank"><i class="btn btn-sm btn-primary shadow-sm">Cetak Invoice</i></a> 
                    </div>
               
                        <div class="col-md-2 mr-auto mt-2">
                            @if ($pengambilan_order->bukti_bayar)
                            @if ($pengambilan_order->id_status_pengambilan_sampel <= 4)
                            
                            @endif
                            <a href="{{  Storage::url($pengambilan_order->bukti_bayar)  }}" target="_blank" class="btn btn-info shadow-sm btn-sm">Lihat Bukti Pembayaran</a>
                            @else
                            @endif
                        </div>
                  
                    <div class="card-body">
                        <table class="table2" style="width:100%; padding-left: 25px; padding-right: 25px; padding-bottom: 8px;">
                            <tr style="font-size: 12px;">
                                <td class="th2" colspan="3" style="border-bottom: 1px solid rgba(0,0,0,0);"><b>{{ $pengambilan_order->nama_pemesan }}</b><br>{{ $pengambilan_order->alamat }}<br>{{ $pengambilan_order->no_hp }}<br>{{ $pengambilan_order->email }}</td>
                                <td class="th2" style="width:31%; border-bottom: 1px solid rgba(0,0,0,0);"><b>Tanggal Order:</b> {{ date('d M Y', strtotime($pengambilan_order->tanggal_isi)) }}<br><br><b>Status Order:</b><span style="font-size: 13px; color:#808080">&nbsp;
                                @if ($pengambilan_order->statusPengambilanSampel->id <= 4)
                                    Belum Bayar
                                @else
                                    Sudah Bayar
                                @endif
                                </span>
                                <br><br>
                                @php
                                $jatuh_tempo = \Carbon\Carbon::parse($tanggal_buat)->addDays(2);
                                @endphp
                                <b>Batas Tanggal Pembayaran : {{  $jatuh_tempo->format('d M Y') }} </b>
                                </td>

                            </tr>
                        </table>
                    
                        <table class="table2" style="width:100%; padding-left: 25px; padding-right: 25px; padding-bottom: 8px;">
                            <tr>
                                <td class="th2" colspan="4" style="font-size: 14px;"><b>Silahkan Transfer Ke:</b>
                                <br>
                                <b>Bank Kalbar</b>
                                <br>
                                Nomor Rekening : <b>1001013501</b>
                                <br>
                                Atas nama : <b>BEND PENERIMAAN DLH KOTA PTK</b>
                                
                                </td>
                            </tr>
                        </table>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Jenis Sampel</th>
                                        <th scope="col">Jumlah Titik Sampling</th>
                                        <th scope="col" align="right">Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
    
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $pengambilan_order->sampelUji->nama_sampel }}</td>
                                        <td>
                                           x {{ $pengambilan_order->jumlah_titik_sampling }} titik sampling
                                        </td>
                                        <td align="right">@currency($pengambilan_order->total_harga)</td>
                                    </tr>
                              
                                    <tr>
                                        <td colspan="4" align="right">Sub Total <b>@currency($pengambilan_order->total_harga)</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <table class="table2" style="width:100%; padding-left: 25px; padding-right: 25px; padding-bottom: 8px;">
                            <tr>
                                <td class="td2" colspan="4" style="font-size: 11px;"><b>Catatan</b><br>Harap membayar sesuai dengan total tagihan, yaitu sebesar @currency($pengambilan_order->total_harga) <br>- -</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@push('scripts')
@endpush