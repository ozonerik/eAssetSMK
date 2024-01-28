@extends('layout.backend.main')
@push('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{url('plugins/toastr/toastr.css')}}">
<!-- Select2 -->
<link rel="stylesheet" href="{{url('plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{url('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<meta name="csrf-token" content="{{ csrf_token() }}">
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
<!-- DataTables  & Plugins -->
<script src="{{url('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{url('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{url('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{url('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<!-- table setting -->
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
<script>
  $(function () {
    $('#org-table').DataTable({
      "paging": true,
      "pageLength": 10,
      "lengthChange": true,
      "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
      "searching": true,
      "ordering": true,
      "autoWidth": false,
      "responsive": true,
      "order": [[ 1, "asc" ]],
      "columnDefs": [
        { "orderable": false, "targets": [4] },
        { "searchable": false, "targets": [4] }
      ]
    });
  });
</script>
@endpush
@section('judul_hal','Organisasi')
@section('header_hal')
<li class="breadcrumb-item"><a href="#">Konfigurasi</a></li>
<li class="breadcrumb-item active">Organisasi</li>
@endsection
<!-- main menu sidebar -->
@section('menu_konfig') 
<li class="nav-item menu-open">
@endsection
<!-- sub menu sidebar -->
@section('menu_organisasi')
<a href="/organitation" class="nav-link active">
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
                  Organisasi
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
                <div class="divider bg-dark rounded mb-4">
                  @can('create.organisasi')
                  <a href="{{route('organitation.create')}}" class="btn btn-success my-2 ml-2"  role="button" data-toggle="tooltip" data-placement="top" title="Add Organisasi">
                  Add Organisasi
                  </a> 
                  @endcan
                </div>
                @php
                    $no = 1;
                @endphp
                <table id="org-table" class="table table-hover">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Code</th>
                      <th scope="col">Short Name</th>
                      <th scope="col">Full Name</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                @can('read.organisasi')
                  <tbody>
                  @foreach($org as $row)
                    <tr>
                      <th scope="row">{{ $no++ }}</th>
                      <td>{{Str::upper($row->code)}}</td>
                      <td>{{Str::upper($row->shortname)}}</td>
                      <td>{{$row->name}}</td>
                      <td>
                          @can('update.organisasi')
                            <form action="{{ route('organitation.edit', Crypt::encryptString($row->id)) }}" method="post" class="d-inline mx-1">
                            @csrf
                            @method('GET')
                                <button type="submit" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Update Organisasi">Edit</button>
                            </form>
                          @endcan

                          <form action="{{ route('organitation.del', Crypt::encryptString($row->id)) }}" method="post" class="d-inline mx-1">
                          @csrf
                          @method('DELETE')                      
                          <x-modal name="delorg" target="modal-del-{{$row->id}}" title="Confirmation" message="Apakah anda yakin ingin menghapus semua asset pada organisasi <b> {{$row->name}} </b>" divid="{{$row->name}}" tombol="Delete" jenis="danger" />
                          </form>
                          @can('delete.organisasi')
                          <button type="button" id="del-{{$row->id}}" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-del-{{$row->id}}">
                            Delete
                          </button>
                          @endcan
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                @else
                <tr>
                  <td colspan="5" class="text-center text-danger">Tidak Memiliki Akses Read Organisasi </td>
                </tr>
                @endcan
                </table>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
        </div>
        <!-- /.row (main row) -->
@endsection