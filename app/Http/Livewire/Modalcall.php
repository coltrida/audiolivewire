<?php

namespace App\Http\Livewire;

use App\Models\Client;
use App\Services\ClientService;
use Livewire\Component;
use function dd;
use function redirect;
use function session;

class Modalcall extends Component
{
    public $visibile = true;
    public $clientName;
    public $clientCognome;
    public $clientId;
    public $clientCall;

    protected $listeners = [
        'clientSelectedRecall',
    ];

    public function clientSelectedRecall($id)
    {
        $this->visibile = false;
        $client = Client::find($id);
        $this->clientName = $client->nome;
        $this->clientCognome = $client->cognome;
        $this->clientCall = $client->datarecall ? $client->datarecall : null;
        $this->clientId = $id;
    }

    public function inserisci(ClientService $clientService)
    {
        if (!$clientService->recall($this->clientId, $this->clientCall)) {
            session()->flash('message', 'Errore inserimento');
        }
        session()->flash('message', 'Recall inserimento');
        $this->closeModal();
    }

    public function closeModal()
    {
        $this->clientId = '';
        $this->clientName = '';
        $this->visibile = true;
    }

    public function render()
    {
        return view('livewire.modalClient.modalcall');
    }
}
