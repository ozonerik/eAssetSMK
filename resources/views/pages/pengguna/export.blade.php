@php
    $no = 1;
@endphp
<table>
<thead>
    <tr>
        <td colspan="6">Tabel User List</td>
    </tr>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Organisasi</th>
        <th>Roles</th>
        <th>Permissions</th>
    </tr>
</thead>
<tbody>
@foreach($users as $r)
    <tr style="border-width:1px;border-style:solid;">
        <th>{{ $no++ }}</th>
        <td>{{$r->name}}</td>
        <td>{{$r->email}}</td>
        <td>{{Str::upper($r->organitation()->get()->pluck('shortname')->implode(', '))}}</td>
        <td>{{Str::title($r->roles->pluck('name')->implode(', '))}} </td>
        <td>{{Str::title($r->permissions->pluck('name')->implode(', '))}} </td>
    </tr>
@endforeach
</tbody>
</table>