@extends('layout.backend.main')
@push('css')
<link rel="stylesheet" href="{{url('plugins/toastr/toastr.css')}}">
<!-- Select2 -->
<link rel="stylesheet" href="{{url('plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{url('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endpush
@push('scripts')
<!-- Select2 -->
<script src="{{url('plugins/select2/js/select2.full.min.js')}}"></script>
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
@section('judul_hal','Edit Profile')
@section('header_hal')
<li class="breadcrumb-item"><a href="#">Profile</a></li>
<li class="breadcrumb-item active"><a href="/profile">Edit Profile</a></li>
@endsection
<!-- main menu sidebar -->
@section('menu_profile') 
<li class="nav-item menu-open">
@endsection
<!-- sub menu sidebar -->
@section('menu_editprofile')
<a href="/profile" class="nav-link active">
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
                  Edit Profile
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
              <form method="POST" action="{{ route('profile.update', Crypt::encryptString($user->id)) }}">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-9">
                      <input type="text" name="name" autofocus required value="{{ old('name',$user->name) }}"class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name ...">
                      @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                      @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                      <input type="email" name="email" required value="{{ old('email',$user->email) }}"class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email ...">
                      @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                      @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="organitation" class="col-sm-3 col-form-label">Organitation</label>
                    <div class="col-sm-9">
                      <input type="text" disabled name="organitation" 
                      value="@empty($user->organitation->shortname)@else{{ Str::upper($user->organitation->shortname) }}@endempty"
                      class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="role" class="col-sm-3 col-form-label">Roles</label>
                    <div class="col-sm-9">
                      <input type="text" disabled name="roles" value="{{ Str::title($user->roles->pluck('name')->implode(', ')) }}"class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="permissions" class="col-sm-3 col-form-label">Permissions</label>
                    <div class="col-sm-9">
                      <input type="text" disabled name="permissions" value="{{ Str::title($user->permissions->pluck('name')->implode(', ')) }}"class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="current_password" class="col-sm-3 col-form-label">Current Password</label>
                    <div class="col-sm-9">
                      <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" placeholder="Current Password ...">
                      @error('current_password')
                        <span class="invalid-feedback">{{ $message }}</span>
                      @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-3 col-form-label">New Password</label>
                    <div class="col-sm-9">
                      <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="New Password ...">
                      @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                      @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password_confirmation" class="col-sm-3 col-form-label">Confirm New Password</label>
                    <div class="col-sm-9">
                      <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" placeholder="Confirm New Password ...">
                      @error('password_confirmation')
                        <span class="invalid-feedback">{{ $message }}</span>
                      @enderror
                    </div>
                </div>
                  <a href="/pengguna" class="btn btn-default gt">Cancel</a>
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