<div style="display:flex">
    <div style="font-size: 14px">
        <img src="{{public_path('img/logo-centroudito.jpg')}}" style="width: 200px">
        <div>Centro Udito</div>
        <div>via Roma 12</div>
        <div>50125 Pisa</div>
        <div>p.iva: 65465464564</div>
    </div>
    <div style="float: right; font-size: 14px">
        <div>Fattura nr.{{$fattura->id}} del {{$fattura->data_fattura->format('d-m-Y')}}</div>
        <br>
        <div>{{$fattura->prova->client->nome}} {{$fattura->prova->client->cognome}}</div>
        <div>{{$fattura->prova->client->indirizzo}}</div>
        <div>{{$fattura->prova->client->cap}} {{$fattura->prova->client->citta}} {{$fattura->prova->client->provincia}}</div>
        <div>{{$fattura->prova->client->codfisc}}</div>
    </div>

</div>

<hr>

<br><br>

<div style="border: 1px solid black; height: 650px; width: 100%">
    <table style="width: 100%;">
        <tr>
            <td style="width: 33%">Matricola</td>
            <td style="width: 34%">Prodotto</td>
            <td style="width: 33%">Prezzo</td>
        </tr>
        @foreach($fattura->prova->product as $product)
            <tr>
                <td style="border: 1px solid black;width: 33%; padding: 5px">{{$product->matricola}}</td>
                <td style="border: 1px solid black;width: 34%; padding: 5px">{{$product->listino->nome}}</td>
                <td style="border: 1px solid black;width: 33%; padding: 5px">{{$product->pivot->prezzo}}</td>
            </tr>
        @endforeach
    </table>
</div>


<table style="width: 100%;">
    <tr>
        <td style="border: 1px solid black;width: 33%; padding: 5px">Acconto: {{$fattura->acconto}}</td>
        <td style="border: 1px solid black;width: 34%; padding: 5px">Rate: {{$fattura->nr_rate}}</td>
        <td style="border: 1px solid black;width: 33%; padding: 5px">Tot: €{{$fattura->tot_fattura}}</td>
    </tr>
</table>
