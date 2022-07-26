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
            border: 1px solid black;
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
            border: 1px solid black;
            border-collapse: collapse;
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
    <div class="div">
        <table class="table" style="width:100%;">
            <tr>
                <td class="td" style="width:18%"><img src="{{ storage_path('app/public/pemkot.jpeg') }}" alt="" style="
                        width: 100px; height: 100px; padding-bottom: 4px; padding-left: 4px; padding-top: 4px;"></td>
                <td class="td" style="width:82%">
                    <span style="font-size: 14px">P E M E R I N T A H &nbsp;K O T A &nbsp;P O N T I A N A K</span>
                    <br>
                    <span style="font-size: 25px">DINAS LINGKUNGAN HIDUP</span>
                    <br>
                    <span style="font-size: 14.5px">UPT LABORATORIUM LINGKUNGAN</span>
                    <br>
                    <span style="font-size: 12px">Jalan Alianyang No. 78 Pontianak Telp. (0561) 766980 Fax. (0561) 748134
                        Kode Pos 78116</span>
                </td>
            </tr>
        </table>
        <br>
        <div class="center" style="padding-left: 8px;"><b><u>SERTIFIKAT HASIL UJI</u></b><br><i style="color: blue">Test Result Certificate</i></div>
        <br>
        <table style="width:100%; font-size: 14px; padding-left: 8px; padding-bottom: 8px;">
            <tr>
                <td style="width:15%;"><u>Tanggal terbit</u><br><i style="color: #FF4900">Date of issued</i></td>
                <td style="width:35%;">: @php
                    $now = \Carbon\Carbon::now('Asia/Jakarta')->format('d F Y');
                    echo $now;
                    @endphp
                </td>
                <td><u>Nomor Laporan</u><br><i style="color: #FF4900">Lab reference</i></td>
                <td>: 919/LP-BRS.PTK/IV/2021</td>
            </tr>
            <br>
            <tr>
                <td style="width:15%;"><u>Kepada</u><br><i style="color: #FF4900">To client</i></td>
                <td style="width:35%;">: Dinas Lingkungan Hidup Kota Pontianak <br> di- <br> Pontianak
                </td>
                <td><u>Nomor Analisis</u><br><i style="color: #FF4900">Analysis Number</i></td>
                <td>: P.00796-2021</td>
            </tr>
            <br>
            <tr>
                <td style="width:15%;"></td>
                <td style="width:35%;"></td>
                <td><u>Halaman</u><br><i style="color: #FF4900">Page(s)</i></td>
                <td>: 1&nbsp;&nbsp;&nbsp;<u>dari</u>&nbsp;&nbsp;&nbsp;2<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i>of</i></td>
            </tr>
            <br>
            <br>
            <tr>
                <td colspan="4"><u>Yang bertanda-tangan dibawah ini menerangkan bahwa pengujian/analisa di laboratorium:</u><br><i style="color: #FF4900">The undersigned certifies that laboratory testing/analysis</i></td>
            </tr>
            <br>
            <tr>
                <td colspan="2"><u>Dari Contoh</u><br><i style="color: #FF4900">Of the sample(s)</i></td>
                <td colspan="2">: Air Permukaan</td>
            </tr>
            <br>
            <tr>
                <td colspan="2"><u>Merk/keterangan contoh</u><br><i style="color: #FF4900">Marking/description of sample</i></td>
                <td colspan="2">: Terlampir</td>
            </tr>
            <br>
            <tr>
                <td colspan="2"><u>Diambil di</u><br><i style="color: #FF4900">Taken in</i></td>
                <td colspan="2">: -</td>
            </tr>
            <br>
            <tr>
                <td colspan="2"><u>Pengambil Contoh</u><br><i style="color: #FF4900">Sampler</i></td>
                <td colspan="2">: -</td>
            </tr>
            <br>
            <tr>
                <td colspan="2"><u>Tanggal Terima</u><br><i style="color: #FF4900">Received on</i></td>
                <td colspan="2">: @php
                    $now = \Carbon\Carbon::now('Asia/Jakarta')->format('d F Y');
                    echo $now;
                    @endphp</td>
            </tr>
            <br>
            <tr>
                <td colspan="2"><u>Tanggal Analisis</u><br><i style="color: #FF4900">Date tested</i></td>
                <td colspan="2">: @php
                    $now = \Carbon\Carbon::now('Asia/Jakarta')->format('d F Y');
                    echo $now;
                    @endphp</td>
            </tr>
            <br>
            <tr>
                <td colspan="4"><u>dengan hasil pengujian contoh sebagai berikut:</u><br><i style="color: #FF4900">the sample(s) give the following results</i></td>
            </tr>
            <br>
            <tr>
                <td colspan="2"><p style="font-size: 11.5px; border: 1px solid #FF4900; padding: 5px; color: #FF4900">Hasil pengujian ini berlaku untuk contoh-contoh tersebut diatas.<br>Pengambil contoh bertanggung jawab atas keterwakilan contoh</p></td>
                <td colspan="2" align="center">Pit.Kepala Seksi Standarisasi dan Sertifikasi<br><br><br><br>Zuhwary</td>
            </tr>
        </table>
    </div>
    <p align="center" style="font-size: 7.5px;"><u>Tidak dibenarkan mengutip/memperbanyak dan/atau mempublikasikan sebagian isi sertifikat ini tanpa izin LP-BRS_PTK. Sertifikat ini sah telah dibubuhi cap dan ditandatangani oleh pejabat yang bersangkutan</u><br><i>This certificate shall not be reproduced except in full exists permission for the reproduction of an approved abstract has been obtained in writing from LP-BRS-PTK</i></p>
    


    {{-- Halaman Dua --}}
    <div class="div">
        <table class="table" style="width:100%;">
            <tr>
                <td class="td" style="width:18%"><img src="{{ storage_path('app/public/pemkot.jpeg') }}"" alt="" style="
                        width: 100px; height: 100px; padding-bottom: 4px; padding-left: 4px; padding-top: 4px;"></td>
                <td class="td" style="width:82%">
                    <span style="font-size: 14px">P E M E R I N T A H &nbsp;K O T A &nbsp;P O N T I A N A K</span>
                    <br>
                    <span style="font-size: 25px">DINAS LINGKUNGAN HIDUP</span>
                    <br>
                    <span style="font-size: 14.5px">UPT LABORATORIUM LINGKUNGAN</span>
                    <br>
                    <span style="font-size: 12px">Jalan Alianyang No. 78 Pontianak Telp. (0561) 766980 Fax. (0561) 748134
                        Kode Pos 78116</span>
                </td>
            </tr>
        </table>
        <br>
        <div class="center"><b><u>SERTIFIKAT HASIL UJI</u></b><br><i style="color: blue">Test Result Certificate</i></div>
        <br>
        <table style="width: 100%; font-size: 14px; padding-left: 27px; padding-right: 27px;">
            <tr>
                <td>Nama Laporan</td>
                <td>: 919/LP-BRS.PTK/IV/2021</td>
            </tr>
            <tr>
                <td>Nomor analisis</td>
                <td>: P.00796-2021</td>
            </tr>
            <tr>
                <td>Nama perusahaan</td>
                <td>: Dinas Lingkungan Hidup Kota Pontianak</td>
            </tr>
            <tr>
                <td>Jenis Contoh</td>
                <td>: Air Permukaan; Kode/Lokasi: Tky 1</td>
            </tr>
        </table>
        <br>
        <table class="table2" style="width:100%; font-size: 14px; padding-left: 25px; padding-right: 25px; padding-bottom: 8px;">
            <tr>
                <th class="th2">No.</th>
                <th class="th2">Parameter Uji</th>
                <th class="th2">Satuan</th>
                <th class="th2">Hasil Pengujian</th>
                <th class="th2">Baku Mutu</th>
                <th class="th2">Metode</th>
            </tr>
            <tr>
                <td class="td2" align="center">1</td>
                <td class="td2">Temperatur</td>
                <td class="td2" align="center">*C</td>
                <td class="td2" align="center">28 (Dev 2)</td>
                <td class="td2" align="center">Def 3</td>
                <td class="td2" align="center">SNI 06-6989-23-2005</td>
            </tr>
            <tr>
                <td class="td2" align="center">2</td>
                <td class="td2">Padatan Terlarut Total (<i>TDS</i>)</td>
                <td class="td2" align="center">mg/L</td>
                <td class="td2" align="center">73</td>
                <td class="td2" align="center">1.000</td>
                <td class="td2" align="center">HACH <i>Methode</i></td>
            </tr>
            <tr>
                <td class="td2" align="center">3</td>
                <td class="td2">Padatan Tersuspensi Total (<i>TSS</i>)</td>
                <td class="td2" align="center">mg/L</td>
                <td class="td2" align="center">20</td>
                <td class="td2" align="center">50</td>
                <td class="td2" align="center">SNI 6989.3:2019</td>
            </tr>
            <tr>
                <td class="td2" align="center">4</td>
                <td class="td2">pH</td>
                <td class="td2" align="center">-</td>
                <td class="td2" align="center">6</td>
                <td class="td2" align="center">6-9</td>
                <td class="td2" align="center">SNI 6989.11:2019</td>
            </tr>
            <tr>
                <td class="td2" align="center">5</td>
                <td class="td2">Kebutuhan Oksigen Kimiawi (<i>COD</i>)</td>
                <td class="td2" align="center">mg/L</td>
                <td class="td2" align="center">27</td>
                <td class="td2" align="center">25</td>
                <td class="td2" align="center">SNI 6989.2:2019</td>
            </tr>
        </table>
        <br>
    </div>
    <footer class="footer">
        <table style="width:100%; font-size: 14px; padding-left: 8px; padding-bottom: 8px;">
            <tr>
                <td colspan="2"><p style="font-size: 11.5px; border: 1px solid #FF4900; padding: 5px; color: #FF4900">Hasil pengujian ini berlaku untuk contoh-contoh tersebut diatas.<br>Pengambil contoh bertanggung jawab atas keterwakilan contoh</p></td>
                <td colspan="2" align="center">Pit.Kepala Seksi Standarisasi dan Sertifikasi<br><br><br><br>Zuhwary</td>
            </tr>
        </table>
        <p align="center" style="font-size: 7.5px;"><u>Tidak dibenarkan mengutip/memperbanyak dan/atau mempublikasikan sebagian isi sertifikat ini tanpa izin LP-BRS_PTK. Sertifikat ini sah telah dibubuhi cap dan ditandatangani oleh pejabat yang bersangkutan</u><br><i>This certificate shall not be reproduced except in full exists permission for the reproduction of an approved abstract has been obtained in writing from LP-BRS-PTK</i></p>
    </footer>
</body>

</html>