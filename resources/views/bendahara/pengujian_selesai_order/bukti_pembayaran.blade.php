@extends('layouts.admin')
@section('content')

<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <a href="{{ route('bendahara.pengujianSelesai.index') }}"><i class="fas fa-arrow-left"> Kembali</i></a>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header justify-content-between d-flex d-inline">
                        <h4 class="page-title">Bukti Pembayaran {{ $pengujian->nomor_pre }}</h4>
                    </div>
                  
                    <div class="card-body">
                            <div class="modal-body">
                                <div class="form-group col-4">
                                    <label for="tanggal_bayar">Tanggal Kirim (sesuai struk pembayaran dari bank/ATM)</label>
                                    <input type="datetime-local" class="form-control @error('tanggal_bayar') is-invalid @enderror" id="tanggal_bayar" name="tanggal_bayar" value="{{ $pengujian->tanggal_bayar }}" required>
                                    @error('tanggal_bayar')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <a href="{{  Storage::url($pengujian->bukti_bayar)  }}" target="_blank" class="btn btn-info shadow-sm btn-sm">Lihat File</a>
                                </div>
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