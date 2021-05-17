@section('testa')
    <link href="{{ asset('css/audiometria.css') }}" rel="stylesheet">
@endsection

<div id="callModal" @if($visibile) style="display: none" @else style="display: block; height: 100%;
  width: 100%;
  position: absolute;
  top: 0;
  left: 0;
  background-color: rgba(0,0,0,0.45);" @endif tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
     xmlns:wire="http://www.w3.org/1999/xhtml" xmlns:livewire="">
    <div class="modal-dialog" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 800px; max-width: 800px; box-shadow: 2px 2px 4px #000000;">
        <div class="modal-content">
            <div class="modal-header" >
                <h5 class="modal-title font-weight-bold font-bold" id="exampleModalLabel">Audiometria <a class="btn btn-primary" wire:click="cambia(0)">Nuovo</a></h5>
                <button type="button" class="btn-close" wire:click="closeModal()" aria-label="Close"></button>
            </div>
            @if($visualizza)
                @if(count($audiometrie) > 0)
                <div class="modal-body row" style="height: 440px;">
                    <div class="col-10">
                        <livewire:livewire-line-chart
                            key="{{ $lineChartModel->reactiveKey() }}"
                            :line-chart-model="$lineChartModel"
                        />
                    </div>
                    <div class="col-2">
                        @if(count($audiometrie) > 1)<h3>Precedenti Audiometrie</h3>@endif
                        @for($i = 0; $i < count($audiometrie); $i++)
                                <div class="row justify-between my-1 align-items-center">
                                    <a wire:click="scegliAudiometria({{$audiometrie[$i]->id}})" class="btn btn-primary">{{$audiometrie[$i]->created_at->format('d-m-Y')}}</a>
                                </div>
                        @endfor

                    </div>
                </div>
                @endif

            @else
                <div class="modal-body" style="height: 440px;">
                    <div class="row">
                        <div class="col-6">
                            <h2 class="text-center">Sinistro</h2>
                            @for($i = 1; $i < 12; $i++)
                                <div class="row p-0 m-0 align-items-center">
                                    <div class="col-2">{{$i*10}}</div>
                                    @for($j = 1; $j < 11; $j++)
                                        <div class="col p-0 m-0">
                                            <input name="sinistro[{{$j}}]" id="sinistro[{{$i}}{{$j}}]" value="{{$i}}" wire:model.defer="sinistro.{{$j}}" type="radio"/>
                                            <label for="sinistro[{{$i}}{{$j}}]" class="sinistro">x</label>
                                        </div>
                                    @endfor
                                </div>
                            @endfor
                            <div class="row p-0 m-0 mt-1" style="font-size: 9px; font-weight: bold">
                                <div class="col p-0 p-0 m-0"></div>
                                <div class="col p-0 p-0 m-0"></div>
                                <div class="col p-0 p-0 m-0">125</div>
                                <div class="col p-0 p-0 m-0">250</div>
                                <div class="col p-0 p-0 m-0">500</div>
                                <div class="col p-0 p-0 m-0">1000</div>
                                <div class="col p-0 p-0 m-0">1500</div>
                                <div class="col p-0 p-0 m-0">2000</div>
                                <div class="col p-0 p-0 m-0">3000</div>
                                <div class="col p-0 p-0 m-0">4000</div>
                                <div class="col p-0 p-0 m-0">6000</div>
                                <div class="col p-0 p-0 m-0">8000</div>
                            </div>
                        </div>

                        <div class="col-6">
                            <h2 class="text-center">Destro</h2>
                            @for($i = 1; $i < 12; $i++)
                                <div class="row p-0 p-0 m-0 align-items-center">
                                    <div class="col-2">{{$i*10}}</div>
                                    @for($j = 1; $j < 11; $j++)
                                        <div class="col p-0 m-0">
                                            <input name="destro[{{$j}}]" id="destro[{{$i}}{{$j}}]" value="{{$i}}" wire:model.defer="destro.{{$j}}" type="radio"/>
                                            <label for="destro[{{$i}}{{$j}}]" class="destro">o</label>
                                        </div>
                                    @endfor
                                </div>
                            @endfor
                            <div class="row p-0 m-0 mt-1" style="font-size: 9px; font-weight: bold">
                                <div class="col p-0 p-0 m-0"></div>
                                <div class="col p-0 p-0 m-0"></div>
                                <div class="col p-0 p-0 m-0">125</div>
                                <div class="col p-0 p-0 m-0">250</div>
                                <div class="col p-0 p-0 m-0">500</div>
                                <div class="col p-0 p-0 m-0">1000</div>
                                <div class="col p-0 p-0 m-0">1500</div>
                                <div class="col p-0 p-0 m-0">2000</div>
                                <div class="col p-0 p-0 m-0">3000</div>
                                <div class="col p-0 p-0 m-0">4000</div>
                                <div class="col p-0 p-0 m-0">6000</div>
                                <div class="col p-0 p-0 m-0">8000</div>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="btn btn-primary" wire:click="cambia(1)">salva</a>
                <a class="btn btn-danger" wire:click="annulla()">annulla</a>
            @endif

        </div>
    </div>
</div>
