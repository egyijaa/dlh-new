@extends('layouts.admin')
@section('content')

<div class="content">
    <div class="page-inner">
        <div class="page-header justify-content-between d-flex d-inline">
            <a href="{{ route('helper.pengambilanSampel.index') }}"><i class="fas fa-arrow-left"> Kembali</i></a>
            @if ($pengambilan->id_status_pengambilan_sampel >= 5)
            <a href="{{ route('helper.pengambilanSampel.editBaPelanggan', $pengambilan->id) }}" class="btn btn-info btn-sm mb-1">Upload BA Pelanggan</a>
            @endif
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header justify-content-between d-flex d-inline">
                        <h4 class="card-title">Pembuatan Berita Acara {{ $pengambilan->nomor_pre }}  | No BA : {{ $pengambilan->no_ba }}</h4>
                        <a href="{{ route('helper.pengambilanSampel.cetakBa', $pengambilan->id) }}" target="_blank"><i class="btn btn-sm btn-primary my-1 shadow-sm">Cetak PDF BA</i></a>
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
                                    <input type="text" name="titik_sampling" class="form-control" value="{{ $ba->titik_sampling }}" required readonly>
                                    @error('titik_sampling')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="kode_sampel">Kode Wadah Sampel</label>
                                    <input type="text" name="kode_sampel" class="form-control" value="{{ $ba->kode_sampel }}" required readonly>
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
                                    <input type="text" name="lu" class="form-control" value="{{ $ba->lu }}" required readonly>
                                    @error('lu')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="suhu">Temp udara °</label>
                                    <input type="text" name="suhu" class="form-control" value="{{ $ba->suhu }}" readonly required>
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
                                    <input type="text" name="ls" class="form-control" value="{{ $ba->ls }}" required readonly>
                                    @error('ls')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-4">
                                    <label for="cuaca">Cuaca</label>
                                    <select name="cuaca" id="cuaca" class="custom-select @error('cuaca') is-invalid @enderror" required>
                                            <option disabled value="cerah" {{ $ba->cuaca == "cerah" ? 'selected' : '' }}>cerah</option>
                                            <option disabled value="mendung" {{ $ba->cuaca == "mendung" ? 'selected' : '' }}>mendung</option>
                                            <option disabled value="hujan" {{ $ba->cuaca == "hujan" ? 'selected' : '' }}>hujan</option>
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
                            <div class="row">
                                <div class="col-sm-6 col-md-3">
                                    <a href="#" data-id="{{ $ba->id }}" data-titik="{{ $ba->titik_sampling }}" data-lu="{{ $ba->lu }}" data-ls="{{ $ba->ls }}" data-kode="{{ $ba->kode_sampel }}" data-suhu="{{ $ba->suhu }}" data-cuaca="{{ $ba->cuaca }}" data-toggle="modal" data-target="#edit"><i class="btn btn-warning btn-shadow btn-sm mt-3">Edit Data</i></a>
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


<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('helper.pengambilanSampel.updateBeritaAcara') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id">
                <input type="hidden" name="id_pengambilan_sampel_order" value="{{ $pengambilan->id }}">
                <div class="modal-header">
                    <h5 class="modal-title"><span>Ubah</span> Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row my-2">
                        <div class="col-6">
                            <label for="titik_sampling">Titik Sampling</label>
                            <input type="text" name="titik_sampling" class="form-control" required>
                            @error('titik_sampling')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <input type="hidden" name="id_pengambilan_sampel_order" value="{{ $pengambilan->id }}">
                        <div class="col-6">
                            <label for="kode_sampel">Kode Wadah Sampel</label>
                            <input type="text" name="kode_sampel" class="form-control" required>
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
                            <input type="text" name="lu" class="form-control" required>
                            @error('lu')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="suhu">Temp udara °</label>
                            <input type="text" name="suhu" class="form-control" required>
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
                            <input type="text" name="ls" class="form-control" required>
                            @error('ls')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-4">
                            <label for="cuaca">Cuaca</label>
                            <select name="cuaca" id="cuaca" class="custom-select @error('cuaca') is-invalid @enderror" required>
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
                        <div class="row mt-4 mx-1">
                            <div class="col-4">
                                <label for="foto1">Foto Pengambilan Sampel <i>png/jpg/JPEG max:3mb</i></label>
                                <input type="file" name="foto1" class="form-control">
                            </div>
                            <div class="col-4">
                                <label for="foto2">Foto Penggabungan Sampel <i>png/jpg/JPEG max:3mb</i></label>
                                <input type="file" name="foto2" class="form-control">
                            </div>
                            <div class="col-4">
                                <label for="foto3">Foto Pengukuran Parameter <i>png/jpg/JPEG max:3mb</i></label>
                                <input type="file" name="foto3" class="form-control">
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

@endsection

@push('scripts')
<script>
    $("#edit").on('show.bs.modal', (e) => {
        var id = $(e.relatedTarget).data('id');
        var titik = $(e.relatedTarget).data('titik');
        var lu = $(e.relatedTarget).data('lu');
        var ls = $(e.relatedTarget).data('ls');
        var kode = $(e.relatedTarget).data('kode');
        var suhu = $(e.relatedTarget).data('suhu');
        var cuaca = $(e.relatedTarget).data('cuaca');

        $('#edit').find('input[name="id"]').val(id);
        $('#edit').find('input[name="titik_sampling"]').val(titik);
        $('#edit').find('input[name="lu"]').val(lu);
        $('#edit').find('input[name="ls"]').val(ls);
        $('#edit').find('input[name="kode_sampel"]').val(kode);
        $('#edit').find('input[name="suhu"]').val(suhu);
        $('#edit').find('select[name="cuaca"]').val(cuaca);
    });
    
</script>
@endpush