@extends('layout.backend.main')
@push('css')
@endpush
@push('scripts')
@endpush
@section('judul_hal','Grafik Inventaris')
@section('header_hal')
<li class="breadcrumb-item"><a href="#">Asset</a></li>
<li class="breadcrumb-item active">Grafik Inventaris</li>
@endsection
<!-- main menu sidebar -->
@section('menu_asset') 
<li class="nav-item menu-open">
@endsection
<!-- sub menu sidebar -->
@section('menu_graph')
<a href="/inventory/graph" class="nav-link active">
@endsection

@section('konten')  
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-6 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card card-outline card-dark">
              <div class="card-header">
                <h3 class="card-title">
                  Judul Grafik 1
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
                Isi Grafik 1
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->

          <!-- right col -->
          <section class="col-lg-6 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card card-outline card-dark">
              <div class="card-header">
                <h3 class="card-title">
                  Judul Grafik 2
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
                Isi Grafik 2
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- /.right col -->
        </div>
        <!-- /.row (main row) -->
@endsection