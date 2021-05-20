<div class="container">
        <div class="rounded border p-3 my-2" style="background-color: #124874; box-shadow: 2px 2px 4px #000000;">
            <div class="row justify-between my-1 align-items-start">
                <div class="col-12">
                    <p class="font-bold text-lg ">Audioprotesisti</p>
                    @foreach($audioprotesisti as $item)
                        <div class="rounded border p-1 my-2" style="background-color: #537429; box-shadow: 2px 2px 4px #000000;">
                            <div class="row justify-between my-1 align-items-center">
                                <div class="col">
                                    <div class="row">
                                        <div class="col">{{$item['nome']}}</div>
                                        <div class="col">Bgt Anno € {{number_format($item['budgetAnno'], 0, ',', '.')}}</div>
                                        <div class="col">Bgt ad Oggi € {{number_format(array_sum($item['budgetAdOggi']) * 1000, 0, ',', '.')}}</div>
                                        <div class="col">Fatturato € {{number_format(array_sum($item['vendite']) * 1000, 0, ',', '.')}}</div>
                                        <div class="col">
                                            <span class="badge {{number_format( (float)(( array_sum($item['vendite']) * 1000 / array_sum($item['budgetAdOggi']) * 1000) - 1 ) * 100, 2, ',', '.') > 0 ? 'bg-success' : 'bg-danger'}}">
                                                {{number_format((((float) number_format((float) array_sum($item['vendite']) , 2, ',', '.' )
                                                    / (float) number_format((float) array_sum($item['budgetAdOggi']) , 2, ',', '.' )) - 1) * 100, 0, ',', '.')}} %
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="px-3">
                            <div class="row justify-between my-1 align-items-center pt-1"
                                 style="border-top: solid 1px white; font-size: 12px">

                                <div class="col">
                                    <div>Gennaio</div>
                                    <div>Fatt: € {{isset($item['vendite'][1]) ? $item['vendite'][1] : 0}}</div>
                                    <div>Bgt: € {{$item['budget'][1]}}</div>
                                    <div><span class="badge {{isset($item['delta'][1]) && $item['delta'][1] > 0 ? 'bg-success' : 'bg-danger'}} "> {{isset($item['vendite'][1]) ? $item['delta'][1].'%' : null}} </span> </div>
                                </div>
                                <div class="col">
                                    <div>Febbraio</div>
                                    <div>Fatt: € {{isset($item['vendite'][2]) ? $item['vendite'][2] : 0}}</div>
                                    <div>Bgt: € {{$item['budget'][2]}}</div>
                                    <div><span class="badge {{isset($item['delta'][2]) && $item['delta'][2] > 0 ? 'bg-success' : 'bg-danger'}} "> {{isset($item['vendite'][2]) ? $item['delta'][2].'%' : null}} </span> </div>
                                </div>
                                <div class="col">
                                    <div>Marzo</div>
                                    <div>Fatt: € {{isset($item['vendite'][3]) ? $item['vendite'][3] : 0}}</div>
                                    <div>Bgt: € {{$item['budget'][3]}}</div>
                                    <div><span class="badge {{isset($item['delta'][3]) && $item['delta'][3] > 0 ? 'bg-success' : 'bg-danger'}} "> {{isset($item['vendite'][3]) ? $item['delta'][3].'%' : null}} </span> </div>
                                </div>
                                <div class="col">
                                    <div>Aprile</div>
                                    <div>Fatt: € {{isset($item['vendite'][4]) ? $item['vendite'][4] : 0}}</div>
                                    <div>Bgt: € {{$item['budget'][4]}}</div>
                                    <div><span class="badge {{isset($item['delta'][4]) && $item['delta'][4] > 0 ? 'bg-success' : 'bg-danger'}} "> {{isset($item['vendite'][4]) ? $item['delta'][4].'%' : null}} </span> </div>
                                </div>
                                <div class="col">
                                    <div>Maggio</div>
                                    <div>Fatt: € {{isset($item['vendite'][5]) ? $item['vendite'][5] : 0}}</div>
                                    <div>Bgt: € {{$item['budget'][5]}}</div>
                                    <div><span class="badge {{isset($item['delta'][5]) && $item['delta'][5] > 0 ? 'bg-success' : 'bg-danger'}} "> {{isset($item['vendite'][5]) ? $item['delta'][5].'%' : null}} </span> </div>
                                </div>
                                <div class="col">
                                    <div>Giugno</div>
                                    <div>Fatt: € {{isset($item['vendite'][6]) ? $item['vendite'][6] : 0}}</div>
                                    <div>Bgt: € {{$item['budget'][6]}}</div>
                                    <div><span class="badge {{isset($item['delta'][6]) && $item['delta'][6] > 0 ? 'bg-success' : 'bg-danger'}} "> {{isset($item['vendite'][6]) ? $item['delta'][6].'%' : null}} </span> </div>
                                </div>
                                <div class="col">
                                    <div>Luglio</div>
                                    <div>Fatt: € {{isset($item['vendite'][7]) ? $item['vendite'][7] : 0}}</div>
                                    <div>Bgt: € {{$item['budget'][7]}}</div>
                                    <div><span class="badge {{isset($item['delta'][7]) && $item['delta'][7] > 0 ? 'bg-success' : 'bg-danger'}} "> {{isset($item['vendite'][7]) ? $item['delta'][7].'%' : null}} </span> </div>
                                </div>
                                <div class="col">
                                    <div>Agosto</div>
                                    <div>Fatt: € {{isset($item['vendite'][8]) ? $item['vendite'][8] : 0}}</div>
                                    <div>Bgt: € {{$item['budget'][8]}}</div>
                                    <div><span class="badge {{isset($item['delta'][8]) && $item['delta'][8] > 0 ? 'bg-success' : 'bg-danger'}} "> {{isset($item['vendite'][8]) ? $item['delta'][8].'%' : null}} </span> </div>
                                </div>
                                <div class="col">
                                    <div>Settembre</div>
                                    <div>Fatt: € {{isset($item['vendite'][9]) ? $item['vendite'][9] : 0}}</div>
                                    <div>Bgt: € {{$item['budget'][9]}}</div>
                                    <div><span class="badge {{isset($item['delta'][9]) && $item['delta'][9] > 0 ? 'bg-success' : 'bg-danger'}} "> {{isset($item['vendite'][9]) ? $item['delta'][9].'%' : null}} </span> </div>
                                </div>
                                <div class="col">
                                    <div>Ottobre</div>
                                    <div>Fatt: € {{isset($item['vendite'][10]) ? $item['vendite'][10] : 0}}</div>
                                    <div>Bgt: € {{$item['budget'][10]}}</div>
                                    <div><span class="badge {{isset($item['delta'][10]) && $item['delta'][10] > 0 ? 'bg-success' : 'bg-danger'}} "> {{isset($item['vendite'][10]) ? $item['delta'][10].'%' : null}} </span> </div>
                                </div>
                                <div class="col">
                                    <div>Novembre</div>
                                    <div>Fatt: € {{isset($item['vendite'][11]) ? $item['vendite'][11] : 0}}</div>
                                    <div>Bgt: € {{$item['budget'][11]}}</div>
                                    <div><span class="badge {{isset($item['delta'][11]) && $item['delta'][11] > 0 ? 'bg-success' : 'bg-danger'}} "> {{isset($item['vendite'][11]) ? $item['delta'][11].'%' : null}} </span> </div>
                                </div>
                                <div class="col">
                                    <div>Dicembre</div>
                                    <div>Fatt: € {{isset($item['vendite'][12]) ? $item['vendite'][12] : 0}}</div>
                                    <div>Bgt: € {{$item['budget'][12]}}</div>
                                    <div><span class="badge {{isset($item['delta'][12]) && $item['delta'][12] > 0 ? 'bg-success' : 'bg-danger'}} "> {{isset($item['vendite'][12]) ? $item['delta'][12].'%' : null}} </span> </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
</div>


