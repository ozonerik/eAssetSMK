<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budgeting;
use Illuminate\Support\Facades\Auth;

class BudgetingController extends Controller
{
    public function index()
    {
        $org_id=Auth::user()->organitation_id;
        $budget = Budgeting::where('organitation_id', $org_id)->get();
        foreach($budget as $b){
            print $b->name." dan ".$b->organitation->name."<br>";
        }

    }
}
