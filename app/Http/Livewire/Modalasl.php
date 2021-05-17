<?php

namespace App\Http\Livewire;

use App\Models\Client;
use App\Services\ClientService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use function dd;

class Modalasl extends Component
{
    use WithFileUploads;

    public $visibile = true;
    public $documento;
    public $idClient;
    public $client;
    public $documenti = [];

    protected $listeners = [
        'asl',
    ];

    public function mount(ClientService $clientService)
    {
        $this->client = $this->idClient ? $clientService->getClient($this->idClient) : new Client();
    }

    public function asl($id, ClientService $clientService)
    {
        $this->visibile = false;
        $this->idClient = $id;
        if ($this->idClient) {
            $this->client = $clientService->getClient($this->idClient);
            $this->documenti = Storage::files('/asl/'.$this->idClient);
        } else {
            $this->client = new Client();
        }
    }

    public function closeModal()
    {
        $this->idClient = '';
        $this->visibile = true;
    }

    public function caricaFile()
    {
        $this->validate([
            'documento' => 'max:1024',
        ]);
        $nome = Carbon::now()->format('Y-m-d-h-m-s');
        $this->documento->storePubliclyAs('asl/'.$this->idClient, $nome.'.'.$this->documento->extension());
        $this->documenti = Storage::files('/asl/'.$this->idClient);
    }

    public function render()
    {
        return view('livewire.modalClient.modalasl');
    }
}
