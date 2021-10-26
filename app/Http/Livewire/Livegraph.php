<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Inventory;
use App\Models\User;
use App\Models\Organitation;
use App\Models\Budgeting;
use App\Models\Fiscalyear;
use App\Models\Itemtype;
use App\Models\Storeroom;
use Illuminate\Support\Facades\Auth;

class Livegraph extends Component
{
    public $inventory,$budget,$fiscal,$itemtype,$storeroom;

    public function mount()
    {
        $org_id=Auth::user()->organitation_id;
        $this->budget = Budgeting::where('organitation_id', $org_id)->orderBy('code', 'asc')->get();
        $this->fiscal = Fiscalyear::where('organitation_id', $org_id)->orderBy('code', 'asc')->get();
        $this->itemtype = Itemtype::where('organitation_id', $org_id)->orderBy('code', 'asc')->get();
    }

    public function render()
    {
        return view('livewire.livegraph');
    }
}
