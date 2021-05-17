<?php


namespace App\Services;


use App\Models\Client;
use App\Models\Fattura;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use function compact;
use function dd;
use function view;

class FatturaService
{
    public function crea($request)
    {
        $fattura = new Fattura();
        $fattura->prova_id = $request['prova']['id'];
        $fattura->data_fattura = Carbon::now();
        $fattura->acconto = (int)$request['acconto'];
        $fattura->nr_rate = (int)$request['rate'];
        $fattura->tot_fattura = (int)$request['totFattura'];
        $fattura->al_saldo = (int)$request['totFattura'] - (int)$request['acconto'];
        $fattura->save();

        foreach ($request['prova']['product'] as $prodotto){
            $prodotto->fattura_id = $fattura->id;
            $prodotto->save();
        }

        return $fattura;
    }

    public function listaFattureFromClient($id)
    {
        return Client::with(['provaFattura' => function($q){
            $q->with(['fattura', 'product' => function($z){
                $z->with('listino');
            }]);
        }])->find($id)->provaFattura;
    }

    public function creaPdf($fattura)
    {
        //dd($fattura);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML(view('pdf.fattura', compact('fattura')))->save("storage/fatture/2021/$fattura->id.pdf");
       // return $pdf->save("storage/fatture/2021/$fattura->id.pdf");
    }
}
