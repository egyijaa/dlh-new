<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
           background-color: #74CD53;
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
            <td>: a-123-B567</td>
        </tr>
        <tr>
            <td>Jenis Contoh Uji</td>
            <td>: Air Permukaan</td>
        </tr>
        <tr>
            <td>Tanggal Penerimaan Contoh Uji</td>
            <td>: @php
                $now = \Carbon\Carbon::now('Asia/Jakarta')->format('d F Y');
                echo $now;
                @endphp
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
        <tr>
            <td class="td" align="center">1</td>
            <td class="td">Kebutuhan Oksigen Biokimiawi (<i>BOD</i>)</td>
            <td class="td" align="center">mg/L</td>
            <td class="td tdBG" align="center">87</td>
            <td class="td" align="center">HACH <i>Methode</i></td>
        </tr>
        <tr>
            <td class="td" align="center">2</td>
            <td class="td">Kebutuhan Oksigen Kimiawi (<i>COD</i>)</td>
            <td class="td" align="center">mg/L</td>
            <td class="td tdBG" align="center">35.488</td>
            <td class="td" align="center">SNI 6989.2:2019</td>
        </tr>
    </table>

    <div class="parent">
        <div class="left"></div>
        <div class="center2"></div>
        <div class="right" align="center">Penyedia,
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