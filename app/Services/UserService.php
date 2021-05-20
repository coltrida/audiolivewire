<?php


namespace App\Services;


use App\Models\Budget;
use App\Models\Filiale;
use App\Models\Prova;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use function array_push;
use function config;
use function dd;
use function number_format;
use function setlocale;
use const LC_TIME;

class UserService
{
    public function getUser()
    {
        return User::find(Auth::id());
    }

    public function getFiliali()
    {
        return User::with('filiale')->find(Auth::id())->filiale;
    }

    public function getRecapitiOfUser()
    {
        return User::with('recapito')->find(Auth::id())->recapito;
    }

    public function userNonAutorizzato($idAudio)
    {
        return $idAudio != Auth::id();
    }

    public function getAudioprotesisti()
    {
        setlocale(LC_TIME, 'it_IT');
        Carbon::setLocale('it');
        $nomeMese = Carbon::now()->monthName;
        $mese = Carbon::now()->month;
        $anno = Carbon::now()->year;

        /*dd(User::with(['filiale', 'provaInCorso', 'provaFinalizzata' => function($z) use($mese, $anno){
            $z->where([['mese_fine', $mese], ['anno_fine', $anno]]);
        }, "budget:id,budgetAnno,$nomeMese as target"])
            ->withSum(['provaFinalizzata' => function($g) use($mese, $anno){
                $g->where([['mese_fine', $mese], ['anno_fine', $anno]]);
            }], 'tot')
            ->withCount(['prova' => function($q){
                $q->where('stato', config('enum.statoAPA.prova'));
            }])
            ->where('ruolo', config('enum.ruoli.audio'))->get());*/

        return User::with(['filiale', 'provaInCorso', 'provaFinalizzata' => function($z) use($mese, $anno){
            $z->where([['mese_fine', $mese], ['anno_fine', $anno]]);
                }, "budget:id,budgetAnno,$nomeMese as target"])
            ->withSum(['provaFinalizzata' => function($g) use($mese, $anno){
                $g->where([['mese_fine', $mese], ['anno_fine', $anno]]);
                }], 'tot')
            ->withCount(['prova' => function($q){
                $q->where('stato', config('enum.statoAPA.prova'));
                }])
            ->where('ruolo', config('enum.ruoli.audio'))->get();
    }

    public function getAudioprotesistiStatistiche()
    {
        $fatturati = [];
        $meseAttuale = Carbon::now()->month;
        $annoAttuale = Carbon::now()->year;
        $audio = User::where('ruolo', config('enum.ruoli.audio'))->orderBy('name')->get();
        $audio->each(function ($item, $key) use(&$fatturati, $meseAttuale, $annoAttuale) {
            $vendite = [];
            $budget = [];
            $budgetAdOggi = [];
            $delta = [];

            $budget[1] = number_format( ( (int)$item->budget->gennaio * (int)$item->budget->budgetAnno ) /100, 0, ',', '.' );
            $budget[2] = number_format( ( (int)$item->budget->febbraio * (int)$item->budget->budgetAnno ) /100, 0, ',', '.' );
            $budget[3] = number_format(( (int)$item->budget->marzo * (int)$item->budget->budgetAnno ) /100, 0, ',', '.' );
            $budget[4] = number_format(( (int)$item->budget->aprile * (int)$item->budget->budgetAnno ) /100, 0, ',', '.' );
            $budget[5] = number_format(( (int)$item->budget->maggio * (int)$item->budget->budgetAnno ) /100, 0, ',', '.' );
            $budget[6] = number_format(( (int)$item->budget->giugno * (int)$item->budget->budgetAnno ) /100, 0, ',', '.' );
            $budget[7] = number_format(( (int)$item->budget->luglio * (int)$item->budget->budgetAnno ) /100, 0, ',', '.' );
            $budget[8] = number_format(( (int)$item->budget->agosto * (int)$item->budget->budgetAnno ) /100, 0, ',', '.' );
            $budget[9] = number_format(( (int)$item->budget->settembre * (int)$item->budget->budgetAnno ) /100, 0, ',', '.' );
            $budget[10] = number_format(( (int)$item->budget->ottobre * (int)$item->budget->budgetAnno ) /100, 0, ',', '.' );
            $budget[11] = number_format(( (int)$item->budget->novembre * (int)$item->budget->budgetAnno ) /100, 0, ',', '.' );
            $budget[12] = number_format(( (int)$item->budget->dicembre * (int)$item->budget->budgetAnno ) /100, 0, ',', '.' );

            for($i = 1; $i <= $meseAttuale; $i++){
                $budgetAdOggi[$i] = $budget[$i];
                $vendite[$i] = number_format( Prova::where([
                    ['stato', config('enum.statoAPA.fattura')],
                    ['mese_fine', $i],
                    ['anno_fine', $annoAttuale],
                    ['user_id', $item->id],
                ])->sum('tot'), 0, ',', '.' );
                $delta[$i] = number_format( (float) (($vendite[$i] / $budget[$i]) - 1 ) * 100, 0, ',', '.');
            }

                array_push($fatturati, [
                'nome' => $item->name,
                'budgetAnno' => $item->budget->budgetAnno,
                'vendite' => $vendite,
                'budget' => $budget,
                'budgetAdOggi' => $budgetAdOggi,
                'delta' => $delta,
            ]);
        });

        //dd($fatturati);
        return $fatturati;
    }

