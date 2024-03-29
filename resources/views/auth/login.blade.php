@extends('layouts.frontend')
@section('content')
<div class="body">
    <div role="main" class="main">

        <section class="page-header page-header-modern bg-color-light-scale-1 page-header-lg">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 align-self-center p-static order-2 text-center">
                        <a href="/"><img alt="Porto" width="100" height="90" data-sticky-width="82" data-sticky-height="40" data-sticky-top="0" src="{{ url('frontend/img/demos/logopemkot.png') }}"></a>
                    </div>
                </div>
            </div>
        </section>

        <div class="container py-4">

            <div class="row justify-content-md-center">
                <div class="col-md-9">
                    <div class="featured-box featured-box-dark text-start mt-0">
                        <div class="box-content">
                            <h4 class="text-color-primary font-weight-semibold text-4 text-uppercase mb-3">I'm a Returning Customer</h4>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="row">
                                    <div class="form-group col">
                                        <label class="form-label">E-mail Address</label>
                                        <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label class="form-label">Password</label>
                                        <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="captcha" class="col-md-4 col-form-label text-md-right">Captcha</label>
                                    <div class="col-md-6 captcha">
                                        <span>{!! captcha_img() !!}</span>
                                        <button type="button" class="btn btn-danger" class="reload" id="reload">
                                        &#x21bb;
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="captcha" class="col-md-4 col-form-label text-md-right">Enter Captcha</label>
                                    <div class="col-md-6">
                                        <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha" required>
                                    </div>
                                    @error('captcha')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="rememberme" class="custom-control-input" id="rememberme">
                                            <label class="custom-control-label text-2" for="rememberme">Remember Me</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <input type="submit" value="Login" class="btn btn-primary btn-modern float-end" data-loading-text="Loading...">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-12 d-flex justify-content-center">
                                        <label class="custom-control-label text-2" for="rememberme">Belum Punya Akun?</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-12 d-flex justify-content-center">
                                        <a href="/register" class="btn btn-dark btn-modern" data-loading-text="Loading...">Register</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    $('#reload').click(function () {
        $.ajax({
            type: 'GET',
            url: 'reload-captcha',
            success: function (data) {
                $(".captcha span").html(data.captcha);
            }
        });
    });
</script>
@endpush
