<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use Illuminate\Support\Facades\Auth;

class CheckController extends Controller
{
    public function index($code)
    {
        $inv =Inventory::where('qrcode', $code)->first();
        return view('pages.check',['inv'=>$inv]);
    }
    public function edit($code)
    {
        return redirect()->route('inventory.edit',$code);
    }
}
