<?php

namespace App\Http\Livewire;

use App\Services\FilialeService;
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

    public function render(FilialeService $filialeService)
    {
        return view('livewire.nav-bar', [
            'filiali' => $filialeService->soloFiliali(),
            'filialiAudio' => $this->isLogged ? $filialeService->filialiAudio() : [],
        ]);
    }
}
