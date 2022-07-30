@extends('layouts.admin')
@section('content')

<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <a href="{{ route('admin.pengujianSelesai.getOrder', $sampel->pengujianOrder->id) }}"><i class="fas fa-arrow-left"> Kembali</i></a>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header justify-content-between d-flex d-inline">
                        <h4 class="card-title">Orderan </h4>
                      </div>
                    <div class="card-body">
                        <form action="{{ route('admin.pengujianSelesai.updateShuPelanggan', $sampel->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="foto_shu1">Upload Scan/Foto SHU Lembar 1</label>
                                <input type="file" class="form-control @error('foto_shu1') is-invalid @enderror" id="foto_shu1" name="foto_shu1" required>
                                @error('foto_shu1')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                                @if ($sampel->foto_shu1)
                                <a href="{{  Storage::url($sampel->foto_shu1)  }}" target="_blank" class="btn btn-info shadow-sm btn-sm">Lihat Foto/Scan</a>
                                @endif

                            </div>
                            <div class="form-group">
                                <label for="foto_shu2">Upload Scan/Foto SHU Lembar 2</label>
                                <input type="file" class="form-control @error('foto_shu2') is-invalid @enderror" id="foto_shu2" name="foto_shu2" required>
                                @error('foto_shu2')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                                @if ($sampel->foto_shu2)
                                <a href="{{  Storage::url($sampel->foto_shu2)  }}" target="_blank" class="btn btn-info shadow-sm btn-sm">Lihat Foto/Scan</a>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-success btn-sm form-group">Simpan</button>
                        </form>

                        @if ($sampel->foto_shu1 && $sampel->foto_shu2)
                        <a href="{{ route('admin.pengujianSelesai.cetakShuPelanggan', $sampel->id) }}" target="_blank"><i class="btn btn-sm btn-primary shadow-sm my-2">Lihat PDF SHU Pelanggan</i></a> 
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