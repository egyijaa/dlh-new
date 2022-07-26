@extends('layouts.admin')
@section('content')

<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <a href="{{ route('pelanggan.pengambilanSampel.index') }}"><i class="fas fa-arrow-left"> Kembali</i></a>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header justify-content-between d-flex d-inline">
                        <h4 class="card-title"><b>Edit Pengambilan Sampel {{ $pengambilan->nomor_pre }}</b></h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('pelanggan.pengambilanSampel.updateOrder', $pengambilan->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="tanggal_isi">Tanggal order</label>
                                        @php
                                            $now = \Carbon\Carbon::now('Asia/Jakarta')->format('Y-m-d');
                                        @endphp
                                        <input type="date" readonly value="{{ $pengambilan->tanggal_isi }}" class="form-control @error('tanggal_isi') is-invalid @enderror" id="tanggal_isi" name="tanggal_isi">
                                        @error('tanggal_isi')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="nomor_surat">Nomor Surat <i><small>bila ada</small></i></label>
                                        <input type="text" class="form-control @error('nomor_surat') is-invalid @enderror" id="nomor_surat" name="nomor_surat" value="{{ $pengambilan->nomor_surat }}">
                                        @if($pengambilan->file_surat)
                                            <a href="{{  Storage::url($pengambilan->file_surat)  }}" target="_blank" class="btn btn-info btn-sm">Klik Disini untuk membuka file</a>
                                          <br>
                                        @else 
                                          Tidak ada file
                                        @endif
                                        <input type="file" name="file_surat">
                                        @error('nomor_surat')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="nama_pemesan">Nama*</label>
                                        <input type="text" class="form-control @error('nama_pemesan') is-invalid @enderror" id="nama_pemesan" name="nama_pemesan" value="{{ $pengambilan->nama_pemesan }}" required>
                                        @error('nama_pemesan')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                   </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="nik">NIK*</label>
                                        <input type="number" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" value="{{ $pengambilan->nik }}" required>
                                        @error('nik')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email">Email*</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $pengambilan->email }}" required>
                                        @error('email')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="id_tipe_pelanggan">Tipe Pelanggan*</label>
                                        <select name="id_tipe_pelanggan" id="id_tipe_pelanggan" class="custom-select @error('id_tipe_pelanggan') is-invalid @enderror" required>
                                            <option value="">~ Pilih Asal ~</option>
                                            @foreach($tipe_pelanggan as $tp)
                                                <option value="{{ $tp->id }}" {{ $pengambilan->tipePelanggan->id == $tp->id ? 'selected' : '' }}>{{ $tp->tipe }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_tipe_pelanggan')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
        
                                        <label for="keterangan">Keterangan Asal*</label>
                                        <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" value="{{ $pengambilan->keterangan }}" required>
                                        @error('keterangan')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="no_hp">No Hp (WhatsApp)*</label>
                                        <input type="number" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" value="{{ $pengambilan->no_hp }}" required>
                                        @error('no_hp')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="alamat">Alamat Lengkap*</label>
                                        <textarea name="alamat" class="form-control" id="alamat" cols="5" rows="5" required>{{ $pengambilan->alamat }}</textarea>
                                        @error('alamat')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h3 class="ml-2"><b>Jasa Pelayanan</b></h3>
                                <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label" for="jasa_pelayanan">Pengambilan Sampel*</label>
                                            <div class="selectgroup w-100 col-9">
                                                <label class="selectgroup-item">
                                                    <input value="Dalam Kota Pontianak" type="radio" name="jasa_pelayanan" id="jasa_pelayanan" class="selectgroup-input" {{ $pengambilan->jasa_pelayanan == "Dalam Kota Pontianak" ? 'checked' : '' }}>
                                                    <span class="selectgroup-button">Dalam Kota Pontianak</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input value="Luar Kota Pontianak" type="radio" name="jasa_pelayanan" id="jasa_pelayanan" class="selectgroup-input" {{ $pengambilan->jasa_pelayanan == "Luar Kota Pontianak" ? 'checked' : '' }}>
                                                    <span class="selectgroup-button">Luar Kota Pontianak</span>
                                                </label>
                                            </div>
                                        </div>
                                        @error('jasa_pelayanan')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group border border-color-dark mt-2">
                                            <label for="sampel">Total Harga (jenis sampel x titik sampling)</label>
                                            <br>
                                            <span style="font-size: 120%" id="harga"
                                                class="badge badge-primary text-bold">@currency($pengambilan->total_harga)</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label" for="jenis_sampel">Jenis Sampel*</label>
                                            <br>
                                            <div class="selectgroup selectgroup-pills">
                                                @foreach ($sampel as $item)
                                                        @if ($item->nama_sampel == 'Kebisingan')
                                                        @else
                                                            @if ($item->status != 0)
                                                            <label class="selectgroup-item">
                                                                <input type="radio" class="hargaSampel selectgroup-input" name="jenis_sampel" id="jenis_sampels" data-harga="{{ $item->harga }}" value="{{ $item->id }}" {{ $pengambilan->sampelUji->id == $item->id ? 'checked' : '' }}>
                                                                <span class="selectgroup-button">{{ $item->nama_sampel }} | @currency($item->harga)</span>
                                                            </label>
                                                            @else
                                                            <label class="selectgroup-item outOffStock">
                                                                <input type="radio" class="selectgroup-input" disabled>
                                                                <span class="selectgroup-button"><s>{{ $item->nama_sampel }} | @currency($item->harga)</s></span>
                                                            </label>
                                                            @endif
                                                        @endif
                                                @endforeach
                                            </div>
                                            @error('jenis_sampel')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="tanggal_sampling"><b>Hari/Tanggal Sampling*</b></label>
                                        <input type="date" class="form-control @error('tanggal_sampling') is-invalid @enderror" id="tanggal_sampling" name="tanggal_sampling" value="{{ $pengambilan->tanggal_sampling }}"  required>
                                        @error('tanggal_sampling')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label for="persyaratan_pelanggan"><b>Persyaratan Pelanggan</b> <i><small>(Jika ada)</small></i></label>
                                        <input type="text" class="form-control @error('persyaratan_pelanggan') is-invalid @enderror" id="persyaratan_pelanggan" name="persyaratan_pelanggan" value="{{ $pengambilan->persyaratan_pelanggan }}">
                                        @error('persyaratan_pelanggan')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <label for="alamat_sampling"><b>Lokasi Pengambilan Sampel* <i><small>(diisi dengan lengkap)</small></i></b></label>
                                        <textarea name="alamat_sampling" class="form-control" id="alamat_sampling" cols="5" rows="5" required placeholder="cth : Jln. Nusa Indah, gg. merak,  di depan warung bu aci no. 20">{{ $pengambilan->alamat_sampling }}</textarea>
                                        @error('alamat_sampling')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label for="pendamping_sampling"><b>Pendamping Saat Sampling*</b></label>
                                        <textarea name="pendamping_sampling" class="form-control" id="pendamping_sampling" cols="5" rows="5" required>{{ $pengambilan->pendamping_sampling }}</textarea>
                                        @error('pendamping_sampling')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="jumlah_lokasi_sampling"><b>Jumlah Lokasi Sampling*</b></label>
                                            <input type="number"
                                                class="form-control @error('jumlah_lokasi_sampling') is-invalid @enderror"
                                                id="jumlah_lokasi_sampling" name="jumlah_lokasi_sampling" value="{{ $pengambilan->jumlah_lokasi_sampling }}" required>
                                            @error('jumlah_lokasi_sampling')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="jumlah_titik_sampling"><b>Jumlah Titik Sampling*</b></label>
                                            <input type="number"
                                                class="form-control @error('jumlah_titik_sampling') is-invalid @enderror"
                                                id="jumlah_titik_sampling" name="jumlah_titik_sampling" value="{{ $pengambilan->jumlah_titik_sampling }}" required>
                                            @error('jumlah_titik_sampling')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-lg-3">
                                        <div class="form-group">
                                            <label class="form-label" for="volume_sampel">Volume Sampel*</label>
                                                <div class="selectgroup w-100">
                                                @foreach ($volume as $v)
                                                    <label class="selectgroup-item">
                                                        <input type="radio" name="volume_sampel" id="volume_sampel" class="selectgroup-input" value="{{ $v->id }}" {{ $pengambilan->volumeSampel->id == $v->id ? 'checked' : '' }} required>
                                                        <span class="selectgroup-button">{{ $v->volume }} L</span>
                                                    </label>
                                                    @endforeach
                                                </div>
                                            @error('volume_sampel')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <li>Pelanggan memastikan lokasi sampling dapat diakses dan aman bagi petugas pengambil sampel uji</li>
                                            <li>Jika saat pengambilan sampel ternyata volume sampel tidak terwakilkan maka pengambilan sampel tidak dapat dilakukan dan biaya sampling tidak dapat dikembalikan</li>
                                            <li>Jika pengambilan sampel membutuhkan wadah khusus sampel (botol kaca/ wadah gelap), maka wadah tersebut disediakan oleh pelanggan.</li>
                                            <li>Transportasi dan akomodasi sampling di luar Kota Pontianak ditanggung oleh pengguna jasa</li>
                                        </div>
                                    </div>
                                </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="konfirmasi" id="konfirmasi" required> &nbsp;<label for="konfirmasi">Saya Setuju Dengan Persyaratan diatas</label>
                                    </div>
                              
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
<script>
    document.querySelectorAll("select[readonly] > option:not([selected])").forEach((el) => el.setAttribute("disabled",
        "disabled"));
</script>

<script type="text/javascript">
    jQuery(document).ready(function () {
        $(".outOffStock").click(function () {
            swal("Disabled!", "Jenis sampel yang anda pilih masih belum tersedia!", "warning");
        });

        var today = new Date();
        var dd = today.getDate() + 2;
        var mm = today.getMonth() + 1; //January is 0 so need to add 1 to make it 1!
        var yyyy = today.getFullYear();
        if (dd < 10) {
            dd = '0' + dd
        }
        if (mm < 10) {
            mm = '0' + mm
        }
        today = yyyy + '-' + mm + '-' + dd;
        document.getElementById("tanggal_sampling").setAttribute("min", today);

        $(".hargaSampel").change(function () {
            console.log($("#jumlah_titik_sampling").val());
            if ($("#jumlah_titik_sampling").val() != '') {
                hitung();
            } else {
                $("#harga").text(formatRupiah($("input[type='radio'][name='jenis_sampel']:checked")
                    .data('harga'), 'Rp. '));
            }
        });
        
        $("#jumlah_titik_sampling").keyup(function () {
            if (!$("input[type='radio'][name='jenis_sampel']").is(":checked")) {
                $("#harga").text(formatRupiah(0, 'Rp. '));
            } else if ($("#jumlah_titik_sampling").val() != '') {
                hitung();
            } else {
                $("#harga").text(formatRupiah($("input[type='radio'][name='jenis_sampel']:checked")
                    .data('harga'), 'Rp. '));
            }
        });

        function hitung() {
            var totalPrice = $("input[type='radio'][name='jenis_sampel']:checked").data('harga') * $(
                "#jumlah_titik_sampling").val();
            $("#harga").text(formatRupiah(totalPrice, 'Rp. '));
        }
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
                                    totalPrice += parseInt($(this).data(
                                        'harga'));
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