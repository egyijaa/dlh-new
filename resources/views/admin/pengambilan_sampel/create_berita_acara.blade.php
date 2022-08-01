@extends('layouts.admin')
@section('content')

<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <a href="{{ route('admin.pengambilanSampel.index') }}"><i class="fas fa-arrow-left"> Kembali</i></a>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header justify-content-between d-flex d-inline">
                        <h4 class="card-title">Pembuatan Berita Acara {{ $pengambilan->nomor_pre }} | No BA : {{ $pengambilan->no_ba }}</h4>
                    </div>
                    <div class="card-body">
                        @php
                            $titik = $pengambilan->jumlah_titik_sampling;
                        @endphp

                        <form action="{{ route('admin.pengambilanSampel.storeBeritaAcara') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                                @for ($i = 1; $i <= $titik; $i++)
                                <h4><b>Titik Sampling - {{ $i }}</b></h4>
                                <div class="row my-2">
                                    <div class="col-6">
                                        <label for="titik_sampling">Titik Sampling</label>
                                        <input type="text" name="titik_sampling[]" class="form-control" required>
                                        @error('titik_sampling')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <input type="hidden" name="id_pengambilan_sampel_order" value="{{ $pengambilan->id }}">
                                    <div class="col-6">
                                        <label for="kode_sampel">Kode Wadah Sampel</label>
                                        <input type="text" name="kode_sampel[]" class="form-control" required>
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
                                        <input type="text" name="lu[]" class="form-control" required>
                                        @error('lu')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label for="suhu">Temp udara °</label>
                                        <input type="text" name="suhu[]" class="form-control" required>
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
                                        <input type="text" name="ls[]" class="form-control" required>
                                        @error('ls')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-4">
                                        <label for="cuaca">Cuaca</label>
                                        <select name="cuaca[]" id="cuaca" class="custom-select @error('cuaca') is-invalid @enderror" required>
                                            <option value="">~ Pilih cuaca ~</option>
                                                <option value="cerah">cerah</option>
                                                <option value="mendung">mendung</option>
                                                <option value="hujan">hujan</option>
                                        </select>
                                        @error('cuaca')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <hr>
                                @endfor
                    
                            
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
@endpush