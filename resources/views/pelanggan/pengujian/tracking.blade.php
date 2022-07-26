@extends('layouts.admin')
@section('content')

<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <a href="{{ route('pelanggan.pengujian.index') }}"><i class="fas fa-arrow-left"> Kembali</i></a>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header justify-content-between d-flex d-inline">
                        <h4 class="card-title">Tracking Orderan  {{ $nomor_order }}</h4>
                      </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="timeline">
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($timeline as $t)
                                    @php
                                        $i++;
                                    @endphp
                                    <li class="@if ($i % 2 == 0)
                                    @else
                                    timeline-inverted
                                    @endif" >
                                    <div class="
                                    @if ($t->id_status_pengujian == 1 || $t->id_status_pengujian == 2 || $t->id_status_pengujian == 6 || $t->id_status_pengujian == 7 || $t->id_status_pengujian == 8 || $t->id_status_pengujian == 9 || $t->id_status_pengujian == 10)
                                    timeline-badge info
                                    @elseif($t->id_status_pengujian == 3)
                                    timeline-badge danger
                                    @elseif($t->id_status_pengujian == 13)
                                    timeline-badge success
                                    @else 
                                    timeline-badge secondary
                                    @endif
                                    "><i class="flaticon-success"></i></div>
                                        <div class="timeline-panel">
                                            <div class="timeline-heading">
                                                <h4 class="timeline-title">{{ $t->statusPengujian->status_pelanggan }}</h4>
                                                <p><small class="text-muted"><i class="flaticon-time"></i>{{ \Carbon\Carbon::parse($t->tanggal)->format('d-M-Y , H:i:s') }}</small></p>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection