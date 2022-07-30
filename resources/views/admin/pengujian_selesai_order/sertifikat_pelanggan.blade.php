<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SERTIFIKAT | DLH | {{ $sampel_order->nomor_sertifikat }}</title>
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
        /* position: absolute; */
        margin-top: 50px;
        right: 0;
        bottom: 100px;
        height: 6.5%;
        }
    </style>
</head>

<body>
    <div class="div">
        <img src="{{ storage_path('app/public/' . $sampel_order->foto_shu1) }}" alt="" style="
        width: 100%; height: 100%;">
    </div>
   
    {{-- Halaman Dua --}}
    <div class="div">
        <img src="{{ storage_path('app/public/' . $sampel_order->foto_shu2) }}" alt="" style="
        width: 100%; height: 100%;">
    </div>
 
</body>

</html>