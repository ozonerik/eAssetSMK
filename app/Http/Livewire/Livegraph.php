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
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Livegraph extends Component
{
    public $budget,$selectBudget;
    public $fiscalyear,$selectFiscal;
    public $itemtype,$selectItemtype;
    public $storeroom,$selectStoreroom;
    public $inventory;


    public function mount()
    {
        $org_id=Auth::user()->organitation_id;
        $user = User::with(['roles','permissions'])->where('id', Auth::user()->id)->first();

        if($user->hasRole(['admin'])){
            $this->budget = Budgeting::orderBy('organitation_id', 'asc')->orderBy('code', 'asc')->get();
            $this->fiscalyear = Fiscalyear::orderBy('organitation_id', 'asc')->orderBy('code', 'asc')->get();
            $this->itemtype = Itemtype::orderBy('organitation_id', 'asc')->orderBy('code', 'asc')->get();
            $this->storeroom = Storeroom::orderBy('organitation_id', 'asc')->orderBy('shortname', 'asc')->get();
        }else{
            $this->budget = Budgeting::where('organitation_id', $org_id)->orderBy('code', 'asc')->get();
            $this->fiscalyear = Fiscalyear::where('organitation_id', $org_id)->orderBy('code', 'asc')->get();
            $this->itemtype = Itemtype::where('organitation_id', $org_id)->orderBy('code', 'asc')->get();
            $this->storeroom = Storeroom::where('organitation_id', $org_id)->orderBy('shortname', 'asc')->get();
        }
        
    }

    public function invgraph()
    {
        $org_id=Auth::user()->organitation_id;
        $user = User::with(['roles','permissions'])->where('id', Auth::user()->id)->first();

        $selection = collect([
            'budgeting_id' => $this->selectBudget,
            'fiscalyear_id' => $this->selectFiscal,
            'itemtype_id' => $this->selectItemtype,
            'storeroom_id' => $this->selectStoreroom,
        ])->filter()->all();

        if($user->hasRole(['admin'])){
            $this->inventory = Inventory::selectRaw('concat(sum(good_qty),",",sum(med_qty),",",sum(bad_qty),",",sum(lost_qty)) as datagraph')
            ->where($selection)
            ->get();
        }else{
            $this->inventory = Inventory::selectRaw('concat(sum(good_qty),",",sum(med_qty),",",sum(bad_qty),",",sum(lost_qty)) as datagraph')
            ->where('organitation_id', $org_id)
            ->where($selection)
            ->get();
        }
        
    }

    public function render()
    {
        $this->invgraph();
        return view('livewire.livegraph');
    }

}
