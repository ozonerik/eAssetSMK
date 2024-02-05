@extends('layout.backend.main')
@push('css')
@endpush
@push('scripts')
@endpush
@section('judul_hal','Dashboard')
@section('header_hal')
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Dashboard</li>
@endsection
@section('menu_dashboard') 
<a href="/dashboard" class="nav-link active">
@endsection
@section('konten')
      @foreach($inv as $row)
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-12 col-12">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>{{$row->total}}</h3>
                <p>Jumlah Asset</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{route('inventory.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <!-- /.row -->

        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$row->baik}}</h3>
                <p>Kondisi Baik</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{route('inventory.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$row->sedang}}</h3>

                <p>Kondisi Sedang</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{route('inventory.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
              <h3>{{$row->rusak}}</h3>
                <p>Kondisi Rusak</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{route('inventory.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$row->hilang}}</h3>
                <p>Kondisi Hilang</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{route('inventory.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
      @endforeach

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card card-outline card-dark">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-exchange-alt"></i>
                  Changelogs
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
              <h3>About eAssetSMK</h3>
              <p>
                <b>eAssetSMK</b> adalah aplikasi sistem pencatatan Asset / Barang Inventaris Sekolah yang pelabelannya menggunakan sistem QrCode dengan pengecakan status asset secara online
              </p>
              <div class="badge badge-primary" >V.1.0.3</div>
              <div class="font-weight-bold text-danger">Fitur yang belum selesai:</div>
              <ul class="list-style">
                <li>Import, Export (.xlsx), Edit/Del Selection inventaris</li>
                <li>Chekbox Inventaris</li>
                <li>Print Label Per Barang  x Jumlah Label Copy (Menu Inventaris)</li>
                <li>Print Label Barang  by Nomor Urut Barang (Menu Print)</li>
              </ul>

              <div class="font-weight-bold text-primary">Fitur yang sudah selesai:</div>
              <ul class="list-style">
                <li>CRUD Pengguna</li>
                <li>CRUD Profil</li>
                <li>QrCode Generate</li>
                <li>QrCode Link Status</li>
                <li>Editing Landing Page</li>
                <li>Dashboard Information</li>
                <li>CRUD Sumber Anggaran, Tahun Anggaran, Jenis Barang, Penyimpanan, Sumber Anggaran</li>
                <li>CRUD Asset Barang</li>
                <li>CRUD Organisasi</li>
                <li>Print Asset, Label (PDF)</li>
                <li>Update status Asset via Link QrCode (user must login)</li>
              </ul>
              <div><i class="fas fa-envelope text-primary"></i> <a href="mailto:ozonerik@gmail.com"> ozonerik@gmail.com</a> </div>
              <div><i class="fab fa-github text-black"></i> <a href="https://github.com/ozonerik/eAssetSMK"> eAssetSMK</a> </div>
              <div><i class="fab fa-whatsapp text-success"></i> <a href="https://wa.me/081324275362?text=Hi%2C%20Bolehkah%20saya%20bertanya%20sesuatu"> WA admin</a> </div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
        </div>
        <!-- /.row (main row) -->
@endsection