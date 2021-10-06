<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organitation;
use App\Models\User;

class OrganitationController extends Controller
{
    public function index()
    {
        $user = User::with('organitation')->where('organitation_id',1)->get();
        foreach($user as $u){
            print $u->name." dan ".$u->organitation->name."<br>";
        }

    }
}
