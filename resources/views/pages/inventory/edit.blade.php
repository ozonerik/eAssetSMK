@extends('layout.backend.main')
@push('css')
<link rel="stylesheet" href="{{url('plugins/toastr/toastr.css')}}">
<!-- Select2 -->
<link rel="stylesheet" href="{{url('plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{url('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<!-- Datepicker -->
<link rel="stylesheet" href="{{url('plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
<style>
  #img-preview {
  display: none; 
}
#img-preview img {  
  max-width: 420px;
  height: auto; 
  display: block;   
}
</style>
@endpush
@push('scripts')
<!-- Select2 -->
<script src="{{url('plugins/select2/js/select2.full.min.js')}}"></script>
<!-- Datepicker -->
<script src="{{url('plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{url('plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.id.js')}}" charset="UTF-8"></script>
<!-- InputMask -->
<script src="{{url('plugins/moment/moment.min.js')}}"></script>
<script src="{{url('plugins/inputmask/jquery.inputmask.min.js')}}"></script>
<script>
  $(function () {
    $('#hargabeli').inputmask({
      alias: "decimal", 
      groupSeparator: ".",
      allowMinus: false, 
      max: 9999999999,
      rightAlign: false,
      removeMaskOnSubmit:true,
      showMaskOnHover: false,
      showMaskOnFocus: false,
      });
      $('#tglbeli').inputmask({
      alias: "datetime", 
      inputFormat: "dd/mm/yyyy",
      outputFormat: "yyyy-mm-dd",
      removeMaskOnSubmit:true,
      showMaskOnHover: false,
      showMaskOnFocus: false,
      })
  });
</script>
<script>
  $(document).ready(function() {
    const chooseFile = document.getElementById("file-upload");
    const imgPreview = document.getElementById("img-preview");
    chooseFile.addEventListener("change", function () {
        $("#file-name").text(this.files[0].name);
        getImgData();
    });
    function getImgData() {
      const files = chooseFile.files[0];
      if (files) {
        const fileReader = new FileReader();
        fileReader.readAsDataURL(files);
        fileReader.addEventListener("load", function () {
          imgPreview.style.display = "block";
          imgPreview.innerHTML = '<img class="rounded" src="' + this.result + '" />';
        });    
      }
    }
  });
</script>
<script>  
  $('#tglbeli').datepicker({
    autoclose: true,
    todayHighlight:true,
    language:'id',
    todayBtn:'linked',
    todayHighlight:true,
    format: 'dd/mm/yyyy',
    endDate: '0',
  })
</script>
<script>
  $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()
      $('.select2-selection').css('border-color','#DEE2E6');
      //Initialize Select2 Elements
      $('.select2bs4').select2({
      theme: 'bootstrap4',
      allowClear: true
      })
  })
</script>
<!--toastr-->
<script src="{{url('plugins/toastr/toastr.min.js')}}"></script>
<script>
  @if(Session::has('error'))
    toastr.options =
    {
      "closeButton" : true,
      "progressBar" : true
    }
  	toastr.error("{{ session('error') }}");
  @endif
  @if(Session::has('success'))
    toastr.options =
    {
      "closeButton" : true,
      "progressBar" : true
    }
  	toastr.success("{{ session('success') }}");
  @endif
</script>
@endpush
@section('judul_hal','Edit Inventaris')
@section('header_hal')
<li class="breadcrumb-item"><a href="#">Asset</a></li>
<li class="breadcrumb-item"><a href="/inventory">Inventaris</a></li>
<li class="breadcrumb-item active">Edit</li>
@endsection
<!-- main menu sidebar -->
@section('menu_asset') 
<li class="nav-item menu-open">
@endsection
<!-- sub menu sidebar -->
@section('menu_inventaris')
<a href="/inventory" class="nav-link active">
@endsection

