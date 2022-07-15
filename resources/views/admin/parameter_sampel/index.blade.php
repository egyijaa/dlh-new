@extends('layouts.admin')
@section('content')

<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Parameter Sampel</h4>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header justify-content-between d-flex d-inline">
                        <h4 class="card-title">Parameter Sampel</h4>
                        <a href="#" data-toggle="modal" data-target="#tambah"><i class="btn btn-sm btn-primary shadow-sm">+ Tambah</i></a>
                      </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover" >
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Sampel</th>
                                        <th>Parameter</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach($parameter_sampel as $ps)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $ps->sampelUji->nama_sampel }}</td>
                                        <td>{{ $ps->nama_parameter }}</td>
                                        <td>@currency($ps->harga)</td>
                                        <td>
                                            <a href="#" data-id="{{ $ps->id }}" data-namasampel="{{ $ps->id_sampel_uji }}" data-namaparameter="{{ $ps->nama_parameter }}" data-harga="{{ $ps->harga }}"  data-toggle="modal" data-target="#edit"><i class="fas fa-edit"></i></a> | 
                                            <a href="#" data-target="#delete" data-toggle="modal" data-id="{{ $ps->id }}"><i class="fas fa-trash"></i></a>
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


<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.parameter-sampel.update') }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="id">
                <div class="modal-header">
                    <h5 class="modal-title"><span>Ubah</span> Data Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="namasampel">Nama Sampel</label>
                        <select name="namasampel" id="namasampel" class="custom-select @error('namasampel') is-invalid @enderror">
                            <option value="">~ Pilih Sampel ~</option>
                            @foreach($sampel_uji as $su)
                                <option value="{{ $su->id }}">{{ $su->nama_sampel }}</option>
                            @endforeach
                        </select>
                        @error('namasampel')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="namaparameter">Nama Parameter</label>
                        <input type="text" class="form-control @error('namaparameter') is-invalid @enderror" id="namaparameter" name="namaparameter" required>
                        @error('namaparameter')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" required>
                        @error('harga')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
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
            <form action="{{ route('admin.parameter-sampel.delete') }}" method="POST">
                @csrf
                @method('delete')
                <input type="hidden" name="id">
                <div class="modal-header">
                    <h5 class="modal-title"><span>Hapus</span> Data Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus Data ini ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.parameter-sampel.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id">
                <div class="modal-header">
                    <h5 class="modal-title"><span>Tambah</span> Data Parameter Sampel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="namasampel">Nama Sampel</label>
                        <select name="id_sampel_uji" id="id_sampel_uji" class="custom-select @error('id_sampel_uji') is-invalid @enderror">
                            <option value="">~ Pilih Sampel ~</option>
                            @foreach($sampel_uji as $su)
                                <option value="{{ $su->id }}">{{ $su->nama_sampel }}</option>
                            @endforeach
                        </select>
                        @error('id_sampel_uji')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nama_parameter">Nama Parameter</label>
                        <input type="text" class="form-control @error('nama_parameter') is-invalid @enderror" id="nama_parameter" name="nama_parameter" required>
                        @error('nama_parameter')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" required>
                        @error('harga')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
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
        var namasampel = $(e.relatedTarget).data('namasampel');
        var namaparameter = $(e.relatedTarget).data('namaparameter');
        var harga = $(e.relatedTarget).data('harga');
        
        $('#edit').find('input[name="id"]').val(id);
        $('#edit').find('input[name="namaparameter"]').val(namaparameter);
        $('#edit').find('select[name="namasampel"]').val(namasampel);
        $('#edit').find('input[name="harga"]').val(harga);
    });
    
    $('#delete').on('show.bs.modal', (e) => {
        var id = $(e.relatedTarget).data('id');
        console.log(id);
        $('#delete').find('input[name="id"]').val(id);
    });
</script>
@endpush