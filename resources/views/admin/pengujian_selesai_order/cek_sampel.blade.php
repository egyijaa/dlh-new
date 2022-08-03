@extends('layouts.admin')
@section('content')

<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <a href="{{ route('admin.pengujianSelesai.index') }}"><i class="fas fa-arrow-left"> Kembali</i></a>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header justify-content-between d-flex d-inline">
                        <h4 class="card-title">List Orderan {{ $nomor_pre }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor Analis/Uji</th>
                                        <th>Kode Sampel</th>
                                        <th>Jenis Sampel</th>
                                        <th>Parameter</th>
                                        <th>Harga</th>
                                        <th>Diambil Dari</th>
                                        <th>Catatan Pelanggan</th>
                                        @if ($status >= 5)
                                        <th>Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 1;
                                    @endphp
                                    @foreach($sampel_order as $s)
                                    <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $s->nomor_uji }}</td>
                                    <td>{{ $s->kode_sampel }}</td>
                                    <td>{{ $s->sampelUji->nama_sampel }}</td>
                                    <td>
                                            @foreach ($s->parameterSampelOrder as $parameter)
                                                <li>{{ $parameter->parameterSampel->nama_parameter }}</li>
                                            @endforeach
                                    </td>
                                    <td>@currency($s->harga)</td>
                                    <td>{{ $s->diambil_dari }}</td>
                                    <td>@if ($s->catatan_pelanggan)
                                        {{ $s->catatan_pelanggan }}
                                        @else
                                        ---
                                    @endif</td>
                                    <td>
                                    @if ($status >= 5)
                                        
                                    <a href="{{ route('admin.pengujianSelesai.hasilUji', ['order'=>$nomor_pre, 'id'=>$s->id]) }}" class="btn btn-info btn-xs mt-1">Lihat</a>
                                    <br>
                                    @endif
                                    
                                    @if ($status >= 9)
                                    <a href="{{ route('admin.pengujianSelesai.cetakLaporanSementara', ['order'=>$id_pengujian_order, 'sampel'=>$s->id] ) }}" target="_blank"><i class="btn btn-xs btn-primary shadow-sm mt-1">Cetak Laporan Sementara</i></a>
                                    @endif


                                    @if ($status >= 11)
                                    <a href="{{ route('admin.pengujianSelesai.cetakSertifikat', ['order'=>$id_pengujian_order, 'sampel'=>$s->id]) }}" target="_blank"><i class="btn btn-xs btn-primary shadow-sm mt-1">Cetak Sertifikat (SHU)</i></a> 
                                    @endif

                                    @if ($s->foto_shu1 && $s->foto_shu2)
                                    <a href="{{ route('admin.pengujianSelesai.cetakShuPelanggan', $s->id) }}" target="_blank"><i class="btn btn-xs btn-primary shadow-sm mt-1">Lihat PDF SHU Pelanggan</i></a> 
                                    @else
                                    <a href="{{ route('admin.pengujianSelesai.editShuPelanggan', $s->id) }}" target="_blank" class="btn btn-warning btn-xs mb-1">Upload SHU Pelanggan</a>
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