@section('konten')  
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card card-outline card-dark">
              <div class="card-header">
                <h3 class="card-title">
                  Edit Inventaris
                </h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
              @if(($inv->organitation_id == Auth::user()->organitation_id) or (Auth::user()->roles->pluck('name')->first() == 'admin'))
              <form method="POST" action="{{ route('inventory.update', Crypt::encryptString($inv->id)) }}" autocomplete="off"  enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                  <div class="col-sm-6 text-center text-md-left">
                    @if(empty($inv->qrpicture))
                      <img src="{{ asset('img/1920x1080.png') }}" class="img-fluid img-thumbnail rounded" style="width:100px;height:100px" />
                    @else
                      <img src="{{ asset('storage/'.$inv->qrpicture) }}" class="img-fluid img-thumbnail rounded" style="width:100px;height:100px"/>
                    @endif
                  </div>
                  <div class="col-sm-6 text-center text-md-right">
                    @if(empty($inv->picture))
                      <img src="{{ asset('img/1920x1080.png') }}" class="img-fluid img-thumbnail rounded" style="max-width:240px"/>
                    @else
                      <img src="{{ asset('storage/'.$inv->picture) }}" class="img-fluid img-thumbnail rounded" style="max-width:240px"/>
                    @endif
                  </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Kode Barang</label>
                    <div class="col-sm-9">
                      <input type="text" name="qrcode" readonly value="{{ $inv->qrcode }}"class="form-control ">
                    </div>
                </div>
                @hasanyrole('admin')
                <div class="form-group row">
                    <label for="organitation" class="col-sm-3 col-form-label">Organisasi</label>
                    <div class="col-sm-9">
                      @php
                          $old_org = (old('_token') !== null) ? old('organitation') : $inv->organitation_id;            
                      @endphp
                      <select class="select2bs4 form-control" required name="organitation" data-placeholder="Pilih Organisasi..." style="width: 100%;">
                      @if(empty($old_org))
                        <option value="" selected="selected" >&nbsp;</option>
                      @endif
                      @foreach($organitation as $row)
                        <option value="{{$row->id}}" {{$old_org==$row->id ? ' selected="selected" ' : ''}} >[ {{Str::upper($row->shortname)}} ] {{$row->name}}</option>
                      @endforeach
                      </select>
                      @error('organitation')
                        <span class="invalid-feedback">{{ $message }}</span>
                      @enderror
                    </div>
                </div>
                @endhasanyrole
                <div class="form-group row">
                    <label for="budgeting" class="col-sm-3 col-form-label">Sumber Anggaran</label>
                    <div class="col-sm-9">
                      @php
                          $old_budget = (old('_token') !== null) ? old('budgeting') : $inv->budgeting_id;            
                      @endphp
                      <select class="select2bs4 form-control" required name="budgeting" data-placeholder="Pilih Sumber Anggaran" style="width: 100%;">
                      @if(empty($old_budget))
                        <option value="" selected="selected" >&nbsp;</option>
                      @endif
                      @foreach($budgeting as $row)
                        <option value="{{$row->id}}" {{$old_budget==$row->id ? ' selected="selected" ' : ''}} >[ {{Str::upper($row->organitation->shortname)}} ] [ {{Str::upper($row->code)}} ] {{$row->name}}</option>
                      @endforeach
                      </select>
                      @error('budgeting')
                        <span class="invalid-feedback">{{ $message }}</span>
                      @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="fiscal" class="col-sm-3 col-form-label">Tahun Anggaran</label>
                    <div class="col-sm-9">
                      @php
                          $old_fiscal = (old('_token') !== null) ? old('fiscalyear') : $inv->fiscalyear_id;            
                      @endphp
                      <select class="select2bs4 form-control" required name="fiscal" data-placeholder="Pilih Tahun Anggaran" style="width: 100%;">
                      @if(empty($old_fiscal))
                        <option value="" selected="selected" >&nbsp;</option>
                      @endif
                      @foreach($fiscal as $row)
                        <option value="{{$row->id}}" {{$old_fiscal==$row->id ? ' selected="selected" ' : ''}} >[ {{Str::upper($row->organitation->shortname)}} ] [ {{Str::upper($row->code)}} ] {{$row->year}}</option>
                      @endforeach
                      </select>
                      @error('fiscal')
                        <span class="invalid-feedback">{{ $message }}</span>
                      @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="itemtype" class="col-sm-3 col-form-label">Jenis Barang</label>
                    <div class="col-sm-9">
                      @php
                          $old_itemtype = (old('_token') !== null) ? old('itemtype') : $inv->itemtype_id;            
                      @endphp
                      <select class="select2bs4 form-control" required name="itemtype" data-placeholder="Pilih Jenis Barang" style="width: 100%;">
                      @if(empty($old_itemtype))
                        <option value="" selected="selected" >&nbsp;</option>
                      @endif
                      @foreach($itemtype as $row)
                        <option value="{{$row->id}}" {{$old_itemtype==$row->id ? ' selected="selected" ' : ''}} >[ {{Str::upper($row->organitation->shortname)}} ] [ {{Str::upper($row->code)}} ] {{$row->typename}}</option>
                      @endforeach
                      </select>
                      @error('itemtype')
                        <span class="invalid-feedback">{{ $message }}</span>
                      @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="storeroom" class="col-sm-3 col-form-label">Tempat Penyimpanan</label>
                    <div class="col-sm-9">
                      @php
                          $old_storeroom = (old('_token') !== null) ? old('storeroom') : $inv->storeroom_id;            
                      @endphp
                      <select class="select2bs4 form-control" required name="storeroom" data-placeholder="Pilih Tempat Penyimpanan" style="width: 100%;">
                      @if(empty($old_storeroom))
                        <option value="" selected="selected" >&nbsp;</option>
                      @endif
                      @foreach($storeroom as $row)
                        <option value="{{$row->id}}" {{$old_storeroom==$row->id ? ' selected="selected" ' : ''}} >[ {{Str::upper($row->organitation->shortname)}} ] [ {{Str::upper($row->shortname)}} ] {{$row->roomname}}</option>
                      @endforeach
                      </select>
                      @error('storeroom')
                        <span class="invalid-feedback">{{ $message }}</span>
                      @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Name Barang</label>
                    <div class="col-sm-9">
                      <input type="text" name="name" required value="{{ old('name',$inv->name) }}"class="form-control @error('name') is-invalid @enderror" placeholder="Nama Barang ...">
                      @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                      @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Deskripsi Barang</label>
                    <div class="col-sm-9">
                      <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="3" placeholder="Deksripsi Barang ...">{{ old('description',$inv->description) }}</textarea>
                      @error('description')
                        <span class="invalid-feedback">{{ $message }}</span>
                      @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tanggal Pembelian</label>
                    <div class="col-sm-9 input-group date">
                        @php
                        $old_purchase= date('d/m/Y', strtotime(old('purchase_date',$inv->purchase_date)));
                        @endphp
                        <input type="text" required name="purchase_date" id="tglbeli" value="{{ $old_purchase }}" class="form-control @error('purchase_date') is-invalid @enderror" placeholder="Tanggal Pembelian Barang ..."/>
                        <div class="input-group-append">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                        @error('purchase_date')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Harga Pembelian</label>
                    <div class="col-sm-9 input-group" >
                        <div class="input-group-prepend">
                            <div class="input-group-text">Rp.</div>
                        </div>
                        <input id="hargabeli" type="text" required name="purchase_price" value="{{ old('purchase_price',$inv->purchase_date) }}" class="form-control @error('purchase_price') is-invalid @enderror" placeholder="Harga Pembelian Barang ..."/>
                        @error('purchase_price')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Satuan Barang</label>
                    <div class="col-sm-9">
                    <input type="text" name="unit" required value="{{ old('unit',$inv->unit) }}"class="form-control @error('unit') is-invalid @enderror" placeholder="Satuan Barang...">
                      @error('unit')
                        <span class="invalid-feedback">{{ $message }}</span>
                      @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Jumlah Barang [Baik]</label>
                    <div class="col-sm-9">
                      <input type="number" name="good_qty" required value="{{ old('good_qty',$inv->good_qty) }}"class="form-control @error('good_qty') is-invalid @enderror" placeholder="Jumlah Barang Kondisi Baik ...">
                      @error('good_qty')
                        <span class="invalid-feedback">{{ $message }}</span>
                      @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Jumlah Barang [Cukup]</label>
                    <div class="col-sm-9">
                      <input type="number" name="med_qty" required value="{{ old('med_qty',$inv->med_qty) }}"class="form-control @error('med_qty') is-invalid @enderror" placeholder="Jumlah Barang Kondisi Cukup Baik ...">
                      @error('med_qty')
                        <span class="invalid-feedback">{{ $message }}</span>
                      @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Jumlah Barang [Rusak]</label>
                    <div class="col-sm-9">
                      <input type="number" name="bad_qty" required value="{{ old('bad_qty',$inv->bad_qty) }}"class="form-control @error('bad_qty') is-invalid @enderror" placeholder="Jumlah Barang Kondisi Rusak ...">
                      @error('bad_qty')
                        <span class="invalid-feedback">{{ $message }}</span>
                      @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Jumlah Barang [Hilang]</label>
                    <div class="col-sm-9">
                      <input type="number" name="lost_qty" required value="{{ old('lost_qty',$inv->lost_qty) }}"class="form-control @error('lost_qty') is-invalid @enderror" placeholder="Jumlah Barang Kondisi Hilang ...">
                      @error('lost_qty')
                        <span class="invalid-feedback">{{ $message }}</span>
                      @enderror
                    </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Upload Foto Barang</label>
                  <div class="col-sm-9">
                    <div class='custom-file '>
                          <input id='file-upload' type='file' name='picture' class='custom-file-input' id='photo_inv' accept="image/*" >
                          <label id='file-name' class='custom-file-label' style="color:#939ba2" for='photo_inv'>Upload Foto Barang ...</label>
                    
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Preview Foto Barang</label>
                  <div id="img-preview" class="col-sm-9"></div>
                </div>
                <!-- <input type="file" accept="image/*" capture="camera"> -->
                <a href="/inventory" class="btn btn-default gt">Cancel</a>
                <button type="submit" class="btn btn-primary float-right ">Simpan</button>
              </form>
              @else
              <div class="form-group row">
                  <div class="col-sm-12 text-center text-danger">User Tidak Memiliki Akses Edit Inventaris </div>
              </div>
              @endif
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
        </div>
        <!-- /.row (main row) -->
@endsection