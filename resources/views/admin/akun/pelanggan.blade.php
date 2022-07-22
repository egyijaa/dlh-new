@extends('layouts.admin')
@section('content')

<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Akun Pelanggan</h4>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header justify-content-between d-flex d-inline">
                        <h4 class="card-title">Akun Pelanggan</h4>
                      </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover" >
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Aktif?</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach($pelanggan as $p)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $p->name }}</td>
                                        <td>{{ $p->email }}</td>
                                        <td>@if ($p->aktivasi == 1)
                                            <span class="badge badge-primary">Aktif</span>
                                        @else
                                        <span class="badge badge-danger">Tidak Aktif</span>
                                        @endif</td>
                                        <td>
                                            <a href="#" data-id="{{ $p->id }}" data-name="{{ $p->name }}" data-email="{{ $p->email }}" data-keterangan="{{ $p->keterangan }}" data-idtipepelanggan="{{ $p->idtipepelanggan }}" data-nik="{{ $p->nik }}" data-alamat="{{ $p->alamat }}" data-nohp="{{ $p->no_hp }}" data-aktivasi="{{ $p->aktivasi }}" data-toggle="modal" data-target="#verifikasi"><i class="fas fa-edit"></i></a> | 
                                            <a href="#" data-target="#delete" data-toggle="modal" data-id="{{ $p->id }}"><i class="fas fa-trash"></i></a>
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


<div class="modal fade" id="verifikasi" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.akun.pelangganVerif') }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="id">
                <div class="modal-header">
                    <h5 class="modal-title"><span>Verifkasi</span> Akun Pelanggan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="name" readonly>
                                @error('name')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="aktivasi">Aktivasi</label>
                                <select name="aktivasi" id="aktivasi" class="custom-select @error('aktivasi') is-invalid @enderror">
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                                @error('aktivasi')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" readonly>
                                @error('email')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" readonly>
                                @error('nik')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="idtipepelanggan">Tipe Pelanggan</label>
                                <select name="idtipepelanggan" id="idtipepelanggan" class="custom-select @error('idtipepelanggan') is-invalid @enderror" disabled>
                                    <option value="1">Instansi</option>
                                    <option value="2">Perusahaan</option>
                                    <option value="3">Mahasiswa</option>
                                    <option value="4">Umum</option>
                                </select>
                                @error('idtipepelanggan')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" readonly>
                                @error('keterangan')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" readonly>
                                @error('alamat')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="keterangan">No Hp</label>
                                <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="no_hp" readonly>
                                @error('keterangan')
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
            <form action="{{ route('admin.akun.pelangganDelete') }}" method="POST">
                @csrf
                @method('delete')
                <input type="hidden" name="id">
                <div class="modal-header">
                    <h5 class="modal-title"><span>Hapus</span> Akun</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus Data Akun ini ? Jika dihapus maka data orderan yang pernah dilakukan juga akan terhapus
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>

    $("#verifikasi").on('show.bs.modal', (e) => {
        var id = $(e.relatedTarget).data('id');
        var name = $(e.relatedTarget).data('name');
        var email = $(e.relatedTarget).data('email');
        var keterangan = $(e.relatedTarget).data('keterangan');
        var idtipepelanggan = $(e.relatedTarget).data('idtipepelanggan');
        var nik = $(e.relatedTarget).data('nik');
        var alamat = $(e.relatedTarget).data('alamat');
        var nohp = $(e.relatedTarget).data('nohp');
        var aktivasi = $(e.relatedTarget).data('aktivasi');
        
        $('#verifikasi').find('input[name="id"]').val(id);
        $('#verifikasi').find('input[name="name"]').val(name);
        $('#verifikasi').find('input[name="email"]').val(email);
        $('#verifikasi').find('input[name="keterangan"]').val(keterangan);
        $('#verifikasi').find('input[name="idtipepelanggan"]').val(idtipepelanggan);
        $('#verifikasi').find('input[name="nik"]').val(nik);
        $('#verifikasi').find('input[name="alamat"]').val(alamat);
        $('#verifikasi').find('input[name="no_hp"]').val(nohp);
        $('#verifikasi').find('select[name="aktivasi"]').val(aktivasi);
    });
    
    $('#delete').on('show.bs.modal', (e) => {
        var id = $(e.relatedTarget).data('id');
        console.log(id);
        $('#delete').find('input[name="id"]').val(id);
    });
</script>
@endpush