<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budgeting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class BudgetingController extends Controller
{
    public function index()
    {
        $org_id=Auth::user()->organitation_id;
        $user = User::with(['roles','permissions'])->where('id', Auth::user()->id)->first();
        if($user->hasRole(['admin'])){
            $data['budget'] = Budgeting::orderBy('organitation_id', 'asc')->get();
        }else{
            $data['budget'] = Budgeting::where('organitation_id', $org_id)->get();
        }
        
        return view('pages.budgeting.index',$data);

    }
}
