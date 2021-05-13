<?php

namespace App\Http\Livewire;

use App\Services\FilialeService;
use App\Services\FornitoreService;
use App\Services\ProductService;
use Livewire\Component;
use function config;
use function dd;
use function session;
use function view;

class MagazzinoFiliale extends Component
{
    public $magazzinoFilialeVisibile;
    public $ricerca;
    public $idFiliale;
    public $idListino;
    public $idFornitore;
    public $quantita;
    public $prodottiRichiesti;
    public $prodottiInArrivo;
    public $prodottiInFiliale;
    public $prodottiInProva;
    public $invisibile = false;

    protected $listeners = ['produciDdt'];

    public function mount($idFiliale, ProductService $productService)
    {
        $this->idFiliale = $idFiliale;
        $this->aggiornaMagazzino($productService);
    }

    public function produciDdt(ProductService $productService)
    {
        $this->aggiornaMagazzino($productService);
    }

    public function aggiornaMagazzino(ProductService $productService)
    {
        $this->prodottiRichiesti = $productService->prodottiRichiesti($this->idFiliale, $this->ricerca);
        $this->prodottiInFiliale = $productService->prodottiInFiliale($this->idFiliale, $this->ricerca);
        $this->prodottiInArrivo = $productService->prodottiInArrivo($this->idFiliale, $this->ricerca);
        $this->prodottiInProva = $productService->prodottiInProva($this->idFiliale, $this->ricerca);
    }

    public function richiedi(ProductService $productService)
    {
        $reques = [
            'stato' => config('enum.statoAPA.richiesto'),
            'quantita' => $this->quantita,
            'filiale_id' => $this->idFiliale,
            'listino_id' => $this->idListino,
            'fornitore_id' => $this->idFornitore,
        ];

        if(!$productService->richiedi($reques)){
            session()->flash('message', 'Errore di inserimento');
        } else {
            session()->flash('message', 'Prodotto richiesto');
        }
        $this->idListino = '';
        $this->idFornitore = '';
        $this->quantita = '';
        $this->emitTo('home', 'richiediApparecchi');
    }

    public function remove($id, ProductService $productService)
    {
        if(!$productService->rimuovi($id)){
            session()->flash('message', 'Errore di cancellazione');
        } else {
            session()->flash('message', 'Elemento eliminato');
        }
    }

    public function arrivato($id, ProductService $productService)
    {
        if(!$productService->arrivato($id)){
            session()->flash('message', 'Errore di modifica');
        } else {
            session()->flash('message', 'Elemento caricato in magazzino');
        }
    }

    public function nonArrivato($id, ProductService $productService)
    {

    }

    public function render(FornitoreService $fornitoreService, FilialeService $filialeService)
    {
        return view('livewire.magazzino-filiale', [
            'prodottiRichiesti' => $this->prodottiRichiesti,
            'prodottiInFiliale' => $this->prodottiInFiliale,
            'prodottiInArrivo' => $this->prodottiInArrivo,
            'prodottiInProva' => $this->prodottiInProva,
            'fornitori' => $fornitoreService->fornitori(),
            'listino' => $this->idFornitore ? $fornitoreService->listinoFromFornitore($this->idFornitore) : [],
            'magazzino' => $filialeService->nomeFiliale($this->idFiliale)
        ])->extends('inizio');
    }
}
