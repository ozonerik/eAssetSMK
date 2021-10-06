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
<!-- DataTables  & Plugins -->
<script src="{{url('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{url('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{url('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{url('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{url('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{url('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{url('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{url('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{url('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{url('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
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
    $('#users-table').DataTable({
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
        { "orderable": false, "targets": [0,5,6] },
        { "searchable": false, "targets": [6] }
      ]
    });
  });
</script>
<!-- checbox multi -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#master').on('click', function(e) {
         if($(this).is(':checked',true))  
         {
            $(".sub_chk").prop('checked', true);  
         } else {  
            $(".sub_chk").prop('checked',false);  
         }  
        });

    });
</script>
<script>
  $(document).ready(function() {
      $("#file-upload").change(function(){
        $("#file-name").text(this.files[0].name);
      });
  });
</script>
<script>
    $(document).ready(function() {
        $("#delselbtn").click(function(){
            var ids = [];
            var names = [];
            $.each($("input[name='userids']:checked"), function(){
                ids.push($(this).val());
                names.push($(this).data('name'));
            });
            var x = ids.join(",");
            var y = names.join(", ");
            document.getElementById("checkids").value = x;
            document.getElementById("namesid").innerHTML = y;
        });
    });
</script>
<script>
    $(document).ready(function() {
        $("#rolebtn").click(function(){
            var ids = [];
            var names = [];
            $.each($("input[name='userids']:checked"), function(){
                ids.push($(this).val());
                names.push($(this).data('name'));
            });
            var x = ids.join(",");
            var y = names.join(", ");
            document.getElementById("checkidsrole").value = x;
            document.getElementById("namesidrole").innerHTML = y;
        });
    });
</script>
@endpush
@section('judul_hal','Pengguna')
@section('header_hal')
<li class="breadcrumb-item"><a href="#">Konfigurasi</a></li>
<li class="breadcrumb-item active">Pengguna</li>
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
                  Pengguna
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
              <form action="{{ route('pengguna.delsel') }}" method="post" class="d-inline mx-1">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" id="checkids" name="userids">
                    <x-modal name="delsel" target="modal-delsel" title="Confirmation" 
                    message="Apakah anda yakin ingin menghapus data berikut ini ? 
                    <div id='namesid'class='font-weight-bold'></div>
                    " tombol="Delete" jenis="danger" />
              </form>
              <form action="{{route('pengguna.roleSel')}}" method="post" class="d-inline mx-1">
                    @csrf
                    <input type="hidden" id="checkidsrole" name="userids">
                    <x-pengguna.rolesmodal name="userroles" target="modal-userroles" title="Add/Edit User Roles & Permissions" 
                    message="Berikan Role & Permission untuk :
                    <div id='namesidrole'class='font-weight-bold'></div>
                    " tombol="Save" jenis="primary" />
              </form>
              <form action="{{ route('pengguna.import') }}" method="post" enctype="multipart/form-data" class="d-inline mx-1">
                    @csrf
                    <x-modal name="user_import" target="modal-userimport" title="User Import" 
                    message="
                    <a href='{{url('/storage/uploads/upload_users.xlsx')}}' >Download Contoh File User Import</a>
                    <div class='custom-file'>
                      <input id='file-upload' type='file' name='user_file' class='custom-file-input' id='user_import'>
                      <label id='file-name' class='custom-file-label' for='user_import'>Choose file</label>
                    </div>
                    " 
                    tombol="Upload" jenis="primary" />
              </form>
              <div class="card-body">
                <div class="divider bg-dark rounded mb-4">
                  @can('create.pengguna')
                  <a class="btn btn-success my-2 ml-2" href="{{route('pengguna.create')}}" role="button" data-toggle="tooltip" data-placement="top" title="Export Users to Excel">
                  Add User
                  </a> 
                  @endcan 
                  <a class="btn btn-success my-2 ml-2" href="{{route('pengguna.export')}}" role="button" data-toggle="tooltip" data-placement="top" title="Export Users to Excel">
                  Export
                  </a>
                  @can('create.pengguna')
                  <button type="button" id="user_import" class="btn btn-warning my-2 ml-2" data-toggle="modal" data-target="#modal-userimport" data-toggle="tooltip" data-placement="top" title="Import Users from Excel">
                    Import
                  </button>
                  @endcan
                  @can('update.pengguna')
                  <button type="button" id="rolebtn" class="btn btn-primary my-2 ml-2" data-toggle="modal" data-target="#modal-userroles" data-toggle="tooltip" data-placement="top" title="Add/Edit User Roles & Permissions">
                    Roles & Permissions
                  </button>
                  @endcan
                  @can('delete.pengguna')
                  <button type="button" id="delselbtn" class="btn btn-danger my-2 ml-2" data-toggle="modal" data-target="#modal-delsel" data-toggle="tooltip" data-placement="top" title="Delete Users Selection">
                    Delete Selection
                  </button>
                  @endcan
                </div>
                @php
                    $no = 1;
                @endphp
                <table id="users-table" class="table table-hover">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col"><input type="checkbox" id="master"></th>
                      <th scope="col">No</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Email</th>
                      <th scope="col">Roles</th>
                      <th scope="col">Permissions</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                @can('read.pengguna')
                  <tbody>
                  @foreach($users as $r)
                    <tr> 
                      <td><input type="checkbox" class="sub_chk" name="userids" value="{{Crypt::encryptString($r->id)}}" data-name="{{$r->name}}"></td>
                      <th scope="row">{{ $no++ }}</th>
                      <td>{{$r->name}}</td>
                      <td>{{$r->email}}</td>
                      <td>
                        {{$r->roles->pluck('name')->implode(', ')}} 
                      </td>
                      <td>
                        {{$r->permissions->pluck('name')->implode(', ')}} 
                      </td>
                      <td>
                        @can('update.pengguna')
                        <form action="{{ route('pengguna.edit', Crypt::encryptString($r->id)) }}" method="post" class="d-inline mx-1">
                          @csrf
                          @method('GET')
                              <button type="submit" class="btn btn-primary btn-sm">Edit</button>
                        </form>
                        @endcan
                        <form action="{{ route('pengguna.del', Crypt::encryptString($r->id)) }}" method="post" class="d-inline mx-1">
                          @csrf
                          @method('DELETE')                      
                          <x-modal name="deluser" target="modal-del-{{$r->id}}" title="Confirmation" message="Apakah anda yakin ingin menghapus {{$r->name}}" divid="{{$r->name}}" tombol="Delete" jenis="danger" />
                        </form>
                        
                        @can('delete.pengguna')
                        <button type="button" id="del-{{$r->id}}" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-del-{{$r->id}}">
                          Delete
                        </button>
                        @endcan
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                @else
                <tr>
                  <td colspan="7" class="text-center text-danger">Tidak Memiliki Akses Read Pengguna </td>
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