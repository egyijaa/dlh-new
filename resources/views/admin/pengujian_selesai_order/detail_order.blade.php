@extends('layouts.admin')
@section('content')

<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <a href="{{ route('admin.pengujianSelesai.index') }}"><i class="fas fa-arrow-left"> Kembali</i></a>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header justify-content-between d-flex d-inline">
                        <h4 class="card-title">Detail Order {{ $pengujian_order->nomor_pre }}</h4>
                      </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="tanggal_isi">Tanggal order</label>
                                    <input type="date" class="form-control @error('tanggal_isi') is-invalid @enderror" id="tanggal_isi" name="tanggal_isi" value="{{ $pengujian_order->tanggal_isi }}" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="nomor_surat">Nomor Surat <i><small>bila ada</small></i></label>
                                    <input type="text" class="form-control @error('nomor_surat') is-invalid @enderror" id="nomor_surat" name="nomor_surat" value="{{ $pengujian_order->nomor_surat }}" readonly>
                                    @if ($pengujian_order->file_surat)
                                    <a href="{{  Storage::url($pengujian_order->file_surat)  }}" target="_blank" class="btn btn-info shadow-sm btn-sm">Lihat File</a>
                                    @else
                                        <i>tidak ada lampiran</i>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="nama_pemesan">Nama*</label>
                                    <input type="text" class="form-control @error('nama_pemesan') is-invalid @enderror" id="nama_pemesan" name="nama_pemesan" required value="{{ $pengujian_order->nama_pemesan }}" readonly>
                                </div>
                               </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="nik">NIK*</label>
                                    <input type="number" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" required value="{{ $pengujian_order->nik }}" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="email">Email*</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required value="{{ $pengujian_order->email }}" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="id_tipe_pelanggan">Tipe Pelanggan*</label>
                                    <input type="text" class="form-control" value="{{ $pengujian_order->tipePelanggan->tipe }}" readonly>
    
                                    <label for="keterangan">Keterangan Asal*</label>
                                    <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" required value="{{ $pengujian_order->keterangan }}" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="no_hp">No Hp (WhatsApp)*</label>
                                    <input type="number" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" required value="{{ $pengujian_order->no_hp }}" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="alamat">Alamat Lengkap*</label>
                                    <textarea name="alamat" class="form-control" id="alamat" cols="5" rows="5" required readonly>{{ $pengujian_order->alamat }}</textarea>
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
<script>

    
</script>
@endpush