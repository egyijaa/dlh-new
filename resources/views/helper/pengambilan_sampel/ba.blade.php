<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    {{-- <meta http-equiv="X-UA-Compatible" content="ie=edge"> --}}
    <title>BA | {{ $pengambilan_order->no_ba }}</title>
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
        .centerKotak {
            margin: auto;
            width: 99%;
            padding: 5px;
            height: 420px;
        }
        .centerBaru {
            margin: auto;
            width: 100%;
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
        <table style="width:100%; border-collapse: collapse; font-size: 14.5px;">
            <thead>
            </thead>
            <tbody>
                <tr>
                    <th scope="col" style="border: 1px solid black; width:13%;" rowspan="4" align="center"><img src="{{ storage_path('app/public/pemkot.jpeg') }}"
                        alt="" style="
                        width: 60px; height: 60px;"></th>
                    <th style="border: 1px solid black; width: 20%; padding: 0 10 0 10" scope="col" rowspan="4">LABORATORIUM LINGKUNGAN DLH KOTA PONTIANAK</th>
                    <th style="border: 1px solid black; width:29%" scope="col" align="center" rowspan="4">BERITA ACARA PENGAMBILAN CONTOH UJI</th>
                    <td style="border: 1px solid black; width:12%" scope="col">No. Dok</td>
                    <td style="border: 1px solid black;" scope="col">: PO/LAB-DLH/022.b</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black;" scope="col">Revisi</td>
                    <td style="border: 1px solid black; width:26%" scope="col">: 01</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black;" scope="col">Tgl Efektif</td>
                    <td style="border: 1px solid black;" scope="col">: 23 Juni 2021 </td>
                </tr>
                <tr>
                    <td style="border: 1px solid black;" scope="col">Hal</td>
                    <td style="border: 1px solid black;" scope="col">: ...&nbsp;&nbsp;dari&nbsp;&nbsp;...</td>
                </tr>
            </tbody>
        </table>
        <br>
        <p class="centerBaru" style="font-size: 14px;">
            <b>Lampiran BA Pengambilan Sampel Nomor: {{ $pengambilan_order->no_ba }}</b>
        </p>
        <br>
        <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
            <tr>
                <th style="border: 1px solid black;">No</th>
                <th style="border: 1px solid black;">Lokasi Pengambilan</th>
                <th style="border: 1px solid black;">Titik Koordinat</th>
                <th style="border: 1px solid black;">Kode Sampel Wadah</th>
                <th style="border: 1px solid black;">Kondisi Lapangan</th>
            </tr>
                @php
                    $i = 1;
                @endphp
                @foreach ($berita_acara as $item)
                <tr>
                    <td style="border: 1px solid black;" align="center">{{ $i++ }}.</td>
                    <td style="border: 1px solid black;">{{ $item->titik_sampling }}</td>
                    <td style="border: 1px solid black;">LU: {{ $item->lu }}
                        <br>
                        LS: {{ $item->ls }}
                    </td>
                    <td style="border: 1px solid black;" align="center">{{ $item->kode_sampel }}</td>
                    <td style="border: 1px solid black;">Temp udara: {{ $item->suhu }} °C
                        <br><br>
                        @php
                            $cuaca = $item->cuaca;
                        @endphp
                        Cuaca: 
                        @if ($cuaca == 'cerah')
                            cerah<s>/mendung/hujan</s>
                        @elseif($cuaca == 'mendung')
                            <s>cerah/</s>mendung<s>/hujan</s>
                        @else
                            <s>cerah/mendung/</s>hujan
                        @endif
                    </td>
                </tr>
                @endforeach
        </table>
        <br>
        {{-- <p class="centerKotak" style="font-size: 14px; border: 1px solid black;"><u>Dokumentasi:</u> --}}
        <table style="width: 100%; border-collapse: collapse; font-size: 14px; border: 1px solid black;">
            <tr>
                <td colspan="3"><b><u>Dokumentasi:</u></b></td>
            </tr>
            @php
                $i = 1;
            @endphp
            @foreach ($berita_acara as $foto)
            {{-- <tr>
                <td colspan="3">{{ $i++ }}. {{ $foto->kode_sampel }}</td>
            </tr> --}}
            <tr>
                <td align="center">
                    <p style="text-align: left; padding-bottom:1px;">{{ $i++ }}. {{ $foto->kode_sampel }}</p>
                    
                        @if ($foto->foto1 == '-')
                            foto belum tersedia
                        @else
                        @php
                        $path = storage_path('app/public/' . $foto->foto1);
                        $type = pathinfo($path, PATHINFO_EXTENSION);
                        $data = file_get_contents($path);
                        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                        @endphp
                        <img src="{{ $base64 }}" alt="" style="
                            width: 100px; height: 140px">
                        @endif
                    <br>
                    <button style="background-color: white; border: 1px solid black">Pengambilan Sampel</button>
                </td>
                <td align="center">
                    <p style="text-align: left; padding-bottom:1px; color: white">.</p>
                    
                        @if ($foto->foto2 == '-')
                            foto belum tersedia
                        @else
                        @php
                        $path2 = storage_path('app/public/' . $foto->foto2);
                        $type2 = pathinfo($path2, PATHINFO_EXTENSION);
                        $data2 = file_get_contents($path2);
                        $base642 = 'data:image/' . $type2 . ';base64,' . base64_encode($data2);
                    @endphp
                    <img src="{{ $base642 }}" alt="" style="width: 100px; height: 140px">
                        @endif
                    <br>
                    <button style="background-color: white; border: 1px solid black">Penggabungan Sampel</button>
                </td>
                <td align="center">
                    <p style="text-align: left; padding-bottom:1px; color: white">.</p>
                    
                        @if ($foto->foto3 == '-')
                            foto belum tersedia
                        @else
                        @php
                        $path3 = storage_path('app/public/' . $foto->foto3);
                        $type3 = pathinfo($path3, PATHINFO_EXTENSION);
                        $data3 = file_get_contents($path3);
                        $base643 = 'data:image/' . $type3 . ';base64,' . base64_encode($data3);
                     @endphp
                    <img src="{{ $base643 }}" alt="" style="width: 100px; height: 140px">
                        @endif
                    <br>
                    <button style="background-color: white; border: 1px solid black">Pengukuran Parameter</button>
                </td>
            </tr>
            <tr> 
                @if (count($berita_acara) == 3 && $i == 2)
                <td colspan="3"><br><br><br></td>
                @else
                <td colspan="3"></td>
                @endif
            </tr>
            @endforeach
            
        </table>
        
        {{-- </p> --}}
        <br>
        <table style="width:100%; font-size: 14px; padding-left: 8px;">
          <tr>
              <td align="center">Mengetahui,<br>Penanggungjawab Teknis<br><br><br><br><br><b>{{ $teknis->nama }}</b></td>
              <td align="center">Diperiksa<br>Penyelia<br><br><br><br><br><b>{{ $penyelia->nama }}</b></td>
          </tr>
      </table>
</body>

</html>