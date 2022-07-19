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
                        <a href="{{ route('admin.pengujian.cetakLaporanSementara') }}" target="_blank"><i class="btn btn-sm btn-primary shadow-sm">Cetak Laporan Sementara</i></a>
                        <a href="{{ route('admin.pengujian.cetakSertifikat') }}" target="_blank"><i class="btn btn-sm btn-primary shadow-sm">Cetak Sertifikat</i></a>
                        <a href="{{ route('admin.pengujian.cetakSkr') }}" target="_blank"><i class="btn btn-sm btn-primary shadow-sm">Cetak SKR</i></a>
                        <a href="{{ route('admin.pengujian.cetakTbp') }}" target="_blank"><i class="btn btn-sm btn-primary shadow-sm">Cetak TBP</i></a>
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
                                        <th>Aksi</th>
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
                                        <th><span class="badge badge-primary">{{ $p->statusPengujian->status_admin }}</span></th>
                                        <td>
                                            <a href="{{ route('admin.pengujian.getOrder', $p->id) }}" class="btn btn-sm btn-primary shadow-sm my-3">
                                                <i class="fas fa-pencil fa-sm text-white-50"></i>Lihat Sampel
                                            </a>
                                            <a href="#" class="btn btn-warning btn-sm my-2" data-target="#status" data-toggle="modal" data-id="{{ $p->id }}" data-status="{{ $p->statusPengujian->id }}">Ganti Status</a>
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

<div class="modal fade" id="status" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.pengujian.gantiStatus') }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="id">
                <div class="modal-header">
                    <h5 class="modal-title"><span>Ganti</span> Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="custom-select @error('status') is-invalid @enderror">
                            <option value="">~ Pilih Status ~</option>
                            @foreach($status as $s)
                                <option value="{{ $s->id }}">{{ $s->status_admin }}</option>
                            @endforeach
                        </select>
                        @error('status')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <label for="konfirmasi">Anda Yakin?</label><br>
                    <input type="checkbox" name="konfirmasi" required><label for="konfirmasi">Ya, Saya Yakin</label>
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
    $('#status').on('show.bs.modal', (e) => {
        var id = $(e.relatedTarget).data('id');
        var status = $(e.relatedTarget).data('status');
        
        $('#status').find('input[name="id"]').val(id);
        $('#status').find('select[name="status"]').val(status);
    });
    
</script>
@endpush