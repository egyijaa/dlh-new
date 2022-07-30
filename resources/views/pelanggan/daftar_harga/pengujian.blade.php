@extends('layouts.admin')
@section('content')

<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Daftar Harga</h4>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header justify-content-between d-flex d-inline">
                        <h4 class="card-title">Pengujian</h4>
                      </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover" >
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Sampel</th>
                                        <th>Parameter</th>
                                        <th>Tersedia?</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach($pengujian as $p)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $p->nama_sampel }}</td>
                                        <td>
                                        @foreach ($p->parameterSampel as $item)
                                            <li>{{ $item->nama_parameter }} - @currency($item->harga)</li>
                                        @endforeach
                                        
                                        </td>
                                        <td>@if ($p->status == 1)
                                            Tersedia
                                        @else
                                            Tidak Tersedia
                                        @endif</td>
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