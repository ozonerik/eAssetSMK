<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Budgeting;
use App\Models\Fiscalyear;
use App\Models\Itemtype;
use App\Models\Storage;

class InventoryController extends Controller
{
    public function index()
    {
        $org_id=Auth::user()->organitation_id;
        $user = User::with(['roles','permissions'])->where('id', Auth::user()->id)->first();
        if($user->hasRole(['admin'])){
            $data['inventory'] = Inventory::all();
        }else{
            $data['inventory'] = Inventory::where('organitation_id', $org_id)->get();
        }
        
        return view('pages.inventory.index',$data);

    }

    public function create()
    {
        $org_id=Auth::user()->organitation_id;
        $user = User::with(['roles','permissions'])->where('id', Auth::user()->id)->first();
        
        if($user->hasRole(['admin'])){
            $data['budgeting']= Budgeting::all();
            $data['fiscal']= Fiscalyear::all();
            $data['itemtype']= Itemtype::all();
            $data['storages']= Storage::all();
        }else{
            $data['budgeting']= Budgeting::where('organitation_id', $org_id)->get();
            $data['fiscal']= Fiscalyear::where('organitation_id', $org_id)->get();
            $data['itemtype']= Itemtype::where('organitation_id', $org_id)->get();
            $data['storages']= Storage::where('organitation_id', $org_id)->get();
        }
        
        return view('pages.inventory.create',$data);
    }

}
