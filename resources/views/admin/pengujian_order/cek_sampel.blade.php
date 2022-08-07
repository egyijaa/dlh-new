@extends('layouts.admin')
@section('content')

<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <a href="{{ route('admin.pengujian.index') }}"><i class="fas fa-arrow-left"> Kembali</i></a>
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
                                        <th style="width: 40%">Parameter</th>
                                        <th>Harga</th>
                                        <th>Diambil Dari</th>
                                        <th>Catatan Pelanggan</th>
                                        @if ($status >= 5)
                                        <th>Detail</th>
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
                                    <td>{{ $s->diambil_dari }}
                                        @if ($status >= 5)
                                        <br>
                                        <a href="#" class="badge badge-warning mt-1" data-id="{{ $s->id }}" data-diambil="{{ $s->diambil_dari }}" data-toggle="modal" data-target="#edit">Edit</a>
                                        @endif
                                    </td>
                                    <td>@if ($s->catatan_pelanggan)
                                        {{ $s->catatan_pelanggan }}
                                        @else
                                        ---
                                    @endif</td>
                                    <td>
                                    @if ($status == 2)
                                    <a href="{{ route('admin.pengujian.editSampelParameter', $s->id) }}"><button class="btn btn-info btn-xs">Edit Parameter
                                    </button></a> 
                                    @endif

                                    @if ($status >= 5)
                                        
                                    <a href="{{ route('admin.pengujian.hasilUji', ['order'=>$nomor_pre, 'id'=>$s->id]) }}" class="btn btn-info btn-xs mt-1">Lihat</a>
                                    <br>
                                    @endif
                                    
                                    @if ($status >= 9)
                                    <a href="{{ route('admin.pengujian.cetakLaporanSementara', ['order'=>$id_pengujian_order, 'sampel'=>$s->id] ) }}" target="_blank"><i class="btn btn-xs btn-primary shadow-sm my-1">Cetak Laporan Sementara</i></a>
                                    @endif


                                    @if ($status >= 11)
                                    <a href="{{ route('admin.pengujian.cetakSertifikat', ['order'=>$id_pengujian_order, 'sampel'=>$s->id]) }}" target="_blank"><i class="btn btn-xs btn-primary shadow-sm mb-1">Cetak Sertifikat (SHU)</i></a> 
                                    @endif

                                    @if ($status >= 12)
                                    <a href="{{ route('admin.pengujian.editShuPelanggan', $s->id) }}" target="_blank" class="btn btn-info btn-xs mb-1">Upload SHU Pelanggan</a>
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


<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.pengujian.editSampel') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title"><span>Edit</span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="id">
                        <div class="col-12">
                            <label for="diambil_dari">Diambil Dari</label>
                            <input type="text" name="diambil_dari" class="form-control">
                            @error('diambil_dari')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection

@push('scripts')
<script>

     $("#edit").on('show.bs.modal', (e) => {
        var id = $(e.relatedTarget).data('id');
        var diambil = $(e.relatedTarget).data('diambil');
        
        $('#edit').find('input[name="id"]').val(id);
        $('#edit').find('input[name="diambil_dari"]').val(diambil);
    });
</script>

@endpush