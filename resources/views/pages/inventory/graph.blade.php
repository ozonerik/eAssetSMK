@extends('layout.backend.main')
@push('css')
  @livewireStyles
@endpush
@push('scripts')
  @livewireScripts
  <!-- ChartJS -->
  <script src="{{url('plugins/chart.js/Chart.min.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
  <!-- graph 2 -->
  <script>
    $(function () {
      const data2 = document.getElementById('data2');

      $("#btnGraph").click(graph2Tracker);

      function graph2Tracker(){
        console.log(data2.value.split(','));
        myChart.data.datasets[0].data=data2.value.split(',');
        myChart.update();
      }

      var ctx = document.getElementById('chart2').getContext('2d')
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
        plugins: [ChartDataLabels],
        options: 
            {
              maintainAspectRatio : false,
              responsive : true,
              plugins: {
                datalabels: {
                  color: '#000000'
                }
              }
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
          <section class="col-lg-12 connectedSortable">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">
                  Grafik Kondisi Barang Inventaris
                </h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                @livewire('livegraph')
                <canvas id="chart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
            </div>
          </section>
        </div>
        <!-- /.row (main row) -->
@endsection