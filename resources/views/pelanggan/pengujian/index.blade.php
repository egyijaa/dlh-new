@extends('layouts.admin')
@section('content')

<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Order Pengujian</h4>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header justify-content-between d-flex d-inline">
                        <h4 class="card-title">Order Pengujian</h4>
                        <a href="#" data-toggle="modal" data-target="#tambah"><i class="btn btn-sm btn-primary shadow-sm">+ Tambah Order</i></a>
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
                                    @foreach($pengujian as $p)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $p->nomor_pre }}</td>
                                        <td>{{Str::limit($p->nama_pemesan, 20)}}</td>
                                        <td>{{ date('d M Y', strtotime($p->tanggal_isi)) }}</td>
                                        <td><span class="
                                            @if($p->id_status_pengujian == 1 || $p->id_status_pengujian == 5 || $p->id_status_pengujian == 5 || $p->id_status_pengujian == 6 || $p->id_status_pengujian == 7 || $p->id_status_pengujian == 8 || $p->id_status_pengujian == 9 || $p->id_status_pengujian == 10 || $p->id_status_pengujian == 11 || $p->id_status_pengujian == 12)
                                            badge badge-primary mt-1
                                            @elseif ($p->id_status_pengujian == 4 || $p->id_status_pengujian == 13)
                                            badge badge-success mt-1
                                            @elseif ($p->id_status_pengujian == 3)
                                            badge badge-danger mt-1
                                            @else 
                                            badge badge-warning mt-1
                                            @endif
                                            ">{{ $p->statusPengujian->status_pelanggan }}</span>
                                        <hr class="my-1">
                                        @if ($p->id_status_pengujian >= 5)
                                        <span class="badge badge-success my-1">Sudah Bayar</span> |
                                        @endif
                                        <a href="{{ route('pelanggan.pengujian.tracking', $p->id) }}"><i class="fas fa-angle-double-right my-1" style="font-size: 11px">Tracking</i></a>
                                        </td>
                                        <td>@currency($p->total_harga)</td>
                                        <td>
                                           <form action="{{ route('pelanggan.pengujian.sampel') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id_order" value="{{ $p->id }}">
                                                <button type="submit" class="btn btn-primary btn-xs mt-1">
                                                    @if ($p->statusPengujian->id == 1)
                                                        Pilih
                                                    @else
                                                        Lihat
                                                    @endif
                                                    Sampel</button>
                                            </form> 
                                            <a href="{{ route('pelanggan.pengujian.detailOrder', $p->id) }}" class="btn btn-info btn-xs my-1">Detail Order</a>
                                            @if ($p->statusPengujian->id != 1)
                                                
                                            @else
                                            <a href="#" class="btn btn-secondary btn-xs my-1" data-target="#kirim" data-toggle="modal" data-id="{{ $p->id }}">Kirim Order</a>
                                            <a href="#" class="btn btn-danger btn-xs mb-1" data-target="#delete" data-toggle="modal" data-id="{{ $p->id }}">Hapus Order</a>
                                            @endif

                                            @if ($p->statusPengujian->id >= 4)
                                            <a href="{{ route('pelanggan.pengujian.showInvoice', $p->id) }}"><i class="btn btn-xs btn-primary shadow-sm my-1">Lihat Invoice</i></a> 
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

<div class="modal fade bd-example-modal-lg" id="tambah" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('pelanggan.pengujian.createOrder') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title"><span>Tambah</span> Order Pengujian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="tanggal_isi">Tanggal order</label>
                                @php
                                    $now = \Carbon\Carbon::now('Asia/Jakarta')->format('Y-m-d');
                                @endphp
                                <input type="date" readonly value="{{ $now }}" class="form-control @error('tanggal_isi') is-invalid @enderror" id="tanggal_isi" name="tanggal_isi">
                                @error('tanggal_isi')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="nomor_surat">Nomor Surat <i><small>bila ada, file PDF|Max: 3mb</small></i></label>
                                <input type="text"
                                    class="form-control @error('nomor_surat') is-invalid @enderror"
                                    id="nomor_surat" name="nomor_surat">
                                <input type="file" name="file_surat">
                                @error('nomor_surat')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                                @error('file_surat')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="nama_pemesan">Nama*</label>
                                <input type="text" class="form-control @error('nama_pemesan') is-invalid @enderror" id="nama_pemesan" name="nama_pemesan" required>
                                @error('nama_pemesan')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                           </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="nik">NIK* <i><small>16 digit</small></i></label>
                                <input type="number" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" required>
                                @error('nik')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="email">Email*</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required>
                                @error('email')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="id_tipe_pelanggan">Tipe Pelanggan*</label>
                                <select name="id_tipe_pelanggan" id="id_tipe_pelanggan" class="custom-select @error('id_tipe_pelanggan') is-invalid @enderror" required>
                                    <option value="">~ Pilih Asal ~</option>
                                    @foreach($tipe_pelanggan as $tp)
                                        <option value="{{ $tp->id }}">{{ $tp->tipe }}</option>
                                    @endforeach
                                </select>
                                @error('id_tipe_pelanggan')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror

                                <label for="keterangan">Keterangan Asal*</label>
                                <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" required>
                                @error('keterangan')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="no_hp">No Hp (WhatsApp)* <i><small>10-13 digit</small></i></label>
                                <input type="number" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" required placeholder="081423xxxxxx">
                                @error('no_hp')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="alamat">Alamat Lengkap*</label>
                                <textarea name="alamat" class="form-control" id="alamat" cols="5" rows="5" required></textarea>
                                @error('alamat')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
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

<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('pelanggan.pengujian.deleteOrder') }}" method="POST">
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
            <form action="{{ route('pelanggan.pengujian.sendOrder') }}" method="POST">
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