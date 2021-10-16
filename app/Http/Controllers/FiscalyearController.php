<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fiscalyear;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class FiscalyearController extends Controller
{
    public function index()
    {
        $org_id=Auth::user()->organitation_id;
        $user = User::with(['roles','permissions'])->where('id', Auth::user()->id)->first();
        if($user->hasRole(['admin'])){
            $data['fiscal'] = Fiscalyear::all();
        }else{
            $data['fiscal'] = Fiscalyear::where('organitation_id', $org_id)->get();
        }
        
        return view('pages.fiscal.index',$data);

    }
}
