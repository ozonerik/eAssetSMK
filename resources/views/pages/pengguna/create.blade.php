@extends('layout.backend.main')
@push('css')
<link rel="stylesheet" href="{{url('plugins/toastr/toastr.css')}}">
<!-- Select2 -->
<link rel="stylesheet" href="{{url('plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{url('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endpush
@push('scripts')
<!-- Select2 -->
<script src="../../plugins/select2/js/select2.full.min.js"></script>
<script>
  $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()
      $('.select2-selection').css('border-color','#DEE2E6');
      //Initialize Select2 Elements
      $('.select2bs4').select2({
      theme: 'bootstrap4'
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
</script>
@endpush
@section('judul_hal','Tambah Pengguna')
@section('header_hal')
<li class="breadcrumb-item"><a href="#">Konfigurasi</a></li>
<li class="breadcrumb-item"><a href="/pengguna">Pengguna</a></li>
<li class="breadcrumb-item active">Add</li>
@endsection
<!-- main menu sidebar -->
@section('menu_konfig') 
<li class="nav-item menu-open">
@endsection
<!-- sub menu sidebar -->
@section('menu_pengguna')
<a href="/pengguna" class="nav-link active">
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
                  Tambah Pengguna
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
              <form method="POST" action="{{route('pengguna.store')}}">
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                      <input type="text" name="name" autofocus required value="{{ old('name') }}"class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name ...">
                      @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                      @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" name="email" required value="{{ old('email') }}"class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email ...">
                      @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                      @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                      <input type="password" name="password" required class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password ...">
                      @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                      @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="roles" class="col-sm-2 col-form-label">Roles</label>
                    <div class="col-sm-10 select2-blue">
                      <select class="select2 form-control @error('roles') is-invalid @enderror" name="roles[]" multiple="multiple" data-placeholder="Select a Role" data-dropdown-css-class="select2-blue" style="width: 100%;">
                      @foreach($roles as $r)
                        <option value="{{$r->name}}"
                        {{in_array( $r->name, collect(old('roles'))->toArray() ) ? ' selected="selected" ':''}}
                        >{{$r->name}}</option>
                      @endforeach
                      </select>
                      @error('roles')
                        <span class="invalid-feedback">{{ $message }}</span>
                      @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="permission" class="col-sm-2 col-form-label">Permission</label>
                    <div class="col-sm-10 select2-blue">
                      <select class="select2 form-control @error('permissions') is-invalid @enderror" name="permissions[]" multiple="multiple" data-placeholder="Select a Role" data-dropdown-css-class="select2-blue" style="width: 100%;">
                      @foreach($permission as $p)
                      <option value="{{$p->name}}"
                        {{in_array( $p->name, collect(old('permissions'))->toArray() )?' selected="selected" ':''}}
                      >{{$p->name}}</option>
                      @endforeach
                      </select>
                      @error('permissions')
                        <span class="invalid-feedback">{{ $message }}</span>
                      @enderror
                    </div>
                </div>
                  <a href="/pengguna" class="btn btn-default gt">Cancel</a>
                  <button type="submit" class="btn btn-primary float-right ">Add</button>
              </form>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
        </div>
        <!-- /.row (main row) -->
@endsection