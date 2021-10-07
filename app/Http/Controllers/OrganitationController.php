<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organitation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrganitationController extends Controller
{
    public function index()
    {
        //$org_id=Auth::user()->organitation_id;
        $data['org']=Organitation::all();
        return view('pages.organitation.index',$data);

    }
}
