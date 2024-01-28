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
@section('judul_hal','Add Penyimpanan')
@section('header_hal')
<li class="breadcrumb-item"><a href="#">Referensi</a></li>
<li class="breadcrumb-item"><a href="/storeroom">Penyimpanan</a></li>
<li class="breadcrumb-item active">Add Penyimpanan</li>
@endsection
<!-- main menu sidebar -->
@section('menu_referensi') 
<li class="nav-item menu-open">
@endsection
<!-- sub menu sidebar -->
@section('menu_storeroom')
<a href="/storeroom" class="nav-link active">
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
                  Add Penyimpanan
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
              <form method="POST" action="{{route('storeroom.store')}}" autocomplete="off"  enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Shortname Penyimpanan</label>
                    <div class="col-sm-9">
                      <input type="text" name="shortname" required value="{{ old('shortname') }}"class="form-control @error('shortname') is-invalid @enderror" placeholder="Shortname Penyimpanan...">
                      @error('shortname')
                        <span class="invalid-feedback">{{ $message }}</span>
                      @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tempat Penyimpanan</label>
                    <div class="col-sm-9">
                      <input type="text" name="roomname" required value="{{ old('roomname') }}"class="form-control @error('roomname') is-invalid @enderror" placeholder="Tempat Penyimpanan...">
                      @error('roomname')
                        <span class="invalid-feedback">{{ $message }}</span>
                      @enderror
                    </div>
                </div>
                <a href="/storeroom" class="btn btn-default gt">Cancel</a>
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