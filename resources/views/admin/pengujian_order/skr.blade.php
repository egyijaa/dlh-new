<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SKR | {{ $pengujian_order->nomor_pre }}</title>
    <style>
        .calibri {
            font-family: 'Calibri', Candara, Segoe, "Segoe UI", Optima, Arial, sans-serif;
        }
    </style>
</head>

<body>
    <table style="width: 100%; padding-left: 18px; padding-right: 20px; border-collapse: collapse;">
        <tr>
            <th style="border: 1px solid black;">PEMERINTAH KOTA PONTIANAK<br>DINAS LINGKUNGAN HIDUP<br>KOTA PONTIANAK
            </th>
            <th style="border: 1px solid black;">SURAT KETERANGAN RETRIBUSI<br>(SKR)<br>Nomor :
                {{ $skr->no_skr }}</th>
        </tr>
    </table>
    <br>
    <div class="calibri">
        <table style="width: 100%; font-size: 13px; padding-left: 20px; padding-right: 20px;">
            <tr>
                <td style="width: 80%;"></td>
                <td style="width: 10%;">Masa</td>
                <td style="width: 10%;">:  {{ date('M-d', strtotime($tanggal_skr)) }}   </td>
            </tr>
            <tr>
                <td style="width: 80%;"></td>
                <td style="width: 10%;">Tahun</td>
                <td style="width: 10%;">: {{ date('Y', strtotime($tanggal_skr)) }}  </td>
            </tr>
        </table>
        <br>
        <table style="width: 100%; font-size: 13px; padding-left: 25px; padding-right: 25px;">
            <tr>
                <td style="width: 30%">NAMA</td>
                <td>: {{ $pengujian_order->nama_pemesan }} </td>
            </tr>
            <tr>
                <td style="width: 30%">ALAMAT</td>
                <td>: {{ $pengujian_order->alamat }}</td>
            </tr>
            <tr>
                <td style="width: 30%">Tanggal Jatuh Tempo</td>
                @php
                    $jatuh_tempo = \Carbon\Carbon::parse($tanggal_skr)->addDays(30);
                @endphp
                <td>: {{  $jatuh_tempo->format('d M Y') }}
                    
                
                </td>
            </tr>
        </table>
        <br>
        <table
            style="width: 100%; font-size: 13px; padding-left: 25px; padding-right: 25px; border-collapse: collapse;">
            <tr>
                <th style="border: 1px solid black; width:5%;">No.</th>
                <th style="border: 1px solid black; width:25%;">KODE REKENING</th>
                <th style="border: 1px solid black;" colspan="3">URAIAN RETRIBUSI</th>
                <th style="border: 1px solid black; width:15%;">JUMLAH</th>
            </tr>
            <tr>
                <td style="border: 1px solid black;" align="center">1</td>
                <td style="border: 1px solid black;" align="center">4.1.02.02.01.0004</td>
                <td style="border: 1px solid black;" colspan="3" align="left">Retribusi Pemakaian Kekayaan Daerah (Pelayanan Pemeriksaan Laboratorium)</td>
                <td style="border: 1px solid black;"></td>
            </tr>
            <tr>
                <td style="border: 1px solid black;">&nbsp;</td>
                <td style="border: 1px solid black;"></td>
                <td style="border: 1px solid black;" colspan="3"></td>
                <td style="border: 1px solid black;"></td>
            </tr>
            @foreach ($pengujian_order->sampelOrder as $s)
            <tr>
                <td style="border: 1px solid black;"></td>
                <td style="border: 1px solid black;"></td>
                <td style="border: 1px solid black;" align="center">{{ $s->sampelUji->nama_sampel }}</td>
                <td style="border: 1px solid black;" align="left" colspan="2">
                 
                  
                        @foreach ($s->parameterSampelOrder as $parameter)
                        - {{ $parameter->parameterSampel->nama_parameter }} (@currency($parameter->parameterSampel->harga)) <br>
                    @endforeach
                    
                </td>
                <td style="border: 1px solid black;" align="center">@currency($s->harga)</td>
            </tr>
            @endforeach
            <tr>
                <td style="border: 1px solid black;"></td>
                <td style="border: 1px solid black;" colspan="4" align="center">Jumlah Total</td>
                <td style="border: 1px solid black;" align="center"><b>@currency($pengujian_order->total_harga)</b></td>
            </tr>
        </table>
        <br>
  
        <br>
        <br>
        <table style="width: 95%; border-bottom: 1px solid black; margin-left: 17px">
        </table>
        <br>

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


        <table style="width: 100%; font-size: 13px; padding-left: 25px; padding-right: 25px;">
          <tr>
              <td style="width:20%;">Dengan Huruf</td>
              <td colspan="3">: <i><b>@php
                  echo terbilang($pengujian_order->total_harga);
              @endphp RUPIAH</b></i></td>
          </tr>
          <br>
          <tr>
            <td><u><b>PERHATIAN</b></u></td>
            <td colspan="3">:</td>
          </tr>
          <tr>
            <td style="padding-left: 5px; padding-right: 90px" colspan="4">Harap penyetoran pada Bank Kalbar Nomor Rekening : 100.101.3501
              Apabila SKR in tidak atau kurang dibayar lewat waktu paling lama 30 hari
              setelah SKR diterima (tanggal jatuh tempo) dikenakan administrasi berupa
              bunga sebesar 2% perbulan
              </td>
          </tr>
          <br>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>Pontianak,  {{ date('d M Y', strtotime($tanggal_skr)) }} <br>
              Kepala Dinas Lingkungan Hidup<br>
              Kota Pontianak<br>
              ( Penggena Anggaran)
            <br>
            <br>
            <br>
            <br>
            <br>
            <u><b>dr. Saptiko, M.Med. PH</b></u><br>
						NIP. 19661113 199603 1 003
            </td>
          </tr>
      </table>
    </div>
</body>

</html>