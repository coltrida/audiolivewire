<?php

namespace App\Http\Livewire;

use App\Models\Client;
use App\Services\ClientService;
use App\Services\MarketingService;
use App\Services\RecapitoService;
use App\Services\TipologiaService;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use function redirect;
use function session;

class ClientInserisci extends Component
{
    public $idClient;
    public $idFiliale;
    public $recapiti = [];
    public $tipi = [];
    public $canali = [];
    public Client $client;

    protected $rules = [
        'client.nome' => 'required|string',
        'client.cognome' => 'required|string',
        'client.telefono' => 'numeric',
        'client.indirizzo' => 'required',
        'client.citta' => 'required',
        'client.provincia' => 'required',
        'client.cap' => 'required',
        'client.tipo' => 'required',
        'client.marketing_id' => 'required',
        'client.mail' => 'mail',
        'client.datarecall' => 'string',
        'client.datanascita' => 'string',
        'client.recapito_id' => 'numeric',
        'client.user_id' => 'numeric',
        'client.filiale_id' => 'numeric',
    ];

    public function mount(ClientService $clientService,
                          UserService $userService,
                          RecapitoService $recapitoService,
                          TipologiaService $tipologiaService,
                          MarketingService $marketingService,
                          $idFiliale='',
                          $idClient='')
    {
        $this->idClient = $idClient;
        $this->idFiliale = $idFiliale;
        $this->recapiti = $recapitoService->recapiti();
        $this->tipi = $tipologiaService->tipologie();
        $this->canali = $marketingService->canali();
        $this->client = $idClient ? $clientService->getClient($idClient) : new Client();
        $this->client->filiale_id = $idClient ? $this->client->filiale_id : $this->idFiliale;
    }

    public function aggiungi(ClientService $clientService)
    {
        $this->validate();

        if (!$clientService->inserisci($this->client)) {
            session()->flash('message', 'Errore di inserimento');
            return redirect()->route('client.index', ['idAudio' => Auth::id(), 'idFiliale' => $this->client->filiale_id]);
        }
        session()->flash('message', 'Cliente inserito');
        return redirect()->route('client.index', ['idAudio' => Auth::id(), 'idFiliale' => $this->client->filiale_id]);
    }

    public function modifica(ClientService $clientService)
    {
        $this->validate();

        if (!$clientService->modifica($this->client)) {
            session()->flash('message', 'Errore di inserimento');
            return redirect()->route('client.index', ['idAudio' => Auth::id(), 'idFiliale' => $this->client->filiale_id]);
        }
        session()->flash('message', 'Cliente modificato');
        return redirect()->route('client.index', ['idAudio' => Auth::id(), 'idFiliale' => $this->client->filiale_id]);
    }


    public function render()
    {
        return view('livewire.client.client-inserisci')->extends('inizio')->section('content');
    }
}
