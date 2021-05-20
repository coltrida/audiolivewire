<?php


namespace App\Services;


use App\Models\Client;
use App\Models\Filiale;
use App\Models\FilialeUser;
use App\Models\Prova;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use function array_push;
use function config;
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

        //dd(Client::with('provaFatturaPerMesi')->orderBy('nome')->get());

        dd(Client::whereHas('provaFattura')->with('provaFattura')->get()->mapToGroups(function ($item, $key) {
            //dd($item->provaFattura[0]->mese_fine);
            return [$item->provaFattura[0]['mese_fine'] => $item->provaFattura[0]['tot']];
        }));

        dd(Filiale::with(['clients' => function($q) use($annoAttuale){
            $q->whereHas('provaFattura')->with('provaFattura')->get()->mapToGroups(function ($item, $key) {
                //dd($item->provaFattura[0]);
                return [$item->provaFattura[0]['mese_fine'] => $item['nome']];
            });
        }])->orderBy('nome')->get());

        return Filiale::with(['clients' => function($q) use($annoAttuale){
            $q->withSum('provaFattura', 'tot')->whereHas('provaFattura', function($z) use($annoAttuale) {
                $z->where([['tot', '!=', null], ['anno_fine', $annoAttuale]]);
            })->get()->mapToGroups(function ($item, $key) {
                //dd($item->provaFattura[0]->mese_fine);
                return [$item->provaFattura[0]['mese_fine'] => $item['nome']];
            });
        }])->orderBy('nome')->get();
    }

    public function fatturatiMese()
    {
        $fatturati = [];
        $meseAttuale = Carbon::now()->month;
        $annoAttuale = Carbon::now()->year;
        $filiali = Filiale::orderBy('nome')->get();
        $filiali->each(function ($item, $key) use(&$fatturati, $meseAttuale, $annoAttuale) {
            $vendite = [];
            for($i = 1; $i <= $meseAttuale; $i++){
                $vendite[$i] = Prova::where([
                    ['stato', config('enum.statoAPA.fattura')],
                    ['mese_fine', $i],
                    ['anno_fine', $annoAttuale],
                    ['filiale_id', $item->id],
                ])->sum('tot');
            }
            array_push($fatturati, [
                'id' => $item->id,
                'nome' => $item->nome,
                'indirizzo' => $item->indirizzo,
                'citta' => $item->citta,
                'provincia' => $item->provincia,
                'cap' => $item->cap,
                'telefono' => $item->telefono,
                'vendite' => $vendite
            ]);
        });

        //dd($fatturati);
        return $fatturati;
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
