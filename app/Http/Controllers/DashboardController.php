<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\User;
use App\Models\Organitation;
use App\Models\Budgeting;
use App\Models\Fiscalyear;
use App\Models\Itemtype;
use App\Models\Storeroom;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DashboardController extends Controller
{
    public function index()
    {
        
        $org_id=Auth::user()->organitation_id;
        $user = User::with(['roles','permissions'])->where('id', Auth::user()->id)->first();

        if($user->hasRole(['admin'])){
            $data['inv'] = Inventory::selectRaw('sum(good_qty) as baik, sum(med_qty) as sedang ,sum(bad_qty) as rusak, sum(lost_qty) as hilang, sum(good_qty+med_qty+bad_qty+lost_qty) as total')
            ->get();
        }else{
            $data['inv'] = Inventory::selectRaw('sum(good_qty) as baik, sum(med_qty) as sedang ,sum(bad_qty) as rusak, sum(lost_qty) as hilang, sum(good_qty+med_qty+bad_qty+lost_qty) as total')
            ->where('organitation_id', $org_id)
            ->get();
        }

        return view('pages.dashboard.index',$data);
    }
}
