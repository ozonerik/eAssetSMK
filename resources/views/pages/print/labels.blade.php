<!DOCTYPE html>
<html>
<head>
  <title>Label Inventaris - Print</title>
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
@endphp
    <table class="table w-auto" style="margin-top:20px; margin-bottom:20px">
    @foreach ($value as $row)
            <tr><td colspan="2" style="border-color: black; border-style: none;"></td></tr>
            <tr>
            @foreach ($row as $r)
                <td style="border-color: black; border-style: solid; border-width: 1px 0px 1px 1px; width:120px;">
                    @if(empty($r['qrpicture']))
                        <img src="{{ asset('img/1920x1080.png') }}" class="img-fluid img-thumbnail rounded" style="width:100px;height:100px"/>
                    @else
                        <img src="{{ asset('storage/'. $r['qrpicture']) }}" class="img-fluid img-thumbnail rounded" style="width:100px;height:100px"/>
                    @endif
                </td>
                <td style="border-color: black; border-style: solid; border-width: 1px 1px 1px 0px;">
                    {{ $r['qrcode'] }}<br>
                    {{ $r['name'] }}
                </td>
                <td style="border-color: black; border-style: none; width:5px;"></td>
            @endforeach
            </tr>
    @endforeach
    </table>
</div>
</body>
</html>