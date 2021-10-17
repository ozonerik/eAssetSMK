<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class StorageController extends Controller
{
    public function index()
    {
        $org_id=Auth::user()->organitation_id;
        $user = User::with(['roles','permissions'])->where('id', Auth::user()->id)->first();
        if($user->hasRole(['admin'])){
            $data['storages'] = Storage::all();
        }else{
            $data['storages'] = Storage::where('organitation_id', $org_id)->get();
        }
        
        return view('pages.storages.index',$data);

    }
}
