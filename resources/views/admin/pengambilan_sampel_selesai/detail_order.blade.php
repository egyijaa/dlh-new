@extends('layouts.admin')
@section('content')

<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <a href="{{ route('admin.pengambilanSampelSelesai.index') }}"><i class="fas fa-arrow-left"> Kembali</i></a>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header justify-content-between d-flex d-inline">
                        <h4 class="card-title"><b>Detail Pengambilan Sampel {{ $pengambilan->nomor_pre }}</b></h4>
                    </div>
                    <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="tanggal_isi">Tanggal order</label>
                                        @php
                                            $now = \Carbon\Carbon::now('Asia/Jakarta')->format('Y-m-d');
                                        @endphp
                                        <input type="date" value="{{ $pengambilan->tanggal_isi }}" class="form-control @error('tanggal_isi') is-invalid @enderror" id="tanggal_isi" name="tanggal_isi" readonly>
                                    
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="nomor_surat">Nomor Surat <i><small>bila ada</small></i></label>
                                        <input type="text" class="form-control @error('nomor_surat') is-invalid @enderror" id="nomor_surat" name="nomor_surat" value="{{ $pengambilan->nomor_surat }}" readonly>
                                        @if($pengambilan->file_surat)
                                            <a href="{{  Storage::url($pengambilan->file_surat)  }}" target="_blank" class="btn btn-info btn-sm">Klik Disini untuk membuka file</a>
                                          <br>
                                        @else 
                                          Tidak ada file
                                        @endif
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="nama_pemesan">Nama*</label>
                                        <input type="text" class="form-control @error('nama_pemesan') is-invalid @enderror" id="nama_pemesan" name="nama_pemesan" value="{{ $pengambilan->nama_pemesan }}" required readonly>
                                    </div>
                                   </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="nik">NIK*</label>
                                        <input type="number" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" value="{{ $pengambilan->nik }}" required readonly>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email">Email*</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $pengambilan->email }}" required readonly>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="id_tipe_pelanggan">Tipe Pelanggan*</label>
                                        <input type="text" value="{{ $pengambilan->tipePelanggan->tipe }}" class="form-control" readonly>
        
                                        <label for="keterangan">Keterangan Asal*</label>
                                        <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" value="{{ $pengambilan->keterangan }}" required readonly>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="no_hp">No Hp (WhatsApp)*</label>
                                        <input type="number" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" value="{{ $pengambilan->no_hp }}" required readonly>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="alamat">Alamat Lengkap*</label>
                                        <textarea name="alamat" class="form-control" id="alamat" cols="5" rows="5" required readonly>{{ $pengambilan->alamat }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h3 class="ml-2"><b>Jasa Pelayanan</b></h3>
                                <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="no_hp">Jasa Pelayanan</label>
                                            <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" value="{{ $pengambilan->jasa_pelayanan }}" required readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group border border-color-dark mt-2">
                                            <label for="sampel">Total Harga (jenis sampel x titik sampling)</label>
                                            <br>
                                            <span style="font-size: 120%" id="harga"
                                                class="badge badge-primary text-bold">@currency($pengambilan->total_harga)</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="jenis_sampel">Jenis Sampel*</label>
                                            <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" value="{{ $pengambilan->sampelUji->nama_sampel }}" required readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="tanggal_sampling"><b>Hari/Tanggal Sampling*</b></label>
                                        <input type="date" class="form-control @error('tanggal_sampling') is-invalid @enderror" id="tanggal_sampling" name="tanggal_sampling" value="{{ $pengambilan->tanggal_sampling }}"  required readonly>
                                    </div>
                                    <div class="col-6">
                                        <label for="persyaratan_pelanggan"><b>Persyaratan Pelanggan</b> <i><small>(Jika ada)</small></i></label>
                                        <input type="text" class="form-control @error('persyaratan_pelanggan') is-invalid @enderror" id="persyaratan_pelanggan" name="persyaratan_pelanggan" value="{{ $pengambilan->persyaratan_pelanggan }}" readonly>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <label for="alamat_sampling"><b>Lokasi Pengambilan Sampel* <i><small>(diisi dengan lengkap)</small></i></b></label>
                                        <textarea name="alamat_sampling" class="form-control" id="alamat_sampling" cols="5" rows="5" required readonly placeholder="cth : Jln. Nusa Indah, gg. merak,  di depan warung bu aci no. 20">{{ $pengambilan->alamat_sampling }}</textarea>
                                    </div>
                                    <div class="col-6">
                                        <label for="pendamping_sampling"><b>Pendamping Saat Sampling*</b></label>
                                        <textarea name="pendamping_sampling" class="form-control" id="pendamping_sampling" cols="5" rows="5" required readonly>{{ $pengambilan->pendamping_sampling }}</textarea>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="jumlah_lokasi_sampling"><b>Jumlah Lokasi Sampling*</b></label>
                                            <input type="number"
                                                class="form-control @error('jumlah_lokasi_sampling') is-invalid @enderror"
                                                id="jumlah_lokasi_sampling" name="jumlah_lokasi_sampling" value="{{ $pengambilan->jumlah_lokasi_sampling }}" required readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="jumlah_titik_sampling"><b>Jumlah Titik Sampling*</b></label>
                                            <input type="number"
                                                class="form-control @error('jumlah_titik_sampling') is-invalid @enderror"
                                                id="jumlah_titik_sampling" name="jumlah_titik_sampling" value="{{ $pengambilan->jumlah_titik_sampling }}" required readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label class="form-label" for="volume_sampel">Volume Sampel*</label>
                                                <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" value="{{ $pengambilan->volumeSampel->volume }}" required readonly>
                                        </div>
                                    </div>
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