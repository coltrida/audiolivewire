<?php

namespace App\Http\Livewire;

use App\Services\TipologiaService;
use Livewire\Component;
use Nexmo\Laravel\Facade\Nexmo;
use function dd;

class InvioSms extends Component
{
    public $tipo;
    public $filiale;
    public $messaggio;

    public function invia()
    {
        Nexmo::message()->send([
            'to' => '+393923126074',
            'from' => '+393920222125',
            'text' => $this->messaggio
        ]);

    }

    public function render(TipologiaService $tipologiaService)
    {
        return view('livewire.gestione.invio-sms', [
            'tipologia' => $tipologiaService->tipologie()
        ])->extends('inizio')->section('content');
    }
}
