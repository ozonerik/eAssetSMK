<!DOCTYPE html>
<html>
<head>
  <title>Label Inventaris - Print</title>
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
    </style>
</head>
<body>
<header>
    <div>Label Inventaris {{$org->name}} Tahun {{ date("Y") }} </div>
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
@php
    $value = array_chunk($labels, 3);
    $no = 1;
@endphp
    <table style="margin-top:10px; margin-bottom:10px; border-collapse: collapse;">
    @foreach ($value as $row)
            <tr><td colspan="15" style="border: 2px solid; height:5px;"></td></tr>
            <tr>
            @foreach ($row as $r)
                <td style="border: 2px solid; width:5px;"></td>
                <td style="border: 2px solid; padding:5px 5px 5px 5px; vertical-align: middle; width:10px; height:80px" >{{ $no++ }}</td>
                <td style="border: 2px solid; padding:5px 5px 5px 5px; vertical-align: middle; width:80px; height:80px">
                    @if(empty($r['qrpicture']))
                        <img src="{{ public_path('img/1920x1080.png') }}" style="width:80px; height:80px"/>
                    @else
                        <img src="{{ storage_path('app/public/'.$r['qrpicture']) }}" style="width:80px; height:80px"/>
                    @endif
                </td>
                <td style="border: 2px solid;padding:5px 5px 5px 5px; vertical-align: middle; width:200px; height:80px">
                    Kode : {{ $r['qrcode'] }}<br>
                    Nama : {{ $r['name'] }}<br>
                    Sumber : {{ $r['budgeting']['name'] }}<br>
                    Tahun : {{ $r['fiscalyear']['year'] }}<br>
                </td>
                <td style="border: 2px solid; width:5px;"></td>
            @endforeach
            </tr>
            <tr><td colspan="15" style="border: 2px solid; height:5px;"></td></tr>
    @endforeach
    </table>
</div>
</body>
</html>