<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class OrganitationController extends Controller
{
    public function index()
    {
        $org_id=Auth::user()->organitation_id;
        $user = User::where('organitation_id', $org_id)->get();
        foreach($user as $u){
            print $u->name." dan ".$u->organitation->name."<br>";
        }

    }
}
