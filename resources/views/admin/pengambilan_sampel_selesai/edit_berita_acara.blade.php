@extends('layouts.admin')
@section('content')

<div class="content">
    <div class="page-inner">
        <div class="page-header justify-content-between d-flex d-inline">
            <a href="{{ route('admin.pengambilanSampelSelesai.index') }}"><i class="fas fa-arrow-left"> Kembali</i></a>
            <a href="{{ route('admin.pengambilanSampelSelesai.cetakBaPelanggan', $pengambilan->id) }}" target="_blank"><i class="btn btn-sm btn-primary shadow-sm my-2">Lihat PDF BA Pelanggan</i></a> 
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header justify-content-between d-flex d-inline">
                        <h4 class="card-title">Pembuatan Berita Acara {{ $pengambilan->nomor_pre }} | No BA : {{ $pengambilan->no_ba }}</h4>
                        <a href="{{ route('admin.pengambilanSampelSelesai.cetakBa', $pengambilan->id) }}" target="_blank"><i class="btn btn-sm btn-primary my-1 shadow-sm">Cetak PDF BA</i></a>
                    </div>
                    <div class="card-body">
                        @php
                            $titik = $pengambilan->jumlah_titik_sampling;
                            $i = 1;
                        @endphp

                            @foreach ($berita_acara as $ba)
                            <h4><b>Titik Sampling - {{ $i++ }}</b></h4>
                            <div class="row my-2">
                                <div class="col-6">
                                    <label for="titik_sampling">Titik Sampling</label>
                                    <input type="text" name="titik_sampling" class="form-control" value="{{ $ba->titik_sampling }}" required>
                                    @error('titik_sampling')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="kode_sampel">Kode Wadah Sampel</label>
                                    <input type="text" name="kode_sampel" class="form-control" value="{{ $ba->kode_sampel }}" required>
                                    @error('kode_sampel')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row my-1">
                                <div class="col-6">
                                    <label for="lu">Titik Koordinat (LU)</label>
                                    <input type="text" name="lu" class="form-control" value="{{ $ba->lu }}" required>
                                    @error('lu')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="suhu">Temp udara °</label>
                                    <input type="text" name="suhu" class="form-control" value="{{ $ba->suhu }}"  required>
                                    @error('suhu')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-6">
                                    <label for="ls">Titik Koordinat (LS)</label>
                                    <input type="text" name="ls" class="form-control" value="{{ $ba->ls }}" required>
                                    @error('ls')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-4">
                                    <label for="cuaca">Cuaca</label>
                                    <select name="cuaca" id="cuaca" class="custom-select @error('cuaca') is-invalid @enderror" required>
                                            <option value="cerah" {{ $ba->cuaca == "cerah" ? 'selected' : '' }}>cerah</option>
                                            <option value="mendung" {{ $ba->cuaca == "mendung" ? 'selected' : '' }}>mendung</option>
                                            <option value="hujan" {{ $ba->cuaca == "hujan" ? 'selected' : '' }}>hujan</option>
                                    </select>
                                    @error('cuaca')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-4">
                                    <label for="foto1">Foto Pengambilan Sampel</label>
                                    @if ($ba->foto1 != '-')
                                    <br>
                                    <a href="{{  Storage::url($ba->foto1)  }}" target="_blank" class="btn btn-info shadow-sm btn-sm">Lihat Foto</a>
                                    @else
                                    <br>
                                    <i>belum ada foto</i>
                                    @endif
                                </div>
                                <div class="col-4">
                                    <label for="foto2">Foto Penggabungan Sampel</label>
                                    @if ($ba->foto2 != '-')
                                    <br>
                                    <a href="{{  Storage::url($ba->foto2)  }}" target="_blank" class="btn btn-info shadow-sm btn-sm">Lihat Foto</a>
                                    @else
                                    <br>
                                    <i>belum ada foto</i>
                                    @endif
                                </div>
                                <div class="col-4">
                                    <label for="foto3">Foto Pengukuran Parameter</label>
                                    @if ($ba->foto3 != '-')
                                    <br>
                                    <a href="{{  Storage::url($ba->foto3)  }}" target="_blank" class="btn btn-info shadow-sm btn-sm">Lihat Foto</a>
                                    @else
                                    <br>
                                    <i>belum ada foto</i>
                                    @endif
                                </div>
                            </div>
                            <hr>
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')

@endpush