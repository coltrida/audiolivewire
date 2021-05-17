<?php


namespace App\Services;


use App\Models\Ddt;
use App\Models\Product;
use App\Models\Prova;
use function config;
use function dd;

class DdtService
{
    public function inserimentoTemporaneoProdotto($id)
    {
        $product = Product::find($id);
        $product->stato = config('enum.statoAPA.ddt');
        $product->save();
    }

    public function eliminazioneTemporaneaProdotto($id)
    {
        $product = Product::find($id);
        $product->stato = config('enum.statoAPA.richiesto');
        $product->save();
    }

    public function produciDdt($request)
    {
        //dd($request);
        $nuovoDdt = new Ddt();
        $nuovoDdt->nome_destinazione = 'CENTRO UDITO '.$request[0]['filiale']['nome'];
        $nuovoDdt->indirizzo_destinazione = $request[0]['filiale']['indirizzo'];
        $nuovoDdt->citta_destinazione = $request[0]['filiale']['citta'];
        $nuovoDdt->cap_destinazione = $request[0]['filiale']['cap'];
        $nuovoDdt->provincia_destinazione = $request[0]['filiale']['provincia'];
        $nuovoDdt->filiale_id = $request[0]['filiale']['id'];
        $res = $nuovoDdt->save();
        foreach ($request as $ele){
            $prodotto = Product::find($ele['id']);
            $prodotto->matricola = $ele['matricolaAssociata'];
            $prodotto->ddt_id = $nuovoDdt->id;
            $prodotto->save();
        }

        return $res;
    }

    public function produciDdtForClient($provaId)
    {
        $prova = Prova::with('client', 'product')->find($provaId);
        $nuovoDdt = new Ddt();
        $nuovoDdt->prova_id = $provaId;
        $nuovoDdt->nome_destinazione = $prova->client->nome.' '.$prova->client->cognome;
        $nuovoDdt->indirizzo_destinazione = $prova->client->indirizzo;
        $nuovoDdt->citta_destinazione = $prova->client->citta;
        $nuovoDdt->cap_destinazione = $prova->client->cap;
        $nuovoDdt->provincia_destinazione = $prova->client->provincia;
        $nuovoDdt->filiale_id = $prova->filiale_id;
        $nuovoDdt->save();
    }
}
