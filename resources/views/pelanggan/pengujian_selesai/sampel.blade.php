@extends('layouts.admin')
@section('content')

<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <a href="{{ route('pelanggan.pengujianSelesai.index') }}"><i class="fas fa-arrow-left"> Kembali</i></a>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header justify-content-between d-flex d-inline">
                        <h4 class="card-title">List Orderan {{ $nomor_pre }}</h4>
                        @if ($status == 1)
                        <a href="{{ route('pelanggan.pengujianSelesai.createSampel', $id_pengujian_order) }}"><i class="btn btn-sm btn-primary shadow-sm">+ Tambah Sampel</i></a>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Sampel</th>
                                        <th>Jenis Sampel</th>
                                        <th>Parameter</th>
                                        <th>Catatan</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 1;
                                    @endphp
                                    @foreach($sampel_order as $s)
                                    <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $s->kode_sampel }}</td>
                                    <td>{{ $s->sampelUji->nama_sampel }}</td>
                                    <td>
                                        @foreach ($s->parameterSampelOrder as $parameter)
                                        <li>{{ $parameter->parameterSampel->nama_parameter }}</li>
                                    @endforeach
                                    </td>
                                    <td>@if ($s->catatan_pelanggan)
                                        {{ $s->catatan_pelanggan }}
                                        @else
                                        ---
                                    @endif</td>
                                    <td>@currency($s->harga)</td>
                                    <td>
                                        @if ($status >= 10)
                                        <a href="{{ route('pelanggan.pengujianSelesai.hasilUji', ['order'=>$nomor_pre, 'id'=>$s->id]) }}" class="btn btn-info btn-xs my-1">Lihat Hasil</a>
                                        @endif
                                        @if ($s->foto_shu1 && $s->foto_shu2)
                                        <a href="{{ route('pelanggan.pengujianSelesai.cetakShuPelanggan', $s->id) }}" target="_blank"><i class="btn btn-xs btn-primary shadow-sm my-1">Lihat PDF Sertifikat</i></a> 
                                        @endif
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

<div class="modal fade bd-example-modal-lg" data-backdrop="static" id="tambah" tabindex="-1" role="dialog"
    aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog mw-100 w-75" role="document">
        <div class="modal-content">
            <form action="{{ route('pelanggan.pengujianSelesai.createSampelParameter') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title"><span>Tambah</span> Sampel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4">
                            <label for="kode_sampel">Kode Sampel</label>
                            <input type="text" name="kode_sampel" class="form-control" required>
                            @error('kode_sampel')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <input type="hidden" name="id_pengujian_order" value="{{ $id_pengujian_order }}">
                        <div class="col-8">
                            <label for="catatan_pelanggan">Catatan <i><small>(bila ada)</small></i></label>
                            <input type="text" name="catatan_pelanggan" class="form-control">
                            @error('catatan_pelanggan')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="asal_sampel">Asal Contoh</label>
                            <select name="asal_sampel" id="asal_sampel" class="custom-select @error('asal_sampel') is-invalid @enderror">
                                <option value="0">Bawa Sendiri</option>
                                <option value="1">Sampling</option>
                            </select>
                            @error('asal_contoh')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <label for="sampel">Pilih Sampel</label>
                                <select name="sampel" class="form-control" style="width:250px" required>
                                    <option value="">--- Pilih Sampel ---</option>
                                    @foreach ($sampel as $item)
                                    <option  @if ($item->status == 0)
                                        disabled="disabled"
                                    @endif value="{{ $item->id }}">{{ $item->nama_sampel }}</option>
                                    @endforeach
                                </select>
                                @error('sampel')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group border border-color-dark mt-2">
                                <label for="sampel">Total Harga</label>
                                <p id="harga"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="cek">
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
            <form action="{{ route('pelanggan.pengujianSelesai.deleteSampelParameter') }}" method="POST">
                @csrf
                @method('delete')
                <input type="hidden" name="id">
                <div class="modal-header">
                    <h5 class="modal-title"><span>Hapus</span> Sampel</h5>
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

{{-- <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog mw-100 w-75" role="document">
        <div class="modal-content">
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title"><span>Edit</span> Parameter</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4">
                            <label for="kode_sampel">Kode Sampel</label>
                            <input type="text" name="kode_sampel" class="form-control">
                            @error('kode_sampel')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <input type="hidden" name="id_pengujian_order" value="{{ $id_pengujian_order }}">
                        <div class="col-8">
                            <label for="catatan_pelanggan">Catatan <i><small>(bila ada)</small></i></label>
                            <input type="text" name="catatan_pelanggan" class="form-control">
                            @error('catatan_pelanggan')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="asal_sampel">Asal Contoh</label>
                            <select name="asal_sampel" id="asal_sampel" class="custom-select @error('asal_sampel') is-invalid @enderror">
                                <option value="0">Bawa Sendiri</option>
                                <option value="1">Sampling</option>
                            </select>
                            @error('asal_contoh')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <label for="sampel">Pilih Sampel</label>
                                <select readonly="readonly" name="sampel" class="form-control" style="width:250px">
                                    <option value="">--- Select Sampel ---</option>
                                    @foreach ($sampel as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                                @error('sampel')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group border border-color-dark mt-2">
                                <label for="sampel">Total Harga</label>
                                <p id="harga"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="cek">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div> --}}


@endsection

@push('scripts')
<script>
    document.querySelectorAll("select[readonly] > option:not([selected])").forEach( (el) => el.setAttribute("disabled", "disabled") );

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

<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('select[name="sampel"]').on('change', function () {
            var sampelID = jQuery(this).val();
            if (sampelID) {
                jQuery.ajax({
                    url: '/pelanggan/pengujian/getParameter/' + sampelID,
                    type: "GET",
                    dataType: "json",
                    success: function (response) {
                        jQuery('#cek').empty();
                        jQuery('#harga').empty();
                        jQuery.each(response.data, function (key, item) {
                            $("#cek").append(
                                '<div class="col-sm-4"><div class="form-group clearfix border border-color-dark"><div class="d-inline"><input type="checkbox" class="coba" name="parameter[]" data-harga = "' +
                                item.harga + '" value="' +
                                item.id + '" id="parameter' + item.id +
                                '"><label for="parameter' + item.id +
                                '">&nbsp;&nbsp;' + item.nama_parameter +
                                '</label><label class="d-flex justify-content-end">' +
                                formatRupiah(item.harga, 'Rp. ') +
                                '</label></div></div></div>');
                        });
                        $(".coba").change(function () {
                            var totalPrice = 0,
                                values = [];
                            $('input[type=checkbox]').each(function () {
                                if ($(this).is(':checked')) {
                                    values.push($(this).data('harga'));
                                    totalPrice += parseInt($(this).data('harga'));
                                }
                            });
                            $("#harga").text(formatRupiah(totalPrice, 'Rp. '));
                        });
                    }
                });
            } else {
                $("#cek").empty();
            }
        });
    });

    function formatRupiah(angka, prefix) {
        var number_string = angka.toString().replace(/[^,\d]/g, ''),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>
@endpush