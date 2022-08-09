@extends('layouts.admin')
@section('content')

<div class="content">
    <div class="page-inner">
        <div class="page-header">
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header justify-content-between d-flex d-inline">
                        <h4 class="card-title">Profil Saya</h4>
                      </div>
                    <div class="card-body">
                        @if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
                                <form action="{{ route('bendahara.profil.savePassword', auth()->user()->id) }}" method="POST" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="name"><strong>Nama</strong></label>
                                                <input type="text" class="form-control" name="name"  value="{{ $item->name }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="email"><strong>Email</strong></label>
                                                <input type="email" class="form-control" name="email"  value="{{ $item->name }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="tipe_pelanggan"><strong>Tipe Pelanggan</strong></label>
                                                <input type="text" class="form-control" name="id_tipe_pelanggan"  value="{{ $item->tipePelanggan->tipe }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="tipe_pelanggan"><strong>Keterangan Tipe</strong></label>
                                                <input type="text" class="form-control" name="id_tipe_pelanggan"  value="{{ $item->keterangan }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="tipe_pelanggan"><strong>Alamat</strong></label>
                                                <input type="text" class="form-control" name="id_tipe_pelanggan"  value="{{ $item->alamat }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="tipe_pelanggan"><strong>No Hp</strong></label>
                                                <input type="text" class="form-control" name="id_tipe_pelanggan"  value="{{ $item->no_hp }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                                        <label for="new-password"><strong>Password Sebelumnya</strong></label>
                    
                                  
                                    <input id="current-password" type="password" class="form-control" name="current-password" required>
                    
                                            @if ($errors->has('current-password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('current-password') }}</strong>
                                                </span>
                                            @endif
                                     
                                    </div>
                    
                                    <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                                        <label for="new-password"><strong>Password Baru</strong></label>
                    
                              
                                            <input id="new-password" type="password" class="form-control" name="new-password" required>
                    
                                            @if ($errors->has('new-password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('new-password') }}</strong>
                                                </span>
                                            @endif
                                   
                                    </div>
                    
                                    <div class="form-group">
                                        <label for="new-password-confirm"><strong>Confirm New Password</strong></label>
                    
                                  
                                            <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                               
                                    </div>
                    
                    
                                    <button type="submit" class="btn btn-primary btn-block" onclick="return confirm('Yakin ingin mengubah password?');">
                                        Ubah Password
                                    </button>
                    
                                </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection