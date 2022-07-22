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
                                        <td><span class="badge badge-primary">{{ $p->statusPengambilanSampel->status_pelanggan }}</span>
                                        <br>
                                        <a href="{{ route('pelanggan.pengujian.tracking', $p->id) }}"><i class="fas fa-angle-double-right" style="font-size: 11px">Tracking</i></a>
                                        </td>
                                        <td>@currency($p->total_harga)</td>
                                        <td>
                                            <a href="#" class="btn btn-info btn-sm mt-1" data-id="{{ $p->id }}" data-nama="{{ $p->nama_pemesan }}" data-nik="{{ $p->nik }}" data-nohp="{{ $p->no_hp }}" data-email="{{ $p->email }}" data-alamat="{{ $p->alamat }}" data-tanggal="{{ $p->tanggal_isi }}" data-nosurat="{{ $p->nomor_surat }}" data-filesurat="{{ $p->file_surat }}" data-toggle="modal" data-target="#info">Info Order</a>
                                            @if ($p->statusPengambilanSampel->id != 1)
                                                
                                            @else
                                            <a href="#" class="btn btn-secondary btn-sm mt-1" data-target="#kirim" data-toggle="modal" data-id="{{ $p->id }}">Kirim Order</a>
                                            <a href="#" class="btn btn-danger btn-sm mt-1" data-target="#delete" data-toggle="modal" data-id="{{ $p->id }}">Hapus Order</a>
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
            <form action="" method="POST">
                @csrf
                @method('delete')
                <input type="hidden" name="id">
                <div class="modal-header">
                    <h5 class="modal-title"><span>Hapus</span> Sampel</h5>
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
            <form action="" method="POST">
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

<div class="modal fade" id="info" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span>Info</span> Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" class="form-control" name="nama" readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">NIK</label>
                                <input type="text" class="form-control" name="nik" readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">No Hp</label>
                                <input type="text" class="form-control" name="nohp" readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" class="form-control" name="email" readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <input type="text" class="form-control" name="alamat" readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">No Surat</label>
                                <input type="text" class="form-control" name="nosurat" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Tutup</button>
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

    $("#info").on('show.bs.modal', (e) => {
        var id = $(e.relatedTarget).data('id');
        var nama = $(e.relatedTarget).data('nama');
        var nik = $(e.relatedTarget).data('nik');
        var nohp = $(e.relatedTarget).data('nohp');
        var email = $(e.relatedTarget).data('email');
        var alamat = $(e.relatedTarget).data('alamat');
        var tanggal = $(e.relatedTarget).data('tanggal');
        var nosurat = $(e.relatedTarget).data('nosurat');
        var filesurat = $(e.relatedTarget).data('filesurat');
        
        $('#info').find('input[name="id"]').val(id);
        $('#info').find('input[name="nama"]').val(nama);
        $('#info').find('input[name="nik"]').val(nik);
        $('#info').find('input[name="nohp"]').val(nohp);
        $('#info').find('input[name="email"]').val(email);
        $('#info').find('input[name="alamat"]').val(alamat);
        $('#info').find('input[name="tanggal"]').val(tanggal);
        $('#info').find('input[name="nosurat"]').val(nosurat);
        $('#info').find('input[name="filesurat"]').val(filesurat);
    });
    
</script>
@endpush