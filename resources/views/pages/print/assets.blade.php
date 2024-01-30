<!DOCTYPE html>
<html>
<head>
  <title>Daftar Inventaris - Print</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <style>
    .page-break {
        page-break-after: always;
    }
    @page {
                margin: 85px 25px;
            }

    header {
        position: fixed;
        top: -60px;
        left: 0px;
        right: 0px;
        height: 50px;

        /** Extra personal styles **/
        background-color: #bababa;
        color: black;
        text-align: center;
        line-height: 42px;
        font-size: 30px;
        font-weight: bold;
    }

    footer {
        position: fixed; 
        bottom: -60px; 
        left: 0px; 
        right: 0px;
        height: 50px;
        padding-left: 20px;

        /** Extra personal styles **/
        background-color: #ffffff;
        color: black;
        text-align: left;
        line-height: 35px;
    }
    table.table-bordered{
    border:1px solid black;
    margin-top:20px;
    margin-bottom:20px;
    }
    table.table-bordered > thead > tr > th{
        border:1px solid black;
    }
    table.table-bordered > tbody > tr > td{
        border:1px solid black;
    }
    </style>
</head>
<body>
<header>
    <div>Daftar Inventaris {{$org->name}} Tahun {{ date("Y") }} </div>
</header>
<footer>
    <?php
    date_default_timezone_set("Asia/Jakarta");
    $currentDateTime = new DateTime('now');
    $currentDate = $currentDateTime->format('d-m-Y H:i');
    echo "Dicetak pada : ".$currentDate." WIB"
    ?>
</footer>

<div class="container">
    <table class="table table-bordered w-auto" style="margin-top:20px">
        <thead>
            <tr>
                <th style="vertical-align: middle; text-align: center;" rowspan="2">No</th>
                <th style="vertical-align: middle; text-align: center;" rowspan="2">Kode</th>
                <th style="vertical-align: middle; text-align: center;" rowspan="2">Nama</th>
                <th style="vertical-align: middle; text-align: center;" rowspan="2">Sumber Anggaran</th>
                <th style="vertical-align: middle; text-align: center;" rowspan="2">Tahun</th>
                <th style="vertical-align: middle; text-align: center;" rowspan="2">Jenis</th>
                <th style="vertical-align: middle; text-align: center;" rowspan="2">Tempat</th>
                <th style="vertical-align: middle; text-align: center;" rowspan="2">Tgl.Beli</th>
                <th style="vertical-align: middle; text-align: center;" rowspan="2">Harga.Beli</th>
                <th style="vertical-align: middle; text-align: center;" colspan="4">Kondisi Barang</th>
            </tr>
            <tr>
                <th class="text-center">B</th>
                <th class="text-center">S</th>
                <th class="text-center">R</th>
                <th class="text-center">H</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($inv as $r)
            <tr>
                <td class="text-center">{{ $no++ }}</td>
                <td>{{ $r->qrcode }}</td>
                <td>{{ $r->name }}</td>
                <td>{{ $r->budgeting->name }}</td>
                <td class="text-center">{{ $r->fiscalyear->year }}</td>
                <td class="text-center">{{ $r->itemtype->shortname }}</td>
                <td class="text-center">{{ $r->storeroom->shortname }}</td>
                <td class="text-center">@empty($r->purchase_date) - @else {{date('d/m/Y', strtotime($r->purchase_date))}} @endempty</td>
                <td class="text-center">@if($r->purchase_price == 0) - @else Rp. {{number_format($r->purchase_price,0,',','.')}} @endif</td>
                <td class="text-center">@if($r->good_qty == 0) - @else {{ $r->good_qty }} @endif</td>
                <td class="text-center">@if($r->med_qty == 0) - @else {{ $r->med_qty }} @endif</td>
                <td class="text-center">@if($r->bad_qty == 0) - @else {{ $r->bad_qty }} @endif</td>
                <td class="text-center">@if($r->lost_qty == 0) - @else {{ $r->lost_qty }} @endif</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>