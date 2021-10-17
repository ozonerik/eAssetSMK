@extends('layout.backend.main')
@push('css')
<link rel="stylesheet" href="{{url('plugins/toastr/toastr.css')}}">
<!-- Select2 -->
<link rel="stylesheet" href="{{url('plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{url('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<!-- Datepicker -->
<link rel="stylesheet" href="{{url('plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
@endpush
@push('scripts')
<!-- Select2 -->
<script src="{{url('plugins/select2/js/select2.full.min.js')}}"></script>
<!-- Datepicker -->
<script src="{{url('plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{url('plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.id.js')}}" charset="UTF-8"></script>
<script>  
  $('#tglbeli').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd',
    todayHighlight:true,
    language:'id',
    todayBtn:'linked',
    todayHighlight:true,
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
              <form method="POST" action="#">
                @csrf
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
                    <div class="col-sm-9 input-group date" id="tglbeli" data-target-input="nearest">
                        <input type="text" name="purchase_date" value="{{ old('purchase_date') }}" class="form-control datetimepicker-input @error('purchase_date') is-invalid @enderror" data-target="#tglbeli" placeholder="Tanggal Pembelian Barang ..."/>
                        <div class="input-group-append" data-target="#tglbeli" data-toggle="datetimepicker">
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
                        <input type="text" name="purchase_price" value="{{ old('purchase_price') }}" class="form-control datetimepicker-input @error('purchase_price') is-invalid @enderror" placeholder="Harga Pembelian Barang ..."/>
                        @error('purchase_price')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <a href="/inventory" class="btn btn-default gt">Cancel</a>
                <button type="submit" class="btn btn-primary float-right ">Update</button>
              </form>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
        </div>
        <!-- /.row (main row) -->
@endsection