<?php


namespace App\Services;


use App\Models\Marketing;
use Carbon\Carbon;
use Illuminate\Support\Str;
use function dd;

class MarketingService
{
    public function canali()
    {
        return Marketing::orderBy('name')->get();
    }

    public function canaliConFatturato()
    {
        /*dd(Marketing::with(['clients' => function($q){
            $q->withSum('provaFattura', 'tot')->whereHas('provaFattura', function($z) {
                $z->where('tot', '!=', null);
            });
        }])->orderBy('name')->get());*/

        /* }])->orderBy('name')->first()->clients->sum('prova_fattura_sum_tot'));*/
        $annoAttuale = Carbon::now()->year;
        return Marketing::with(['clients' => function($q) use($annoAttuale){
            $q->withSum('provaFattura', 'tot')->whereHas('provaFattura', function($z) use($annoAttuale) {
                $z->where([['tot', '!=', null], ['anno_fine', $annoAttuale]]);
            });
        }])->orderBy('name')->get();
    }

    public function inserisci($nome)
    {
        return Marketing::insert(['name' => trim(Str::upper($nome))]);
    }

    public function rimuovi($id)
    {
        return Marketing::find($id)->delete();
    }
}
