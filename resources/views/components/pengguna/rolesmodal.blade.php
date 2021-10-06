<div class='modal fade' data-name={{$name}} id={{$target}}>
    <div class='modal-dialog'>
      <div class='modal-content'>
        <div class='modal-header'>
          <h4 class='modal-title'>{{$title}}</h4>
          <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        <div class='modal-body'>
                {!! $message !!}
                <div class="form-group row">
                    <label for="roles" class="col-12 col-form-label">Roles</label>
                    <div class="col-12 select2-blue">
                      <select class="select2 form-control" name="roles[]" multiple="multiple" data-placeholder="Select a Role" data-dropdown-css-class="select2-blue" style="width: 100%;">
                      @foreach($roles as $r)
                        <option value="{{$r->name}}">{{$r->name}}</option>
                      @endforeach
                      </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="permission" class="col-12 col-form-label">Permission</label>
                    <div class="col-12 select2-blue">
                      <select class="select2 form-control" name="permissions[]" multiple="multiple" data-placeholder="Select a Role" data-dropdown-css-class="select2-blue" style="width: 100%;">
                      @foreach($permissions as $p)
                      <option value="{{$p->name}}">{{$p->name}}</option>
                      @endforeach
                      </select>
                    </div>
                </div>
        </div>
        <div class='modal-footer justify-content-between'>
          <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
          <button type='submit' class='{{$jenis}}'>{{$tombol}}</button>
        </div>
      </div>
    </div>
</div>