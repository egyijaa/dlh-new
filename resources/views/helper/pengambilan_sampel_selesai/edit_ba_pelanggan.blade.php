@extends('layouts.admin')
@section('content')

<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <a href="{{ route('helper.pengambilanSampelSelesai.beritaAcara', $pengambilan->id) }}"><i class="fas fa-arrow-left"> Kembali</i></a>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header justify-content-between d-flex d-inline">
                        <h4 class="card-title">{{ $pengambilan->no_ba }}</h4>
                      </div>
                    <div class="card-body">
                        <form action="{{ route('helper.pengambilanSampelSelesai.updateBaPelanggan', $pengambilan->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="foto_ba1">Upload Scan/Foto BA Lembar 1</label>
                                <input type="file" class="form-control @error('foto_ba1') is-invalid @enderror" id="foto_ba1" name="foto_ba1" required>
                                @error('foto_ba1')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                                @if ($pengambilan->foto_ba1)
                                <a href="{{  Storage::url($pengambilan->foto_ba1)  }}" target="_blank" class="btn btn-info shadow-sm btn-sm">Lihat Foto/Scan</a>
                                @endif

                            </div>
                            <div class="form-group">
                                <label for="foto_ba2">Upload Scan/Foto BA Lembar 2</label>
                                <input type="file" class="form-control @error('foto_ba2') is-invalid @enderror" id="foto_ba2" name="foto_ba2" required>
                                @error('foto_ba2')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                                @if ($pengambilan->foto_ba2)
                                <a href="{{  Storage::url($pengambilan->foto_ba2)  }}" target="_blank" class="btn btn-info shadow-sm btn-sm">Lihat Foto/Scan</a>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-success btn-sm form-group">Simpan</button>
                        </form>

                        @if ($pengambilan->foto_ba1 && $pengambilan->foto_ba2)
                        <a href="{{ route('helper.pengambilanSampelSelesai.cetakBaPelanggan', $pengambilan->id) }}" target="_blank"><i class="btn btn-sm btn-primary shadow-sm my-2">Lihat PDF BA Pelanggan</i></a> 
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')
@endpush