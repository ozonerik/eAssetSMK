@extends('layout.frontend.check.main')
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
<div class="checkinv-box">
    <div class="card card-outline card-success">
        <div class="card-header text-center">
        <img src="{{ asset('storage/'.$inv->picture) }}" class="my-5" style="width:80%">
        </div>
        <div class="card-body">
        <table id="cek-table" class="table table-borderless">
            <tr>
                <td class="w-25" rowspan="6">
                    <img src="{{ asset('storage/'.$inv->qrpicture) }}" class="img-thumbnail">
                    <p>{{$inv->qrcode}}</p>
                    <p><b>Kondisi Barang</b></p>
                    <b>Baik :</b> {{$inv->good_qty}} {{$inv->unit}}<br>
                    <b>Sedang :</b> {{$inv->med_qty}} {{$inv->unit}}<br>
                    <b>Rusak :</b> {{$inv->bad_qty}} {{$inv->unit}}<br>
                    <b>Hilang :</b> {{$inv->lost_qty}} {{$inv->unit}}<br>
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
                <td><b>Penyimpanan : </b>{{strtoupper($inv->storeroom->shortname)}}</td>
            </tr>
            <tr>
                <td><b>Organisasi : </b>{{strtoupper($inv->organitation->shortname)}}</td>
            </tr>
        </table>
        <div class="row">
            <!-- /.col -->
            <div class="col-12">
            <form action="{{ route('inventory.edit', Crypt::encryptString($inv->id)) }}" method="get">
                <button type="submit" class="btn btn-success btn-block" data-toggle="tooltip" data-placement="top" title="Update Inventaris">Edit</button>
            </form>
            </div>
            <!-- /.col -->
        </div>
        </div>
        <!-- /.card-body -->
    </div>
</div>
@endsection