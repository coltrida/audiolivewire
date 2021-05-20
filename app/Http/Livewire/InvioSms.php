<?php

namespace App\Http\Livewire;

use Livewire\Component;

class InvioSms extends Component
{
    public function render()
    {
        return view('livewire.gestione.invio-sms')->extends('inizio')->section('content');
    }
}
