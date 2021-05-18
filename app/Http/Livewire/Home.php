<?php

namespace App\Http\Livewire;

use App\Models\Filiale;
use App\Models\User;
use App\Services\ClientService;
use App\Services\DdtService;
use App\Services\FilialeService;
use App\Services\ProductService;
use App\Services\ProvaService;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use function array_push;
use function array_splice;
use function dd;
use function session;
use function view;

class Home extends Component
{
    public $ddt = [];
    public $matricola = [];
    public $filialeSelezionata = '';
    public $prodottiRichiesti = [];
    public $proveInCorso = [];
    public $finalizzati = [];

    protected $listeners = [
        'produciDdt', 'produciFattura'
    ];

    public function mount(ProductService $productService, UserService $userService)
    {
        if(isset(Auth::user()->name)){
            $this->prodottiRichiesti = $productService->prodottiRichiestiTutteFiliali();

            $this->proveInCorso = $userService->proveInCorso();
            $this->finalizzati = $userService->finalizzatiDelMese();
        }
    }

    public function produciFattura(UserService $userService)
    {
        $this->proveInCorso = $userService->proveInCorso();
        $this->finalizzati = $userService->finalizzatiDelMese();
    }

    /*    public function updated($prodottiRichiesti, $value)
        {
            dd($prodottiRichiesti.' - '.$value);
        }*/

    public function aggiungiAlDdt($product, $idFiliale, DdtService $ddtService, ProductService $productService)
    {
        $product['matricolaAssociata'] = $this->matricola[$product['id']];
        array_push($this->ddt, $product);
        $ddtService->inserimentoTemporaneoProdotto($product['id']);
        $this->filialeSelezionata = $idFiliale;
        $this->prodottiRichiesti = $productService->prodottiRichiestiTutteFiliali();
        // dd($this->aperto[$idFiliale]);
    }

    public function removeFromDdt($id, DdtService $ddtService)
    {
        array_splice($this->ddt, $id, 1);
        $ddtService->eliminazioneTemporaneaProdotto($id);
    }

    public function produciDdt(DdtService $ddtService, ProductService $productService)
    {
        if(!$ddtService->produciDdt($this->ddt)){
            session()->flash('message', 'Errore di produzione DDT');
        } else {
            session()->flash('message', 'DDT prodotto');
        }
        $this->ddt = [];
        $this->prodottiRichiesti = $productService->prodottiRichiestiTutteFiliali();
    }

    /*public function clientFattura($id, ProvaService $provaService)
    {
        $provaService->fattura($id);
    }*/

    public function reso($id, ProvaService $provaService, UserService $userService)
    {
        $provaService->rimuovi($id);
        $this->proveInCorso = $userService->proveInCorso();
    }

    public function render(UserService $userService,
                           ClientService $clientService,
                           FilialeService $filialeService)
    {
        $parametri = [];
        $nomeVista = 'livewire.home.home-admin';
        $parametri = [
            'audioprotesisti' => [],
            'filiali' => [],
            'amministrativi' => [],
            'proveInCorso' => [],
            'finalizzati' => [],
            'FilialiprodottiRichiesti' => [],
            'recallsOggi' => [],
            'recallsDomani' => []
        ];
        if (isset($userService->getUser()->name)){
            if ($userService->isAdmin()){
                $nomeVista = 'livewire.home.home-admin';
                $parametri = [
                    'audioprotesisti' => $userService->getAudioprotesisti(),
                    'filiali' => $filialeService->filiali(),
                    'amministrativi' => $userService->getAmministrazione(),
                ];
            } elseif ($userService->isAudio()){
                $nomeVista = 'livewire.home.home-audio';
                $parametri = [
                    'budget' => $userService->getBudgetDelMese(Auth::id()),

                    'appuntamentiOggi' => $userService->appuntamentiOggi(),
                    'appuntamentiDomani' => $userService->appuntamentiDomani(),
                    'compleanniOggi' => $clientService->compleanniOggi(),
                ];
            } elseif ($userService->isAmministrazione()){
                $nomeVista = 'livewire.home.home-amministrazione';
                $parametri = [
                    'FilialiprodottiRichiesti' => $this->prodottiRichiesti,
                    'recallsOggi' => $clientService->getRecallsOggi(),
                    'recallsDomani' => $clientService->getRecallsDomani(),
                    'aperto' => $filialeService->caricaId($this->filialeSelezionata)
                ];
            }
        }

        return view($nomeVista, $parametri)->extends('inizio')->section('content');
    }
}

