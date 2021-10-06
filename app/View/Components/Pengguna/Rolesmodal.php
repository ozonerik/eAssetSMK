<?php

namespace App\View\Components\Pengguna;

use Illuminate\View\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Rolesmodal extends Component
{
    public $name,$target,$title,$message,$tombol,$jenis,$roles,$permissions;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name,$target,$title,$message,$tombol,$jenis)
    {
        //
        $this->name=$name;
        $this->target=$target;
        $this->title=$title;
        $this->message=$message;
        $this->tombol=$tombol;
        $this->roles=Role::all();
        $this->permissions=Permission::all();
        if($jenis=='danger'){
            $this->jenis='btn btn-danger';
        }elseif($jenis=='success'){
            $this->jenis='btn btn-success';
        }elseif($jenis=='warning'){
            $this->jenis='btn btn-warning';
        }elseif($jenis=='primary'){
            $this->jenis='btn btn-primary';
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.pengguna.rolesmodal');
    }
}
