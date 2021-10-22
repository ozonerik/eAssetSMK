@extends('layout.backend.main')
@push('css')
@livewireStyles
@endpush
@push('scripts')
@livewireScripts
<!-- ChartJS -->
<script src="{{url('plugins/chart.js/Chart.min.js')}}"></script>
<script>
  $(function () {

    var jsonData=<?php echo json_encode($budget); ?>;
    
    const selectbudget = document.getElementById('selectbudget');
    selectbudget.addEventListener('change',budgetTracker)
    function budgetTracker(){
      console.log(selectbudget.value.split(','));
      myChart.data.datasets[0].data=selectbudget.value.split(',');
      myChart.update();
    }

    var ctx = document.getElementById('chart1').getContext('2d')
    const myChart = new Chart(ctx, {
      type: 'pie',
      data: 
          {
            labels: [
                'Baik',
                'Sedang',
                'Rusak',
                'Hilang'
            ],
            datasets: [
              {
                data: [0,0,0,0],
                backgroundColor : ['#0464FF', '#00F15C', '#FFDB00', '#FD3434'],
              }
            ]
          },
      options: 
          {
            maintainAspectRatio : false,
            responsive : true,
          }
    })

  })
</script>
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
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">
                  Kondisi Barang Berdasarkan Sumber Dana
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
                <label>Sumber Dana</label>
                <select class="form-control" id="selectbudget">
                  <option value="">&nbsp;</option>
                  @foreach($budget as $row)
                  <option value="{{$row->datagraph}}">{{$row->budgeting->name}}</option>
                  @endforeach
                </select>
                <canvas id="chart1" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->

          <!-- right col -->
          <section class="col-lg-6 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card card-success">
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
              <livewire:counter />
                  <canvas id="pieChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- /.right col -->
        </div>
        <!-- /.row (main row) -->
@endsection