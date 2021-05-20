<?php

namespace App\Http\Livewire;

use App\Services\TipologiaService;
use Livewire\Component;
use function view;

class TempiRecall extends Component
{
    public $giorni;
    public $tipoId;
    public $nuovoTipo;
    public $nuoviGiorni;

    public function associa(TipologiaService $tipologiaService)
    {
        $tipologiaService->associaTempi($this->tipoId, $this->giorni);
    }

    public function crea(TipologiaService $tipologiaService)
    {
        $tipologiaService->crea($this->nuovoTipo, $this->nuoviGiorni);
    }

    public function remove($id, TipologiaService $tipologiaService)
    {
        $tipologiaService->rimuovi($id);
    }

    public function render(TipologiaService $tipologiaService)
    {
        return view('livewire.gestione.tempi-recall', [
            'tipologie' => $tipologiaService->tipologie()
        ])->extends('inizio')->section('content');
    }
}
