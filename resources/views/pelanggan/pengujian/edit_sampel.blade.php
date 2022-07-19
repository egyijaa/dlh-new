@extends('layouts.admin')
@section('content')

<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <a href="javascript: history.go(-1)"><i class="fas fa-arrow-left"> Kembali</i></a>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header justify-content-between d-flex d-inline">
                        <h4 class="card-title">Edit Sampel Order {{ $sampel_order->pengujianOrder->nomor_pre }}</h4>
                    </div>
                    <div class="card-body">
                            <form action="{{ route('pelanggan.pengujian.updateSampelParameter', $sampel_order->id) }}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                    <div class="row">
                                        <div class="col-4">
                                            <label for="kode_sampel">Kode Sampel</label>
                                            <input type="text" name="kode_sampel" class="form-control" value="{{ $sampel_order->kode_sampel }}" required>
                                            @error('kode_sampel')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <input type="hidden" name="id_pengujian_order" value="{{ $sampel_order->id_pengujian_order }}">
                                        <div class="col-8">
                                            <label for="catatan_pelanggan">Catatan <i><small>(bila ada)</small></i></label>
                                            <input type="text" name="catatan_pelanggan" class="form-control" value="{{ $sampel_order->catatan_pelanggan }}">
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
                                                <option value="0" {{ $sampel_order->asal_sampel == 0 ? 'selected' : '' }}>Bawa Sendiri</option>
                                                <option value="1" {{ $sampel_order->asal_sampel == 1 ? 'selected' : '' }}>Sampling</option>
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
                                                <select name="sampel" class="form-control" style="width:250px" required readonly>
                                                    <option value="">--- Pilih Sampel ---</option>
                                                    @foreach ($sampel as $item)
                                                    <option  @if ($item->status == 0)
                                                        disabled="disabled"
                                                    @endif value="{{ $item->id }}" {{ $sampel_order->sampelUji->id == $item->id ? 'selected' : '' }}>{{ $item->nama_sampel }}</option>
                                                    @endforeach
                                                </select>
                                                @error('sampel')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        @php
                                            $getSampel = App\Models\ParameterSampel::with('parameterSampelOrder')->where('id_sampel_uji', $sampel_order->sampelUji->id)->get();
                                        @endphp

                                        <div class="col-4">
                                            <div class="form-group border border-color-dark mt-2">
                                                <label for="sampel">Total Harga</label>
                                                <p id="harga">{{ $sampel_order->harga }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="cek">
                                        @foreach ($getSampel as $item)
                                            <div class="col-sm-4"><div class="form-group clearfix border border-color-dark"><div class="d-inline">
                                            
                                                <input type="checkbox" class="coba" name="parameter[]" data-harga = "{{ $item->harga }}" value="{{ $item->id }}" id="parameter{{ $item->id }}" 
                                                @foreach ($item->parameterSampelOrder as $parameter)
                                                {{  ($parameter->id_parameter_sampel == $item->id ? ' checked' : '') }}
                                                @endforeach
                                                >
                                                <label for="parameter{{ $item->id }}">&nbsp;&nbsp;
                                                {{ $item->nama_parameter }}
                                                </label><label class="d-flex justify-content-end">
                                                @currency($item->harga)
                                                </label></div></div></div>
                                        @endforeach
                          

                                    </div>

                               
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-success">Simpan</button>
                               
                            </form>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.querySelectorAll("select[readonly] > option:not([selected])").forEach( (el) => el.setAttribute("disabled", "disabled") );
</script>

<script type="text/javascript">
    // jQuery(document).ready(function () {
    //     jQuery('select[name="sampel"]').on('change', function () {
    //         var sampelID = jQuery(this).val();
    //         if (sampelID) {
    //             jQuery.ajax({
    //                 url: '/pelanggan/pengujian/getParameter/' + sampelID,
    //                 type: "GET",
    //                 dataType: "json",
    //                 success: function (response) {
    //                     jQuery('#cek').empty();
    //                     jQuery('#harga').empty();
    //                     jQuery.each(response.data, function (key, item) {
    //                         $("#cek").append(
    //                             '<div class="col-sm-4"><div class="form-group clearfix border border-color-dark"><div class="d-inline"><input type="checkbox" class="coba" name="parameter[]" data-harga = "' +
    //                             item.harga + '" value="' +
    //                             item.id + '" id="parameter' + item.id +
    //                             '"><label for="parameter' + item.id +
    //                             '">&nbsp;&nbsp;' + item.nama_parameter +
    //                             '</label><label class="d-flex justify-content-end">' +
    //                             formatRupiah(item.harga, 'Rp. ') +
    //                             '</label></div></div></div>');
    //                     });
    //                     $(".coba").change(function () {
    //                         var totalPrice = 0,
    //                             values = [];
    //                         $('input[type=checkbox]').each(function () {
    //                             if ($(this).is(':checked')) {
    //                                 values.push($(this).data('harga'));
    //                                 totalPrice += parseInt($(this).data('harga'));
    //                             }
    //                         });
    //                         $("#harga").text(formatRupiah(totalPrice, 'Rp. '));
    //                     });
    //                 }
    //             });
    //         } else {
    //             $("#cek").empty();
    //         }
    //     });
    // });

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