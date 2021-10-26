<div>
<label>Sumber Dana</label>                
<select class="select2bs4 form-control" name="budget" data-placeholder="Pilih Jenis Barang" style="width: 100%;">
    <option value="" selected="selected" >&nbsp;</option>
    @foreach($budget as $row)
    <option value="{{$row->id}}">{{$row->name}}</option>
    @endforeach
</select>
</div>
