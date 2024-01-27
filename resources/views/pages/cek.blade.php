@extends('layout.frontend.login.main')
@section('judul_hal','Check Asset')
@push('css')
<style>
body {
  background: url("{{url('img/background.png')}}") top left / 300px repeat;
  transform-origin: top;
}
</style>
<link rel="stylesheet" href="{{url('plugins/toastr/toastr.css')}}">
@endpush
@push('scripts')
<script src="{{url('plugins/toastr/toastr.min.js')}}"></script>
<script>
  @if(Session::has('loginError'))
    toastr.options =
    {
      "closeButton" : true,
      "progressBar" : true
    }
  	toastr.error("{{ session('loginError') }}");
  @endif
</script>
@endpush
@section('login_form')
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
        <img src="{{ asset('storage/'.$inv->picture) }}" class="" style="width:100%; height:100%">
        </div>
        <div class="card-body">
        <table id="cek-table" class="table table-borderless">
            <tr>
                <td class="w-25" rowspan="6">
                    <img src="{{ asset('storage/'.$inv->qrpicture) }}" class="img-thumbnail">
                    <p>{{$inv->qrcode}}</p>
                    <p><b>Kondisi Barang</b></p>
                    <b>Baik :</b> {{$inv->good_qty}}<br>
                    <b>Sedang :</b> {{$inv->med_qty}}<br>
                    <b>Rusak :</b> {{$inv->bad_qty}}<br>
                    <b>Hilang :</b> {{$inv->lost_qty}}<br>
                </td>
                <td class="w-75" ><b>Name : </b>{{$inv->name}}</td>
            </tr>
            <tr>
                <td><b>Sumber Anggaran : </b>{{$inv->budgeting->name}}</td>
            </tr>
            <tr>
                <td><b>Tahun Anggaran : </b>{{$inv->fiscalyear->year}}</td>
            </tr>
            <tr>
                <td><b>Jenis Barang : </b>{{$inv->itemtype->shortname}}</td>
            </tr>
            <tr>
                <td><b>Penyimpanan : </b>{{$inv->storeroom->shortname}}</td>
            </tr>
            <tr>
                <td><b>Organisasi : </b>{{$inv->organitation->shortname}}</td>
            </tr>
        </table>
        </div>
        <!-- /.card-body -->
    </div>
@endsection