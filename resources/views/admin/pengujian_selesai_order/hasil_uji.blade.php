@extends('layouts.admin')
@section('content')

<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <a href="{{ route('admin.pengujianSelesai.getOrder', $id_pengujian_order) }}"><i class="fas fa-arrow-left"> Kembali</i></a>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header justify-content-between d-flex d-inline">
                        <h4 class="card-title">Orderan {{ $nomor_order }} | {{ $nama_sampel }} | {{ $kode_sampel }}</h4>
                      </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover" >
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Parameter</th>
                                        <th>Metode Uji</th>
                                        <th>Satuan</th>
                                        <th>Baku Mutu</th>
                                        <th>Hasil Pengujian</th>
                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach($parameter_order as $p)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $p->parameterSampel->nama_parameter }}</td>
                                        <td>{{ $p->metode_uji }}</td>
                                        <td>{{ $p->satuan }}</td>
                                        <td>{{ $p->baku_mutu }}</td>
                                        <td>{{ $p->hasil_pengujian }}</td>
                                   
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
            <form action="{{ route('admin.pengujianSelesai.updateHasil') }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="id">
                <div class="modal-header">
                    <h5 class="modal-title"><span></span> Hasil Uji</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="parameter">Parameter Sampel</label>
                        <input type="text" class="form-control @error('parameter') is-invalid @enderror" id="parameter" name="parameter" required readonly>
                        @error('parameter')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="metode_uji">Metode</label>
                        <input type="text" class="form-control @error('metode_uji') is-invalid @enderror" id="metode_uji" name="metode_uji" required>
                        @error('metode_uji')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="satuan">Satuan</label>
                        <input type="text" class="form-control @error('satuan') is-invalid @enderror" id="satuan" name="satuan" required>
                        @error('satuan')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="baku_mutu">Baku Mutu</label>
                        <input type="text" class="form-control @error('baku_mutu') is-invalid @enderror" id="baku_mutu" name="baku_mutu" required>
                        @error('baku_mutu')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="hasil_pengujian">Hasil Pengujian</label>
                        <input type="text" class="form-control @error('hasil_pengujian') is-invalid @enderror" id="hasil_pengujian" name="hasil_pengujian" required>
                        @error('hasil_pengujian')
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
        var parameter = $(e.relatedTarget).data('parameter');
        var metode = $(e.relatedTarget).data('metode');
        var satuan = $(e.relatedTarget).data('satuan');
        var baku = $(e.relatedTarget).data('baku');
        var hasil = $(e.relatedTarget).data('hasil');
        
        $('#edit').find('input[name="id"]').val(id);
        $('#edit').find('input[name="parameter"]').val(parameter);
        $('#edit').find('input[name="metode_uji"]').val(metode);
        $('#edit').find('input[name="satuan"]').val(satuan);
        $('#edit').find('input[name="baku_mutu"]').val(baku);
        $('#edit').find('input[name="hasil_pengujian"]').val(hasil);

   
    });
    
</script>
@endpush