@extends('layouts.admin')
@section('content')

<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Beranda</h4>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header justify-content-between d-flex d-inline">
                        <h4 class="card-title">Beranda</h4>
                        <a href="#" data-id="{{ $beranda->id }}" data-wa="{{ $beranda->wa }}" data-ig="{{ $beranda->ig }}" data-fb="{{ $beranda->fb }}" data-visi="{{ $beranda->visi }}" data-misi1="{{ $beranda->misi1 }}" data-misi2="{{ $beranda->misi2 }}" data-misi3="{{ $beranda->misi3 }}" data-misi4="{{ $beranda->misi4 }}" data-motto="{{ $beranda->motto }}" data-maklumat="{{ $beranda->maklumat_pelayanan }}" data-judul1="{{ $beranda->judul1 }}" data-isi1="{{ $beranda->isi1 }}" data-judul2="{{ $beranda->judul2 }}" data-isi2="{{ $beranda->isi2 }}" data-judul3="{{ $beranda->judul3 }}" data-isi3="{{ $beranda->isi3 }}" data-pertanyaan1="{{ $beranda->pertanyaan1 }}" data-jawaban1="{{ $beranda->jawaban1 }}" data-pertanyaan2="{{ $beranda->pertanyaan2 }}" data-jawaban2="{{ $beranda->jawaban2 }}" data-pertanyaan3="{{ $beranda->pertanyaan3 }}" data-jawaban3="{{ $beranda->jawaban3 }}" data-pertanyaan4="{{ $beranda->pertanyaan4 }}" data-jawaban4="{{ $beranda->jawaban4 }}"  data-toggle="modal" data-target="#edit"><i class="fas fa-edit">Edit</i></a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Whatsapp</th>
                                <td>{{ $beranda->wa }}</td>
                            </tr>
                            <tr>
                                <th>Instagram</th>
                                <td>{{ $beranda->ig }}</td>
                            </tr>
                            <tr>
                                <th>Facebook</th>
                                <td>{{ $beranda->fb }}</td>
                            </tr>
                            <tr>
                                <th>Visi</th>
                                <td>{{ $beranda->visi }}</td>
                            </tr>
                            <tr>
                                <th>Misi</th>
                                <td><li>{{ $beranda->misi1 }}</li>
                                    <li>{{ $beranda->misi2 }}</li>
                                    <li>{{ $beranda->misi3 }}</li>
                                    <li>{{ $beranda->misi4 }}</li>
                                </td>
                            </tr>
                            <tr>
                                <th>Motto</th>
                                <td>{{ $beranda->motto }}</td>
                            </tr>
                            <tr>
                                <th>Maklumat Pelayanan</th>
                                <td>{{ $beranda->maklumat_pelayanan }}</td>
                            </tr>
                            <tr>
                                <th>Pelayanan 1</th>
                                <td><b>{{ $beranda->judul1 }}</b>
                                <br> <p>{{ $beranda->isi1 }}</p>
                                </td>
                            </tr>
                            <tr>
                                <th>Pelayanan 2</th>
                                <td><b>{{ $beranda->judul2 }}</b>
                                <br> <p>{{ $beranda->isi2 }}</p>
                                </td>
                            </tr>
                            <tr>
                                <th>Pelayanan 3</th>
                                <td><b>{{ $beranda->judul3 }}</b>
                                <br> <p>{{ $beranda->isi3 }}</p>
                                </td>
                            </tr>
                            <tr>
                                <th>QNA 1</th>
                                <td><b>{{ $beranda->pertanyaan1 }}</b>
                                <br> <p>{{ $beranda->jawaban1 }}</p></td>
                            </tr>
                            <tr>
                                <th>QNA 2</th>
                                <td><b>{{ $beranda->pertanyaan2 }}</b>
                                <br> <p>{{ $beranda->jawaban2 }}</p></td>
                            </tr>
                            <tr>
                                <th>QNA 3</th>
                                <td><b>{{ $beranda->pertanyaan3 }}</b>
                                <br> <p>{{ $beranda->jawaban3 }}</p></td>
                            </tr>
                            <tr>
                                <th>QNA 4</th>
                                <td><b>{{ $beranda->pertanyaan4 }}</b>
                                <br> <p>{{ $beranda->jawaban4 }}</p></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-lg">
            <form action="{{ route('admin.beranda.update') }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="id">
                <div class="modal-header">
                    <h5 class="modal-title"><span>Ubah</span> Data Beranda</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="wa">Whatsapp</label>
                            <input type="text" class="form-control" id="wa" name="wa" required>
                        </div>
                        <div class="form-group col-6">
                            <label for="ig">Instagram</label>
                            <input type="text" class="form-control" id="ig" name="ig" required>
                        </div>
                        <div class="form-group col-6">
                            <label for="fb">Facebook</label>
                            <input type="text" class="form-control" id="fb" name="fb" required>
                        </div>
                        <div class="form-group col-6">
                            <label for="visi">Visi</label>
                            <input type="text" class="form-control" id="visi" name="visi" required>
                        </div>
                        <div class="form-group col-6">
                            <label for="misi1">Misi 1</label>
                            <input type="text" class="form-control" id="misi1" name="misi1" required>
                        </div>
                        <div class="form-group col-6">
                            <label for="misi2">Misi 2</label>
                            <input type="text" class="form-control" id="misi2" name="misi2" required>
                        </div>
                        <div class="form-group col-6">
                            <label for="misi3">Misi 3</label>
                            <input type="text" class="form-control" id="misi3" name="misi3" required>
                        </div>
                        <div class="form-group col-6">
                            <label for="misi4">Misi 4</label>
                            <input type="text" class="form-control" id="misi4" name="misi4" required>
                        </div>
                        <div class="form-group col-6">
                            <label for="motto">Motto</label>
                            <input type="text" class="form-control" id="motto" name="motto" required>
                        </div>
                        <div class="form-group col-6">
                            <label for="maklumat_pelayanan">Maklumat Pelayanan</label>
                            <input type="text" class="form-control" id="maklumat_pelayanan" name="maklumat_pelayanan" required>
                        </div>
                        <div class="form-group col-6">
                            <label for="">Pelayanan 1</label>
                            <input type="text" class="form-control" id="judul1" name="judul1" required>
                            <textarea name="isi1" id="isi1" cols="10" rows="5" class="form-control mt-2" required></textarea>
                        </div>
                        <div class="form-group col-6">
                            <label for="">Pelayanan 2</label>
                            <input type="text" class="form-control" id="judul2" name="judul2" required>
                            <textarea name="isi2" id="isi2" cols="10" rows="5" class="form-control mt-2" required></textarea>
                        </div>
                        <div class="form-group col-6">
                            <label for="">Pelayanan 3</label>
                            <input type="text" class="form-control" id="judul3" name="judul3" required>
                            <textarea name="isi3" id="isi3" cols="10" rows="5" class="form-control mt-2" required></textarea>
                        </div>

                        <div class="form-group col-6">
                            <label for="">QNA 1</label>
                            <input type="text" class="form-control" id="pertanyaan1" name="pertanyaan1" required>
                            <textarea name="jawaban1" id="jawaban1" cols="10" rows="5" class="form-control mt-2" required></textarea>
                        </div>
                        <div class="form-group col-6">
                            <label for="">QNA 2</label>
                            <input type="text" class="form-control" id="pertanyaan2" name="pertanyaan2" required>
                            <textarea name="jawaban2" id="jawaban2" cols="10" rows="5" class="form-control mt-2" required></textarea>
                        </div>
                        <div class="form-group col-6">
                            <label for="">QNA 3</label>
                            <input type="text" class="form-control" id="pertanyaan3" name="pertanyaan3" required>
                            <textarea name="jawaban3" id="jawaban3" cols="10" rows="5" class="form-control mt-2" required></textarea>
                        </div>
                        <div class="form-group col-6">
                            <label for="">QNA 4</label>
                            <input type="text" class="form-control" id="pertanyaan4" name="pertanyaan4" required>
                            <textarea name="jawaban4" id="jawaban4" cols="10" rows="5" class="form-control mt-2" required></textarea>
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
        var wa = $(e.relatedTarget).data('wa');
        var ig = $(e.relatedTarget).data('ig');
        var fb = $(e.relatedTarget).data('fb');
        var visi = $(e.relatedTarget).data('visi');
        var misi1 = $(e.relatedTarget).data('misi1');
        var misi2 = $(e.relatedTarget).data('misi2');
        var misi3 = $(e.relatedTarget).data('misi3');
        var misi4 = $(e.relatedTarget).data('misi4');
        var motto = $(e.relatedTarget).data('motto');
        var maklumat = $(e.relatedTarget).data('maklumat');
        var judul1 = $(e.relatedTarget).data('judul1');
        var isi1 = $(e.relatedTarget).data('isi1');
        var judul2 = $(e.relatedTarget).data('judul2');
        var isi2 = $(e.relatedTarget).data('isi2');
        var judul3 = $(e.relatedTarget).data('judul3');
        var isi3 = $(e.relatedTarget).data('isi3');
        var pertanyaan1 = $(e.relatedTarget).data('pertanyaan1');
        var jawaban1 = $(e.relatedTarget).data('jawaban1');
        var pertanyaan2 = $(e.relatedTarget).data('pertanyaan2');
        var jawaban2 = $(e.relatedTarget).data('jawaban2');
        var pertanyaan3 = $(e.relatedTarget).data('pertanyaan3');
        var jawaban3 = $(e.relatedTarget).data('jawaban3');
        var pertanyaan4 = $(e.relatedTarget).data('pertanyaan4');
        var jawaban4 = $(e.relatedTarget).data('jawaban4');
        
        $('#edit').find('input[name="id"]').val(id);
        $('#edit').find('input[name="wa"]').val(wa);
        $('#edit').find('input[name="ig"]').val(ig);
        $('#edit').find('input[name="fb"]').val(fb);
        $('#edit').find('input[name="visi"]').val(visi);
        $('#edit').find('input[name="misi1"]').val(misi1);
        $('#edit').find('input[name="misi2"]').val(misi2);
        $('#edit').find('input[name="misi3"]').val(misi3);
        $('#edit').find('input[name="misi4"]').val(misi4);
        $('#edit').find('input[name="motto"]').val(motto);
        $('#edit').find('input[name="maklumat_pelayanan"]').val(maklumat);
        $('#edit').find('input[name="judul1"]').val(judul1);
        $('#edit').find('textarea[name="isi1"]').val(isi1);
        $('#edit').find('input[name="judul2"]').val(judul2);
        $('#edit').find('textarea[name="isi2"]').val(isi2);
        $('#edit').find('input[name="judul3"]').val(judul3);
        $('#edit').find('textarea[name="isi3"]').val(isi3);
        $('#edit').find('input[name="pertanyaan1"]').val(pertanyaan1);
        $('#edit').find('textarea[name="jawaban1"]').val(jawaban1);
        $('#edit').find('input[name="pertanyaan2"]').val(pertanyaan2);
        $('#edit').find('textarea[name="jawaban2"]').val(jawaban2);
        $('#edit').find('input[name="pertanyaan3"]').val(pertanyaan3);
        $('#edit').find('textarea[name="jawaban3"]').val(jawaban3);
        $('#edit').find('input[name="pertanyaan4"]').val(pertanyaan4);
        $('#edit').find('textarea[name="jawaban4"]').val(jawaban4);
    });
    
</script>
@endpush