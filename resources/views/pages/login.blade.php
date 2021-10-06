@extends('layout.frontend.login.main')
@section('judul_hal','Login')
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
        <img src="{{url('img/logo2.png')}}" alt="eJadwal" class="" style="width:70px; height:70px">
        </div>
        <div class="card-body">
          <form action="/login" method="post">
            @csrf
            <div class="input-group mb-3">
              <input type="email" name="email" id="email" class="form-control" placeholder="Email" 
              autofocus required value="{{ old('email') }}">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <!-- /.col -->
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
              </div>
              <div class="col-12 text-center mt-3">
              <a href="/" class="stretched-link">Back to Home</a>
              </div>
              <!-- /.col -->
            </div>
          </form>
        </div>
        <!-- /.card-body -->
      </div>
@endsection