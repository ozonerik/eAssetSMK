<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Organitation;
use App\Models\Budgeting;
use App\Models\Fiscalyear;
use App\Models\Itemtype;
use App\Models\Storage;
use Illuminate\Support\Arr;

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
            $data['budgeting']= Budgeting::all()->sortBy(
                    [
                        ['organitation_id', 'asc'],
                        ['code', 'asc'],
                    ]
                );
            $data['fiscal']= Fiscalyear::all()->sortBy(
                [
                    ['organitation_id', 'asc'],
                    ['code', 'asc'],
                ]
            );
            $data['itemtype']= Itemtype::all()->sortBy(
                [
                    ['organitation_id', 'asc'],
                    ['code', 'asc'],
                ]
            );
            $data['storages']= Storage::all()->sortBy(
                [
                    ['organitation_id', 'asc'],
                    ['shortname', 'asc'],
                ]
            );
        }else{
            $data['budgeting']= Budgeting::where('organitation_id', $org_id)->get()->sortBy(
                [
                    ['organitation_id', 'asc'],
                    ['code', 'asc'],
                ]
            );
            $data['fiscal']= Fiscalyear::where('organitation_id', $org_id)->get()->sortBy(
                [
                    ['organitation_id', 'asc'],
                    ['code', 'asc'],
                ]
            );
            $data['itemtype']= Itemtype::where('organitation_id', $org_id)->get()->sortBy(
                [
                    ['organitation_id', 'asc'],
                    ['code', 'asc'],
                ]
            );
            $data['storages']= Storage::where('organitation_id', $org_id)->get()->sortBy(
                [
                    ['organitation_id', 'asc'],
                    ['shortname', 'asc'],
                ]
            );
        }
        
        return view('pages.inventory.create',$data);
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $code_org= Organitation::where('id',Auth::user()->organitation_id)->get()->pluck('code')->implode('');
        $code_budget= Budgeting::where('id',$request->input('budgeting'))->get()->pluck('code')->implode('');
        $code_fiscal= Fiscalyear::where('id',$request->input('fiscal'))->get()->pluck('code')->implode('');
        $code_itemtype= Itemtype::where('id',$request->input('itemtype'))->get()->pluck('code')->implode('');
        $user_id= Auth::user()->id;
        $code_inv=$code_org.'.'.$code_budget.'.'.$code_fiscal.'.'.$code_itemtype.'.';

        dd($code_inv);
    }

}
