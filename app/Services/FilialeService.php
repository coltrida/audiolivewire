<?php


namespace App\Services;


use App\Models\Client;
use App\Models\Filiale;
use App\Models\FilialeUser;
use App\Models\Prova;
use Carbon\Carbon;
use Illuminate\Support\Str;
use function dd;

class FilialeService
{
    public function filiali()
    {
        return Filiale::with(['audio' => function($q){
            $q->withSum('provaFinalizzata', 'tot');
        }])->orderBy('nome')->get();
    }

    public function filialiConFatturato()
    {
        $annoAttuale = Carbon::now()->year;

/*        dd(Filiale::with(['clients' => function($q){
            $q->get()->groupBy('tipo');
        }])->orderBy('nome')->get());

        dd(Prova::get()->groupBy('mese_fine'));

        dd(Filiale::with(['clients' => function($q){
            $q->get()->groupBy('tipo');
        }])->orderBy('nome')->get());

        dd(Filiale::with(['clients' => function($q) use($annoAttuale){
            $q->withSum('provaFattura', 'tot')->whereHas('provaFattura', function($z) use($annoAttuale) {
                $z->where([['tot', '!=', null], ['anno_fine', $annoAttuale]]);
            });
        }], ['clients.provaFattura' => function($h){
            $h->groupBy('mese_fine');
        }])->orderBy('nome')->get());*/


        return Filiale::with(['clients' => function($q) use($annoAttuale){
            $q->withSum('provaFattura', 'tot')->whereHas('provaFattura', function($z) use($annoAttuale) {
                $z->where([['tot', '!=', null], ['anno_fine', $annoAttuale]]);
            });
        }])->orderBy('nome')->get();
    }

    public function caricaId($idSelezionato)
    {
        $vettore = [];
        $filiali = Filiale::orderBy('nome')->get();
        //dd($filiali);
        foreach ($filiali as $filiale){
            $vettore[$filiale->id] = $idSelezionato == $filiale->id ? 'true' : 'false';
          //   $vettore[$filiale->id] = 'false';
        }
        /*if ($idSelezionato != ''){
            $vettore[$idSelezionato] = 'true';
        }*/
        //dd($vettore);
        return $vettore;
    }

    public function nomeFiliale($id)
    {
        return Filiale::find($id)->nome;
    }

    public function inserisci($request)
    {
        return Filiale::insert([
            'nome' => trim(Str::upper($request['nome'])),
            'indirizzo' => trim(Str::upper($request['indirizzo'])),
            'citta' => trim(Str::upper($request['citta'])),
            'telefono' => trim(Str::upper($request['telefono'])),
            'cap' => $request['cap'],
            'provincia' => trim(Str::upper($request['provincia']))
        ]);
    }

    public function rimuovi($id)
    {
        return Filiale::find($id)->delete();
    }

    public function associa($filialeId, $personale)
    {
        $filiale = Filiale::find($filialeId);
        $filiale->users()->attach($personale);
    }

    public function dissocia($id)
    {
        FilialeUser::find($id)->delete();
    }

}
