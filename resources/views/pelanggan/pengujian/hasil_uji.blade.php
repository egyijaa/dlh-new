@extends('layouts.admin')
@section('content')

<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <a href="{{ route('pelanggan.pengujian.getOrder', $id_pengujian_order) }}"><i class="fas fa-arrow-left"> Kembali</i></a>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header justify-content-between d-flex d-inline">
                        <h4 class="card-title">Orderan {{ $nomor_order }} | {{ $nama_sampel }} | {{ $kode_sampel }}</h4>
                      </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover" >
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Parameter</th>
                                        <th>Metode Uji</th>
                                        <th>Satuan</th>
                                        <th>Baku Mutu</th>
                                        <th>Hasil Pengujian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach($parameter_order as $p)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $p->parameterSampel->nama_parameter }}</td>
                                        <td>{{ $p->metode_uji }}</td>
                                        <td>{{ $p->satuan }}</td>
                                        <td>{{ $p->baku_mutu }}</td>
                                        <td>{{ $p->hasil_pengujian }}</td>
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