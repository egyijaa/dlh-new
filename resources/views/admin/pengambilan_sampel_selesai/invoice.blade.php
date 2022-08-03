<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice {{ $pengambilan_order->nomor_pre }}</title>
    <style>
        body {
            font-family: 'Calibri', Candara, Segoe, "Segoe UI", Optima, Arial, sans-serif;
        }

        .center {
            margin: auto;
            width: 50%;
            padding: 5px;
            text-align: center;
        }

        .parent {
            margin-bottom: 15px;
            padding: 10px;
            clear: both;
        }

        .left,
        .center2,
        .right {
            float: left;
            width: 32%;
            padding: 5px;

        }

        .table,
        .th,
        .td {
            border-bottom: 2.5px solid black;
            border-collapse: collapse;
        }

        .table2,
        .th2,
        .td2 {
            border-bottom: 1px solid rgba(0,0,0,0.1);
            border-collapse: collapse;
            padding: 5px 0 5px 0;
        }

        .tdBG {
            background-color: #74CD53;
        }
        footer {
        width: 100%;
        position: absolute;
        right: 0;
        bottom: 100px;
        height: 6.5%;
        }
    </style>
</head>

<body>
    <table class="table2" style="width:100%; padding-left: 25px; padding-right: 25px; padding-bottom: 8px;">
        <tr style="font-size: 12px;">
            <td class="th2" colspan="3" style="border-bottom: 1px solid rgba(0,0,0,0);"><b>{{ $pengambilan_order->nama_pemesan }}</b><br>{{ $pengambilan_order->alamat }}<br>{{ $pengambilan_order->no_hp }}<br>{{ $pengambilan_order->email }}</td>
            <td class="th2" style="width:31%; border-bottom: 1px solid rgba(0,0,0,0);"><b>Tanggal Order:</b> {{ date('d M Y', strtotime($pengambilan_order->tanggal_isi)) }}<br><br><b>Status Order:</b><span style="font-size: 13px; color:#808080">&nbsp;
            @if ($pengambilan_order->statusPengambilanSampel->id <= 4)
                Belum Bayar
            @else
                Sudah Bayar
            @endif
            </span>
            <br><br>
            @php
            $jatuh_tempo = \Carbon\Carbon::parse($tanggal_buat)->addDays(2);
            @endphp
            <b>Batas Tanggal Pembayaran : {{  $jatuh_tempo->format('d M Y') }} </b>
            </td>

        </tr>
    </table>

    <table class="table2" style="width:100%; padding-left: 25px; padding-right: 25px; padding-bottom: 8px;">
        <tr>
            <td class="th2" colspan="4" style="font-size: 14px;"><b>Silahkan Transfer Ke:</b>
            <br>
            Bank Kalbar
            <br>
            Nomor Rekening : 1001013501
            <br>
            Atas nama : BEND PENERIMAAN DLH KOTA PTK
            
            </td>
        </tr>
    </table>


    <br>
        <table class="table2" style="width:100%; padding-left: 25px; padding-right: 25px; padding-bottom: 8px;">
            <tr style="font-size: 12px;">
                <th class="th2" align="center">#</th>
                <th class="th2" align="left">Jenis Sampel</th>
                <th class="th2" align="left">Jumlah Titik</th>
                <th class="th2" align="right">Harga</th>
            </tr>

            @php
                $i = 1;
            @endphp
            <tr style="font-size: 12px;">
                <td class="td2" align="center" style="width: 4%">{{ $i++ }}</td>
                <td class="td2" style="width: 20%">{{ $pengambilan_order->sampelUji->nama_sampel }} (@currency($pengambilan_order->sampelUji->harga)) </td>
                <td class="td2" style="width: 52%">
                    x {{ $pengambilan_order->jumlah_titik_sampling }} titik sampling
                
                </td>
                <td class="td2" align="right" >@currency($pengambilan_order->total_harga)</td>
            </tr>
            
            
        </table>
        <br>
        <table class="table2" style="width:100%; padding-left: 25px; padding-right: 25px; padding-bottom: 8px;">
            <tr>
                <td class="td2" colspan="4" style="font-size: 11px;"><b>Catatan</b><br>Harap membayar sesuai dengan total tagihan, yaitu sebesar @currency($pengambilan_order->total_harga) <br>- -</td>
                <td class="td2" align="right" style="font-size: 12px;"><b>Sub-total:</b>&nbsp; @currency($pengambilan_order->total_harga) </b></td>
            </tr>
        </table>
        <table class="table2" style="width:100%; padding-left: 25px; padding-right: 25px; padding-bottom: 8px;">
            <tr>
                <td class="td2" colspan="5" style="font-size: 22px; padding: 0 0 10px 0" align="right"> <b>@currency($pengambilan_order->total_harga)</b></td>
            </tr>
        </table>
</body>

</html>