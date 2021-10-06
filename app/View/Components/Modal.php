<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Modal extends Component
{
    public $name,$target,$title,$message,$tombol,$jenis;

    
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
        return view('components.modal');
    }
}
