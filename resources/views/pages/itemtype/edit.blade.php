@extends('layout.backend.main')
@push('css')
<link rel="stylesheet" href="{{url('plugins/toastr/toastr.css')}}">
@endpush
@push('scripts')
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
@section('judul_hal','Edit Jenis Barang')
@section('header_hal')
<li class="breadcrumb-item"><a href="#">Referensi</a></li>
<li class="breadcrumb-item"><a href="/itemtype">Jenis Barang</a></li>
<li class="breadcrumb-item active">Edit</li>
@endsection
<!-- main menu sidebar -->
@section('menu_referensi') 
<li class="nav-item menu-open">
@endsection
<!-- sub menu sidebar -->
@section('menu_itemtype')
<a href="/itemtype" class="nav-link active">
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
                  Edit Jenis Barang
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
              <form method="POST" action="{{ route('itemtype.update', Crypt::encryptString($itemtype->id)) }}" autocomplete="off"  enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Kode Jenis Barang</label>
                    <div class="col-sm-9">
                      <input type="text" name="code" disabled required value="{{ old('code',$itemtype->code) }}"class="form-control @error('code') is-invalid @enderror" placeholder="Kode Jenis Barang...">
                      @error('code')
                        <span class="invalid-feedback">{{ $message }}</span>
                      @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Shortname Jenis Barang</label>
                    <div class="col-sm-9">
                      <input type="text" name="shortname" required value="{{ old('year',$itemtype->shortname) }}"class="form-control @error('shortname') is-invalid @enderror" placeholder="Shortname Jenis Barang...">
                      @error('shortname')
                        <span class="invalid-feedback">{{ $message }}</span>
                      @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Jenis Barang</label>
                    <div class="col-sm-9">
                      <input type="text" name="typename" required value="{{ old('year',$itemtype->typename) }}"class="form-control @error('typename') is-invalid @enderror" placeholder="Jenis Barang...">
                      @error('typename')
                        <span class="invalid-feedback">{{ $message }}</span>
                      @enderror
                    </div>
                </div>
                <!-- <input type="file" accept="image/*" capture="camera"> -->
                <a href="/itemtype" class="btn btn-default gt">Cancel</a>
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