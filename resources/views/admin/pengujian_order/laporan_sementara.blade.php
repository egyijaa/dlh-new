<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Sementara | DLH | {{ $sampel_order->nomor_uji }}</title>
    <style>
        .center {
            margin: auto;
            width: 50%;
            padding: 10px;
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
        .table, .th, .td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        .tdBG {
           background-color: #74b72d;
        }
    </style>
</head>

<body>
    <br>
    <div class="center"><b><u>LAPORAN SEMENTARA HASIL UJI</u></b></div>
    <br><br>
    <table>
        <tr>
            <td>Nama Contoh Uji</td>
            <td>: {{ $sampel_order->nomor_uji }}</td>
        </tr>
        <tr>
            <td>Jenis Contoh Uji</td>
            <td>: {{ $sampel_order->sampelUji->nama_sampel }}</td>
        </tr>
        <tr>
            <td>Tanggal Penerimaan Contoh Uji</td>
            <td>: {{ date('d M Y', strtotime($tanggal_diterima_sampel)) }} 
            </td>
        </tr>
        <tr>
            <td>Hasil Analisis</td>
            <td>: </td>
        </tr>
    </table>

    <table class="table center" style="width:100%">
        <tr>
            <th class="th" style="width:5%">No.</th>
            <th class="th" style="width:40%">Parameter Uji</th>
            <th class="th" style="width:10%">Satuan</th>
            <th class="th" style="width:15%">Hasil Pengujian</th>
            <th class="th" style="width:30%">Metode</th>
        </tr>
        @php
        $i = 1;
        @endphp
        @foreach ($sampel_order->parameterSampelOrder as $parameter)
        <tr>
            <td class="td" align="center">{{ $i++ }}</td>
            <td class="td">{{ $parameter->parameterSampel->nama_parameter }}</td>
            <td class="td" align="center">{{ $parameter->satuan }}</td>
            <td class="td tdBG" align="center">{{ $parameter->hasil_pengujian }}</td>
            <td class="td" align="center">{{ $parameter->metode_uji }}</td>
        </tr>
        @endforeach
    </table>

    <div class="parent">
        <div class="left"></div>
        <div class="center2"></div>
        <div class="right" align="center">Penyelia,
        <br>
        <br>
        <br>
        <br>
        <br>
        (Estiningtiyas)
        </div>
    </div>
    <div class="parent">
        <div class="left">
            Validasi oleh,
            <br>
            <br>
            <br>
            <br>
            Penanggung Jawab Teknis
        </div>
        <div class="center2"></div>
        <div class="right"></div>
    </div>
</body>

</html>