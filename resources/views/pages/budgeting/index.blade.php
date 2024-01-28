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
    $('#budget-table').DataTable({
      "paging": true,
      "pageLength": 10,
      "lengthChange": true,
      "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
      "searching": true,
      "ordering": true,
      "autoWidth": false,
      "responsive": true,
      "order": [[ 0, "asc" ]],
      "columnDefs": [
        { "orderable": false, "targets": [5] },
        { "searchable": false, "targets": [5] }
      ]
    });
  });
</script>
@endpush
@section('judul_hal','Sumber Anggaran')
@section('header_hal')
<li class="breadcrumb-item"><a href="#">Referensi</a></li>
<li class="breadcrumb-item active">Sumber Anggaran</li>
@endsection
<!-- main menu sidebar -->
@section('menu_referensi') 
<li class="nav-item menu-open">
@endsection
<!-- sub menu sidebar -->
@section('menu_budgeting')
<a href="/budgeting" class="nav-link active">
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
                  Sumber Anggaran
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
                  @can('create.sumber_anggaran')
                  <a href="{{route('budgeting.create')}}" class="btn btn-success my-2 ml-2"  role="button" data-toggle="tooltip" data-placement="top" title="Add Budgeting">
                  Add Sumber Anggaran
                  </a> 
                  @endcan
                </div>
                @php
                    $no = 1;
                @endphp
                <table id="budget-table" class="table table-hover">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Code</th>
                      <th scope="col">Sumber Anggaran</th>
                      <th scope="col">Organitation</th>
                      <th scope="col">Created by</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                @can('read.sumber_anggaran')
                  <tbody>
                  @foreach($budget as $row)
                    <tr>
                      <th scope="row">{{ $no++ }}</th>
                      <td>{{Str::upper($row->code)}}</td>
                      <td>{{$row->name}}</td>
                      <td>{{Str::upper($row->organitation->shortname)}}</td>
                      <td>{{$row->user->name}}</td>
                      <td>
                      @hasanyrole('admin|kabeng')
                          @can('update.sumber_anggaran')
                            <form action="{{ route('budgeting.edit', Crypt::encryptString($row->id)) }}" method="post" class="d-inline mx-1">
                            @csrf
                            @method('GET')
                                <button type="submit" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Update Sumber Anggaran">Edit</button>
                            </form>
                          @endcan

                          <form action="{{ route('budgeting.del', Crypt::encryptString($row->id)) }}" method="post" class="d-inline mx-1">
                          @csrf
                          @method('DELETE')                      
                          <x-modal name="delbudget" target="modal-del-{{$row->id}}" title="Confirmation" message="Apakah anda yakin ingin menghapus {{$row->name}}" divid="{{$row->name}}" tombol="Delete" jenis="danger" />
                          </form>
                          @can('delete.sumber_anggaran')
                          <button type="button" id="del-{{$row->id}}" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-del-{{$row->id}}">
                            Delete
                          </button>
                          @endcan
                      @else
                        @if($row->user_id == Auth::user()->id)
                          @can('update.sumber_anggaran')
                            <form action="{{ route('budgeting.edit', Crypt::encryptString($row->id)) }}" method="post" class="d-inline mx-1">
                            @csrf
                            @method('GET')
                                <button type="submit" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Update Sumber Anggaran">Edit</button>
                            </form>
                          @endcan

                          <form action="{{ route('budgeting.del', Crypt::encryptString($row->id)) }}" method="post" class="d-inline mx-1">
                          @csrf
                          @method('DELETE')                      
                          <x-modal name="delinv" target="modal-del-{{$row->id}}" title="Confirmation" message="Apakah anda yakin ingin menghapus {{$row->name}}" divid="{{$row->name}}" tombol="Delete" jenis="danger" />
                          </form>
                          @can('delete.sumber_anggaran')
                          <button type="button" id="del-{{$row->id}}" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-del-{{$row->id}}">
                            Delete
                          </button>
                          @endcan
                        @endif
                      @endhasanyrole           
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                @else
                <tr>
                  <td colspan="6" class="text-center text-danger">Tidak Memiliki Akses Read Pendanaan </td>
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