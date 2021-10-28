<div>
    <!-- graph data -->
    <div class="form-group row">
        <div class="col-sm-12">
            <input id="data2" type="hidden" class="form-control" value="{{$inventory->implode('datagraph',',')}}"/>
        </div>
    </div>
    <!-- sumber anggaran -->
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Sumber Anggaran</label>
        <div class="col-sm-9">
            <select wire:model="selectBudget" class="form-control" >
                <option value="" selected="selected" >&nbsp;</option>
                @foreach($budget as $row)
                <option value="{{$row->id}}">[ {{Str::upper($row->organitation->shortname)}} ] [ {{Str::upper($row->code)}} ] {{$row->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <!-- tahun anggaran -->
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Tahun Anggaran</label>
        <div class="col-sm-9">
            <select wire:model="selectFiscal" class="form-control" >
                <option value="" selected="selected" >&nbsp;</option>
                @foreach($fiscalyear as $row)
                <option value="{{$row->id}}">[ {{Str::upper($row->organitation->shortname)}} ] [ {{Str::upper($row->code)}} ] {{$row->year}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <!-- jenis barang -->
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Jenis Barang</label>
        <div class="col-sm-9">
            <select wire:model="selectItemtype" class="form-control">
                <option value="" selected="selected" >&nbsp;</option>
                @foreach($itemtype as $row)
                <option value="{{$row->id}}">[ {{Str::upper($row->organitation->shortname)}} ] [ {{Str::upper($row->code)}} ] {{$row->typename}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <!-- tempat penyimpanan -->
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Tempat Penyimpanan</label>
        <div class="col-sm-9">
            <select wire:model="selectStoreroom" class="form-control">
                <option value="" selected="selected" >&nbsp;</option>
                @foreach($storeroom as $row)
                <option value="{{$row->id}}">[ {{Str::upper($row->organitation->shortname)}} ] [ {{Str::upper($row->shortname)}} ]  {{$row->roomname}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <!-- button -->
    <div class="form-group row">
        <div class="col-sm-12 text-right">
            <button type="button" id="btnGraph" class="btn btn-primary">Tampilkan Grafik</button>
        </div>
    </div>

</div>
