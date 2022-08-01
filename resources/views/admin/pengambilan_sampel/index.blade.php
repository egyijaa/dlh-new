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
                                        <td>
                                            <span class="
                                            @if($p->id_status_pengambilan_sampel == 1 || $p->id_status_pengambilan_sampel == 5 || $p->id_status_pengambilan_sampel == 6 || $p->id_status_pengambilan_sampel == 7 || $p->id_status_pengambilan_sampel == 8)
                                            badge badge-primary mt-2
                                            @elseif ($p->id_status_pengambilan_sampel == 4 || $p->id_status_pengambilan_sampel == 9)
                                            badge badge-success mt-2
                                            @elseif ($p->id_status_pengambilan_sampel == 3)
                                            badge badge-danger mt-2
                                            @else 
                                            badge badge-warning mt-2
                                            @endif
                                            ">{{ $p->statusPengambilanSampel->status_admin }}</span>


                                        @if ($p->bukti_bayar)
                                        <hr>
                                        @if ($p->id_status_pengambilan_sampel >= 5)
                                        <span class="badge badge-success mb-1">Sudah Bayar</span>
                                        @endif
                                        <a href="{{ route('admin.pengambilanSampel.showBuktiPembayaran', $p->id) }}" class="btn btn-primary btn-sm mb-2">Lihat Bukti Pembayaran</a>
                                        @endif
                                        </td>
                                        <td>@currency($p->total_harga)</td>
                                        <td>
                                            <a href="{{ route('admin.pengambilanSampel.detailOrder', $p->id) }}" class="btn btn-sm btn-info shadow-sm my-3">
                                                <i class="fas fa-pencil fa-sm text-white-50"></i>Detail order
                                            </a>
                                            @if ($p->id_status_pengambilan_sampel != 3)
                                            <a href="#" class="btn btn-warning btn-sm my-2" data-target="#status" data-toggle="modal" data-id="{{ $p->id }}" data-status="{{ $p->statusPengambilanSampel->id }}">Ganti Status</a>
                                            @endif
                                            @if ($p->id_status_pengambilan_sampel >= 4)
                                            <a href="{{ route('admin.pengambilanSampel.cetakInvoice', $p->id) }}" target="_blank"><i class="btn btn-sm btn-primary shadow-sm">Cetak Invoice</i></a> 
                                            <a href="{{ route('admin.pengambilanSampel.cetakSkr', $p->id) }}" target="_blank"><i class="btn btn-sm btn-primary my-1 shadow-sm">Cetak SKR</i></a> 
                                            @endif
                                            @if ($p->id_status_pengambilan_sampel >= 5)
                                            <a href="{{ route('admin.pengambilanSampel.cetakTbp', $p->id) }}" target="_blank"><i class="btn btn-sm btn-primary my-1 shadow-sm">Cetak TBP</i></a>
                                            <a href="{{ route('admin.pengambilanSampel.beritaAcara', $p->id) }}" class="btn btn-sm btn-primary shadow-sm my-3">
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

<div class="modal fade" id="status" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.pengambilanSampel.gantiStatus') }}" method="POST">
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
                    <div class="form-group">
                        <label for="konfirmasi">Anda Yakin?</label><br>
                        <input type="checkbox" name="konfirmasi" id="konfirmasi" required> &nbsp;<label for="konfirmasi">Ya, Saya Yakin</label>
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
    $('#status').on('show.bs.modal', (e) => {
        var id = $(e.relatedTarget).data('id');
        var status = $(e.relatedTarget).data('status');
        
        $('#status').find('input[name="id"]').val(id);
        $('#status').find('select[name="status"]').val(status);
    });
    
</script>
@endpush