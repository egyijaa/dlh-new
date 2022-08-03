@extends('layouts.admin')
@section('content')

<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Order Pengambilan Sampel</h4>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header justify-content-between d-flex d-inline">
                        <h4 class="card-title">Order Pengambilan Sampel</h4>
                        <a href="{{ route('pelanggan.pengambilanSampel.createOrder') }}"><i class="btn btn-sm btn-primary shadow-sm">+ Tambah Order</i></a>
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
                                    @foreach($pengambilan as $p)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $p->nomor_pre }}</td>
                                        <td>{{Str::limit($p->nama_pemesan, 20)}}</td>
                                        <td>{{ date('d M Y', strtotime($p->tanggal_isi)) }}</td>
                                        <td><span class="
                                            @if($p->id_status_pengambilan_sampel == 1 || $p->id_status_pengambilan_sampel == 5 || $p->id_status_pengambilan_sampel == 5 || $p->id_status_pengambilan_sampel == 6 || $p->id_status_pengambilan_sampel == 7 || $p->id_status_pengambilan_sampel == 8)
                                            badge badge-primary mt-1
                                            @elseif ($p->id_status_pengambilan_sampel == 4 || $p->id_status_pengambilan_sampel == 9)
                                            badge badge-success mt-1
                                            @elseif ($p->id_status_pengambilan_sampel == 3)
                                            badge badge-danger mt-1
                                            @else 
                                            badge badge-warning mt-1
                                            @endif
                                            ">{{ $p->statusPengambilanSampel->status_pelanggan }}</span>
                                        <hr class="my-1">
                                        @if ($p->id_status_pengambilan_sampel >= 5)
                                        <span class="badge badge-success mb-1">Sudah Bayar</span> |
                                        @endif
                                        <a href="{{ route('pelanggan.pengambilanSampel.tracking', $p->id) }}"><i class="fas fa-angle-double-right" style="font-size: 11px">Tracking</i></a>
                                        </td>
                                        <td>@currency($p->total_harga)</td>
                                        <td>
                                            <a href="{{ route('pelanggan.pengambilanSampel.detailOrder', $p->id) }}" class="btn btn-info btn-xs my-1">Detail Order</a>
                                    
                                            @if ($p->statusPengambilanSampel->id != 1)
                                                
                                            @else
                                            <a href="{{ route('pelanggan.pengambilanSampel.editOrder', $p->id) }}" class="btn btn-warning btn-xs my-1">Edit Order</a>
                                            <a href="#" class="btn btn-secondary btn-xs my-1" data-target="#kirim" data-toggle="modal" data-id="{{ $p->id }}">Kirim Order</a>
                                            <a href="#" class="btn btn-danger btn-xs my-1" data-target="#delete" data-toggle="modal" data-id="{{ $p->id }}">Hapus Order</a>
                                            @endif

                                            @if ($p->statusPengambilanSampel->id >= 4)
                                            <a href="{{ route('pelanggan.pengambilanSampel.showInvoice', $p->id) }}"><i class="btn btn-xs btn-primary shadow-sm my-1">Lihat Invoice</i></a> 
                                            @endif
                                            @if ($p->foto_ba1 && $p->foto_ba2)
                                            <a href="{{ route('pelanggan.pengambilanSampel.cetakBaPelanggan', $p->id) }}" target="_blank"><i class="btn btn-xs btn-primary shadow-sm my-1">PDF Berita Acara</i></a> 
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

<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('pelanggan.pengambilanSampel.deleteOrder') }}" method="POST">
                @csrf
                @method('delete')
                <input type="hidden" name="id">
                <div class="modal-header">
                    <h5 class="modal-title"><span>Hapus</span> Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus Order ini ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="kirim" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('pelanggan.pengambilanSampel.sendOrder') }}" method="POST">
                @csrf
                @method('POST')
                <input type="hidden" name="id">
                <div class="modal-header">
                    <h5 class="modal-title"><span>Kirim</span> Orderan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin mengirim Order ini ? 
                    <br>
                    Orderan yang sudah dikirim maka tidak bisa dihapus maupun diedit kembali, pastikan orderan anda <strong>sudah benar</strong>.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $('#delete').on('show.bs.modal', (e) => {
        var id = $(e.relatedTarget).data('id');
        console.log(id);
        $('#delete').find('input[name="id"]').val(id);
    });

    $('#kirim').on('show.bs.modal', (e) => {
        var id = $(e.relatedTarget).data('id');
        console.log(id);
        $('#kirim').find('input[name="id"]').val(id);
    });
    
</script>
@endpush