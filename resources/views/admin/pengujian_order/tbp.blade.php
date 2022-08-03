<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TBP | {{ $pengujian_order->nomor_pre }}</title>
    <style>
        body {
            font-family: 'Calibri', Candara, Segoe, "Segoe UI", Optima, Arial, sans-serif;
        }
        div {
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

  @php
  function penyebut($nilai) {
  $nilai = abs($nilai);
  $huruf = array("", "SATU", "DUA", "TIGA", "EMPAT", "LIMA", "ENAM", "TUJUH", "DELAPAN", "SEMBILAN", "SEPULUH", "SEBELAS");
  $temp = "";
  if ($nilai < 12) {
    $temp = " ". $huruf[$nilai];
  } else if ($nilai <20) {
    $temp = penyebut($nilai - 10). " BELAS";
  } else if ($nilai < 100) {
    $temp = penyebut($nilai/10)." PULUH". penyebut($nilai % 10);
  } else if ($nilai < 200) {
    $temp = " SERATUS" . penyebut($nilai - 100);
  } else if ($nilai < 1000) {
    $temp = penyebut($nilai/100) . " RATUS" . penyebut($nilai % 100);
  } else if ($nilai < 2000) {
    $temp = " SERIBU" . penyebut($nilai - 1000);
  } else if ($nilai < 1000000) {
    $temp = penyebut($nilai/1000) . " RIBU" . penyebut($nilai % 1000);
  } else if ($nilai < 1000000000) {
    $temp = penyebut($nilai/1000000) . " JUTA" . penyebut($nilai % 1000000);
  } else if ($nilai < 1000000000000) {
    $temp = penyebut($nilai/1000000000) . " MILYAR" . penyebut(fmod($nilai,1000000000));
  } else if ($nilai < 1000000000000000) {
    $temp = penyebut($nilai/1000000000000) . " TRILYUN" . penyebut(fmod($nilai,1000000000000));
  }     
  return $temp;
}

function terbilang($nilai) {
  if($nilai<0) {
    $hasil = "MINUS ". trim(penyebut($nilai));
  } else {
    $hasil = trim(penyebut($nilai));
  }     		
  return $hasil;
}
  @endphp

    <div class="div">
        <table class="table" style="width:100%;">
            <tr>
                <td class="td" style="width:35%" align="right"><img src="{{ storage_path('app/public/pemkot.jpeg') }}"
                        alt="" style="
                        width: 90px; height: 90px; padding-bottom: 4px; padding-left: 4px; padding-top: 4px;"></td>
                <td class="td" style="width:45%" align="center">
                    <span style="font-size: 15px"><b>PEMERINTAH KOTA PONTIANAK</b></span>
                    <br>
                    <span style="font-size: 15px"><b>DINAS LINGKUNGAN HIDUP</b></span>
                    <br>
                    <span style="font-size: 15px"><b>UPT LABORATORIUM LINGKUNGAN</b></span>
                    <br>
                    <span style="font-size: 13px">NOMOR BUKTI: {{ $tbp->no_tbp }}</span>
                </td>
                <td class="td" style="width:20%"></td>
            </tr>
        </table>
        <br>
        <table style="width: 100%; font-size: 14px; padding-left: 27px; font-size: 11.5px">
            <tr>
                <td style="width: 4%">a. </td>
                <td colspan="2">Bendahara Penerimaan Dinas Lingkungan Hidup Kota Pontianak</td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2" style="width: 96%"> <span style="padding-right: 50px">Telah menerima uang sebesar
                        </span><span style="border: 1px solid black; padding: 2 2 2 40;">@currency($pengujian_order->total_harga)</span></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2" style="width: 96%">(<i> @php
                  echo terbilang($pengujian_order->total_harga);
              @endphp RUPIAH</i>)</td>
            </tr>
            <tr>
                <td>b. </td>
                <td style="width: 20%">Dari Nama</td>
                <td style="width: 76%">: {{ $pengujian_order->nama_pemesan }}</td>
            </tr>
            <tr>
                <td>c. </td>
                <td style="width: 20%">Alamat</td>
                <td style="width: 76%">: {{ $pengujian_order->alamat }}</td>
            </tr>
            <tr>
                <td style="vertical-align: top; position:relative;">d. </td>
                <td style="width: 20%; vertical-align: top; position:relative;">Sebagai Pembayaran</td>
                <td style="width: 76%">: Retribusi Pemakaian Kekayaan Daerah (Pelayanan Pemeriksaan Laboratorium)</td>
            </tr>
        </table>
        <table style="border-collapse: collapse; width: 100%; font-size: 14px; padding-left: 195px; padding-right: 15px; font-size: 11.5px; border: 1px solid black">
            <tr>
                <th colspan="6" style="border: 1px solid black">Kode Rekening</th>
                <th style="border: 1px solid black">Uraian</th>
                <th style="border: 1px solid black">Jumlah (Rp)</th>
            </tr>
            <tr>
                <td align="center" style="border: 1px solid black">4</td>
                <td align="center" style="border: 1px solid black">1</td>
                <td align="center" style="border: 1px solid black">02</td>
                <td align="center" style="border: 1px solid black">02</td>
                <td align="center" style="border: 1px solid black">01</td>
                <td align="center" style="border: 1px solid black">0004</td>
                <td style="border: 1px solid black; width:45%">Retribusi Pemakaian Kekayaan Daerah (Pelayanan Pemeriksaan Laboratorium)</td>
                <td align="right" style="border: 1px solid black; width:22%">@currency($pengujian_order->total_harga)</td>
            </tr>
            <tr>
                <td align="center" style="border: 1px solid black">&nbsp;</td>
                <td align="center" style="border: 1px solid black"></td>
                <td align="center" style="border: 1px solid black"></td>
                <td align="center" style="border: 1px solid black"></td>
                <td align="center" style="border: 1px solid black"></td>
                <td align="center" style="border: 1px solid black"></td>
                <td style="border: 1px solid black"></td>
                <td align="right" style="border: 1px solid black"></td>
            </tr>
            <tr>
                <td align="center" colspan="7" style="border: 1px solid black">Jumlah</td>
                <td align="right" style="border: 1px solid black">@currency($pengujian_order->total_harga)</td>
            </tr>
        </table>
        <table style="width: 100%; font-size: 14px; padding-left: 27px; font-size: 11.5px">
            <tr>
                <td>e. </td>
                <td style="width: 20%">Tanggal diterima uang</td>
                <td style="width: 76%">: {{ date('d M Y', strtotime($pengujian_order->tanggal_bayar)) }}</td>
            </tr>
            <tr>
                <td>f. </td>
                <td style="width: 20%">Nomor SKR</td>
                <td style="width: 76%">: {{ $no_skr }}</td>
            </tr>
        </table>
        <br>
        <table style="width:100%; font-size: 12px; padding-left: 8px; padding-bottom: 8px;">
          <tr>
              <td align="center">Mengetahui,<br>Bendahara Penerimaan<br><br><br><br><br><u>BAMBANG DARMAWAN, A.Md</u><br>NIP. 19770723 199803 1 003</td>
              <td align="center">Pembayar/Penyetor<br><br><br><br><br>{{ $pengujian_order->nama_pemesan }}</td>
          </tr>
      </table>
      <br>
      <br>
      <i style="color: #FF4900; font-size: 12px;">Arsip Bendahara Penerimaan DLH</i>
    </div>
</body>

</html>