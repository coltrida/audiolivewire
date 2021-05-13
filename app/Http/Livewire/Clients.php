<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Clients extends Component
{
    public $idAudio;
    public $idFiliale;

    public function mount($idAudio = '', $idFiliale = '')
    {
        $this->idAudio = $idAudio;
        $this->idFiliale = $idFiliale;
    }

    public function render()
    {
        return view('livewire.clients')->extends('inizio')->section('content');
    }
}
