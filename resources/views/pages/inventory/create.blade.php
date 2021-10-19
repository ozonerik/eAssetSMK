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
  width: 100%;
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
    format: 'dd/mm/yyyy'
  })
</script>
<script>
  $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()
      $('.select2-selection').css('border-color','#DEE2E6');
      //Initialize Select2 Elements
      $('.select2bs4').prepend('<option selected=""></option>').select2({
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
@section('judul_hal','Add Inventaris')
@section('header_hal')
<li class="breadcrumb-item"><a href="#">Asset</a></li>
<li class="breadcrumb-item"><a href="/inventory">Inventaris</a></li>
<li class="breadcrumb-item active">Add Inventaris</li>
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
                  Add Inventaris
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
              <form method="POST" action="{{route('inventory.store')}}" autocomplete="off"  enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="budgeting" class="col-sm-3 col-form-label">Sumber Anggaran</label>
                    <div class="col-sm-9">
                      <select class="select2bs4 form-control" name="budgeting" data-placeholder="Pilih Sumber Anggaran" style="width: 100%;">
                      @foreach($budgeting as $row)
                        <option value="{{$row->id}}">[ {{Str::upper($row->organitation->shortname)}} ] [ {{Str::upper($row->code)}} ] {{$row->name}}</option>
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
                      <select class="select2bs4 form-control" name="fiscal" data-placeholder="Pilih Tahun Anggaran" style="width: 100%;">
                      @foreach($fiscal as $row)
                        <option value="{{$row->id}}">[ {{Str::upper($row->organitation->shortname)}} ] [ {{Str::upper($row->code)}} ] {{$row->year}}</option>
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
                      <select class="select2bs4 form-control" name="itemtype" data-placeholder="Pilih Jenis Barang" style="width: 100%;">
                      @foreach($itemtype as $row)
                        <option value="{{$row->id}}">[ {{Str::upper($row->organitation->shortname)}} ] [ {{Str::upper($row->code)}} ] {{$row->typename}}</option>
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
                      <select class="select2bs4 form-control" name="storeroom" data-placeholder="Pilih Tempat Penyimpanan" style="width: 100%;">
                      @foreach($storeroom as $row)
                        <option value="{{$row->id}}">[ {{Str::upper($row->organitation->shortname)}} ] [ {{Str::upper($row->shortname)}} ] {{$row->roomname}}</option>
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
                      <input type="text" name="name" required value="{{ old('name') }}"class="form-control @error('name') is-invalid @enderror" placeholder="Nama Barang ...">
                      @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                      @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Deskripsi Barang</label>
                    <div class="col-sm-9">
                      <textarea class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" rows="3" placeholder="Deksripsi Barang ..."></textarea>
                      @error('description')
                        <span class="invalid-feedback">{{ $message }}</span>
                      @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tanggal Pembelian</label>
                    <div class="col-sm-9 input-group date">
                        <input type="text" name="purchase_date" id="tglbeli" value="{{ old('purchase_date') }}" class="form-control @error('purchase_date') is-invalid @enderror" placeholder="Tanggal Pembelian Barang ..."/>
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
                        <input id="hargabeli" type="text" name="purchase_price" value="{{ old('purchase_price') }}" class="form-control @error('purchase_price') is-invalid @enderror" placeholder="Harga Pembelian Barang ..."/>
                        @error('purchase_price')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Jumlah Barang [Baik]</label>
                    <div class="col-sm-9">
                      <input type="number" name="good_qty" value="{{ old('good_qty') }}"class="form-control @error('good_qty') is-invalid @enderror" placeholder="Jumlah Barang Kondisi Baik ...">
                      @error('good_qty')
                        <span class="invalid-feedback">{{ $message }}</span>
                      @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Jumlah Barang [Cukup]</label>
                    <div class="col-sm-9">
                      <input type="number" name="med_qty" value="{{ old('med_qty') }}"class="form-control @error('med_qty') is-invalid @enderror" placeholder="Jumlah Barang Kondisi Cukup Baik ...">
                      @error('med_qty')
                        <span class="invalid-feedback">{{ $message }}</span>
                      @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Jumlah Barang [Rusak]</label>
                    <div class="col-sm-9">
                      <input type="number" name="bad_qty" value="{{ old('bad_qty') }}"class="form-control @error('bad_qty') is-invalid @enderror" placeholder="Jumlah Barang Kondisi Rusak ...">
                      @error('bad_qty')
                        <span class="invalid-feedback">{{ $message }}</span>
                      @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Jumlah Barang [Hilang]</label>
                    <div class="col-sm-9">
                      <input type="number" name="lose_qty" value="{{ old('lose_qty') }}"class="form-control @error('lose_qty') is-invalid @enderror" placeholder="Jumlah Barang Kondisi Hilang ...">
                      @error('lose_qty')
                        <span class="invalid-feedback">{{ $message }}</span>
                      @enderror
                    </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Upload Foto Barang</label>
                  <div class="col-sm-9">
                    <div class='custom-file '>
                          <input id='file-upload' type='file' name='picture' class='custom-file-input' id='photo_inv' accept="image/*" capture="camera">
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
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
        </div>
        <!-- /.row (main row) -->
@endsection