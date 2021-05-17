<?php

namespace App\Http\Livewire;

use App\Services\FatturaService;
use Livewire\Component;
use function dd;

class Modalddt extends Component
{
    public $visibile = true;
    public $listaDdt = [];

    protected $listeners = [
        'listaDdt'
    ];

    public function closeModal()
    {
        $this->visibile = true;
    }

    public function listaDdt($id, FatturaService $fatturaService)
    {
        $this->visibile = false;
        $this->listaDdt = $fatturaService->listaDdtFromClient($id);
    }

    public function render()
    {
        return view('livewire.modalClient.modalddt');
    }
}
