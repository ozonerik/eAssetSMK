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
        </div>
        <div class='modal-footer justify-content-between'>
          <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
          <button type='submit' class='{{$jenis}}'>{{$tombol}}</button>
        </div>
      </div>
    </div>
</div>