    public function getAmministrazione()
    {
        return User::with('filiale')->where('ruolo', config('enum.ruoli.segreteria'))->get();
    }

    public function inserisci($request)
    {
        return User::insert([
            'name' => $request['nome'],
            'email' => $request['email'],
            /*'filiale_id' => $request['filiale_id'],*/
            'ruolo' => $request['ruolo'],
        ]);
    }

    public function rimuovi($id)
    {
        return User::find($id)->delete();
    }

    public function isAudio()
    {
        return Auth::user()->isAudio ? true : false;
    }

    public function isAdmin()
    {
        return Auth::user()->isAdmin ? true : false;
    }

    public function isAmministrazione()
    {
        return Auth::user()->isAmministrazione ? true : false;
    }

    public function proveInCorso()
    {
        return User::with(['provaInCorso' => function ($q){
            $q->with(['product']);
        }])->find(Auth::id())->provaInCorso;
    }

    public function finalizzatiDelMese()
    {
        $oggi = Carbon::now();

        return User::with(['provaFinalizzata' => function ($q) use($oggi){
            $q->with(['product'])->where([
                ['mese_fine', $oggi->month],
                ['anno_fine', $oggi->year],
            ]);
        }])->find(Auth::id())->provaFinalizzata;
    }

    public function appuntamentiOggi()
    {
        $oggi = Carbon::now()->format('Y-m-d');
        return User::with(['appuntamenti' => function ($q) use($oggi){
            $q->with('client')->where('giorno', $oggi);
        }])->find(Auth::id())->appuntamenti;
    }

    public function appuntamentiDomani()
    {
        $domani = Carbon::tomorrow()->format('Y-m-d');
        return User::with(['appuntamenti' => function ($q) use($domani){
            $q->with('client')->where('giorno', $domani);
        }])->find(Auth::id())->appuntamenti;
    }

    public function associaBudget($request)
    {
        //dd($request);
        if ($request['modifica'] == 0){
            $budget = new Budget();
            $budget->budgetAnno = $request['budget'];
            $budget->premio = 0;
            $budget->stipendio = $request['stipendioMese'];
            $budget->provvigione = $request['provvigioni'];
            $budget->gennaio = $request[0];
            $budget->febbraio = $request[1];
            $budget->marzo = $request[2];
            $budget->aprile = $request[3];
            $budget->maggio = $request[4];
            $budget->giugno = $request[5];
            $budget->luglio = $request[6];
            $budget->agosto = $request[7];
            $budget->settembre = $request[8];
            $budget->ottobre = $request[9];
            $budget->novembre = $request[10];
            $budget->dicembre = $request[11];
            $budget->save();

            $user = User::find($request['audioId']);
            $user->budget_id = $budget->id;
            return $user->save();
        } else {
            $budget = User::with('budget')->find($request['audioId'])->budget;
            $budget->budgetAnno = $request['budget'];
            $budget->premio = 0;
            $budget->stipendio = $request['stipendioMese'];
            $budget->provvigione = $request['provvigioni'];
            $budget->gennaio = $request[0];
            $budget->febbraio = $request[1];
            $budget->marzo = $request[2];
            $budget->aprile = $request[3];
            $budget->maggio = $request[4];
            $budget->giugno = $request[5];
            $budget->luglio = $request[6];
            $budget->agosto = $request[7];
            $budget->settembre = $request[8];
            $budget->ottobre = $request[9];
            $budget->novembre = $request[10];
            $budget->dicembre = $request[11];
            return $budget->save();
        }

    }

    public function getInfoBudget($id)
    {
        setlocale(LC_TIME, 'it_IT');
        Carbon::setLocale('it');
        //$nomeMese = Carbon::now()->monthName;

        //dd(User::with("budget:id,budgetAnno,$nomeMese as target")->find($id)->budget);

        //return User::with("budget:id,budgetAnno,$nomeMese as target")->find($id)->budget;
        return User::with("budget")->find($id)->budget;
    }

    public function getBudgetDelMese($id)
    {
        setlocale(LC_TIME, 'it_IT');
        Carbon::setLocale('it');
        $nomeMese = Carbon::now()->monthName;

        //dd(User::with("budget:id,budgetAnno,$nomeMese as target")->find($id)->budget);

        return User::with("budget:id,budgetAnno,$nomeMese as target")->find($id)->budget;
        //return User::with("budget")->find($id)->budget;
    }

    public function disassociaBudget($id)
    {
        $user = User::find($id);
        $user->budget_id = null;
        $user->save();
    }
}
