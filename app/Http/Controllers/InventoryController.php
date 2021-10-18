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

    //fungsi membuat kode inventaris
    function code_inv($budgeting,$fiscal,$itemtype){
        //pembuatan code inventaris
        $user_id= Auth::user()->id;
        $org_id=Auth::user()->organitation_id;
        $code_org= Organitation::where('id',$org_id)->get()->pluck('code')->implode('');
        $code_budget= Budgeting::where('id',$budgeting)->get()->pluck('code')->implode('');
        $code_fiscal= Fiscalyear::where('id',$fiscal)->get()->pluck('code')->implode('');
        $code_itemtype= Itemtype::where('id',$itemtype)->get()->pluck('code')->implode('');
        $max_noinv= Inventory::where([
            ['organitation_id',$org_id],
            ['budgeting_id',$budgeting],
            ['fiscalyear_id',$fiscal],
            ['itemtype_id',$itemtype]
            ])->max('no');
        if(empty($max_noinv)){
            $no=1;
            $no_inv=sprintf('%05d', $no);
        }else{
            $no=$max_noinv+1;
            $no_inv=sprintf('%05d', $no);
        }
        $data['no']=$no;
        $data['code_inv']=$code_org.'.'.$code_budget.'.'.$code_fiscal.'.'.$code_itemtype.'.'.$no_inv;
        return $data;
        //end pembuatan code inventaris
    }

    public function store(Request $request)
    {
        $budget_id=$request->input('budgeting');
        $fiscal_id=$request->input('fiscal');
        $itemtype_id=$request->input('itemtype');
        $photo_inv = $request->file('picture');
        $code_inv=$this->code_inv($budget_id,$fiscal_id,$itemtype_id)['code_inv'];
        dd($photo_inv);
    }

}
