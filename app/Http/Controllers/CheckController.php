<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use Illuminate\Support\Facades\Auth;

class CheckController extends Controller
{
    public function index($code)
    {
        //dd($code);
        $inv =Inventory::where('qrcode', $code)->first();
        //$inv=$code;
        return view('pages.check',['inv'=>$inv]);
    }
}
