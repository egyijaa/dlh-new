<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
        <tr>
            <td class="th2" colspan="4" style="font-size: 14px;"><b>#20220615021503</b></td>
        </tr>
        <tr style="font-size: 12px;">
            <td class="th2" colspan="3" style="border-bottom: 1px solid rgba(0,0,0,0);"><b>Dinas Lingkungan Hidup Kota Pontianak</b><br>Jl Alianyang No 7b Pontianak<br>08568888926<br>Kota/Kabupaten : Pontianak</td>
            <td class="th2" style="width:31%; border-bottom: 1px solid rgba(0,0,0,0);"><b>Tanggal Order:</b> @php
                $now = \Carbon\Carbon::now('Asia/Jakarta')->format('d F Y');
                echo $now;
                @endphp <br><br><b>Status Order:</b><span style="font-size: 10px; color:#808080">&nbsp;Proses Pembayaran</span></td>
        </tr>
    </table>
    <br>
        <table class="table2" style="width:100%; padding-left: 25px; padding-right: 25px; padding-bottom: 8px;">
            <tr style="font-size: 12px;">
                <th class="th2" align="center">#</th>
                <th class="th2" align="left">Jenis Contoh</th>
                <th class="th2" align="left">Peraturan</th>
                <th class="th2" align="left">Harga</th>
            </tr>
            @for ($i = 1; $i < 9; $i++)
            <tr style="font-size: 12px;">
                <td class="td2" align="center" style="width: 4%">@php echo $i; @endphp</td>
                <td class="td2" style="width: 20%">Air Tanah</td>
                <td class="td2" style="width: 52%">Blanko Umum Air / Air Limbah Tanpa Baku mutu</td>
                <td class="td2">Rp. 1.084.000</td>
            </tr>
            @endfor
        </table>
        <br>
        <table class="table2" style="width:100%; padding-left: 25px; padding-right: 25px; padding-bottom: 8px;">
            <tr>
                <td class="td2" colspan="4" style="font-size: 8.5px;"><b>Catatan</b><br>Ini Bukti Pembayaran dari Aplikasi bukan dari billing pemerintah.<br>-Klik Tombol Kode Biling Untuk Segera Melihat Elektronik Pembayaran Anda <br>- -</td>
                <td class="td2" align="right" style="font-size: 12px;"><b>Sub-total:</b>&nbsp;Rp. 8.672.000</b><br><br><b>Sertifikat:</b>&nbsp;Rp. 0<br><br>Discount: 0%<br><br>Deposit: Rp. 0</td>
            </tr>
        </table>
        <table class="table2" style="width:100%; padding-left: 25px; padding-right: 25px; padding-bottom: 8px;">
            <tr>
                <td class="td2" colspan="5" style="font-size: 22px; padding: 0 0 10px 0" align="right"><b>Rp. 8.672.000</b></td>
            </tr>
        </table>
</body>

</html>