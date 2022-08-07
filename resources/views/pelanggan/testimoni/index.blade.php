@extends('layouts.admin')
@section('content')

<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Testimoni</h4>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header justify-content-between d-flex d-inline">
                        <h4 class="card-title">Puas dengan layanan kami? yukk isi testimoni anda...</h4>
                        <a href="#" data-toggle="modal" data-target="#tambah"><i class="btn btn-sm btn-primary shadow-sm">Buat Testimoni</i></a>
                      </div>
                    <div class="card-body">
                        @foreach ($testimoni as $item)

                            <figcaption>

                                <i><h3>"{{ $item->komentar }}"</h3></i>
                         
                              </figcaption>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('pelanggan.testimoni.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title"><span>Buat</span> Testimoni</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="komentar">Pesan/Kesan</label>
                        <textarea name="komentar" class="form-control" id="komentar" cols="5" rows="5" required></textarea>
                        @error('komentar')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <i><small>Testimoni hanya bisa dibuat 1 kali saja, dengan syarat sudah melakukan orderan hingga selesai dari salah satu layanan yang ada.</small></i>
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
@endpush