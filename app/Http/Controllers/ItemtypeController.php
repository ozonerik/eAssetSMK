<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Itemtype;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class ItemtypeController extends Controller
{
    public function index()
    {
        $org_id=Auth::user()->organitation_id;
        $user = User::with(['roles','permissions'])->where('id', Auth::user()->id)->first();
        if($user->hasRole(['admin'])){
            $data['itemtype'] = Itemtype::all();
        }else{
            $data['itemtype'] = Itemtype::where('organitation_id', $org_id)->get();
        }
        
        return view('pages.itemtype.index',$data);

    }
}
