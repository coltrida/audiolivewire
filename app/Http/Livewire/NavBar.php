<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use function dd;

class NavBar extends Component
{
    protected $listeners = ['isLogged'];

    public $isLogged;

    public function isLogged()
    {
        $this->isLogged = Auth::user() ? true : false;
    }

    public function render()
    {
        return view('livewire.nav-bar');
    }
}
