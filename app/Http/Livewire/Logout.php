<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use function redirect;

class Logout extends Component
{

    public function mount()
    {
        Auth::logout();
        return redirect()->to('/');
    }


    /*public function render()
    {
        return view('livewire.logout');
    }*/
}
