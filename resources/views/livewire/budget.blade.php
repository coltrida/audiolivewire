<div xmlns:wire="http://www.w3.org/1999/xhtml" class="container">
    @include('partials.messaggio')

    <div class="row">
        <button wire:click="associa()" {{$audioId && $stipendioMese && $provvigioni && $budget ? '' : 'disabled'}}
        class="btn btn-success">
            {{$modifica == 0  ? 'ASSOCIA' : 'MODIFICA'}}
        </button>
    </div>

    <div class="rounded border p-3 my-2" style="background-color: #124874; box-shadow: 2px 2px 4px #000000;">
        <div class="row justify-between my-1 align-items-start">
            <div class="col-4">
                <p class="font-bold text-lg ">Audioprotesisti</p>
                @foreach($audioprotesisti as $audio)
                    @if(!$audio->budget_id)
                        <div class="rounded border p-1 my-2" style="background-color: #537429; box-shadow: 2px 2px 4px #000000;">
                            <div class="row justify-between my-1 align-items-center">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-2">
                                            <input type="radio" wire:model.defer="audioId" class="form-check-input" value="{{$audio->id}}" >
                                        </div>
                                        <div class="col-10">
                                            <p class="font-bold text-left">{{$audio->name}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="col-3">
                <p class="font-bold text-lg">Budget Annuo</p>
                <input wire:model="budget" type="number" style="color: black" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="BUDGET">
            </div>

            <div class="col-3">
                <p class="font-bold text-lg">Stipendio mensile</p>
                <input wire:model="stipendioMese" type="number" style="color: black" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="stipendio mese">
                <p class="font-bold text-lg">Provvigioni</p>
                <input wire:model="provvigioni" type="number" style="color: black" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="provv">
            </div>
            <div class="col-2">
                <p class="font-bold text-lg">Utile: {{$utile}}</p>
            </div>
        </div>
    </div>

    <div class="rounded border p-3 my-2" style="background-color: #124874; box-shadow: 2px 2px 4px #000000;">
        <div class="row justify-between my-1 align-items-start">
            <div class="col-1">
                <p class="font-bold text-lg">gennaio</p>
                <input wire:model="gennaio" type="number"style="color: black; width: 4em" class="w-full rounded border shadow">
                <div>{{$getGennaio}}</div>
            </div>
            <div class="col-1">
                <p class="font-bold text-lg">febbraio</p>
                <input wire:model="febbraio" type="number" style="color: black; width: 4em" class="w-full rounded border shadow">
                <div>{{$getFebbraio}}</div>
            </div>
            <div class="col-1">
                <p class="font-bold text-lg">marzo</p>
                <input wire:model="marzo" type="number" style="color: black; width: 4em" class="w-full rounded border shadow">
                <div>{{$getMarzo}}</div>
            </div>
            <div class="col-1">
                <p class="font-bold text-lg">aprile</p>
                <input wire:model="aprile" type="number" style="color: black; width: 4em" class="w-full rounded border shadow">
                <div>{{$getAprile}}</div>
            </div>
            <div class="col-1">
                <p class="font-bold text-lg">maggio</p>
                <input wire:model="maggio" type="number" style="color: black; width: 4em" class="w-full rounded border shadow">
                <div>{{$getMaggio}}</div>
            </div>
            <div class="col-1">
                <p class="font-bold text-lg">giugno</p>
                <input wire:model="giugno" type="number" style="color: black; width: 4em" class="w-full rounded border shadow">
                <div>{{$getGiugno}}</div>
            </div>
            <div class="col-1">
                <p class="font-bold text-lg">luglio</p>
                <input wire:model="luglio" type="number" style="color: black; width: 4em" class="w-full rounded border shadow">
                <div>{{$getLuglio}}</div>
            </div>
            <div class="col-1">
                <p class="font-bold text-lg">agosto</p>
                <input wire:model="agosto" type="number" style="color: black; width: 4em" class="w-full rounded border shadow">
                <div>{{$getAgosto}}</div>
            </div>
            <div class="col-1">
                <p class="font-bold text-lg">settembre</p>
                <input wire:model="settembre" type="number" style="color: black; width: 4em" class="w-full rounded border shadow">
                <div>{{$getSettembre}}</div>
            </div>
            <div class="col-1">
                <p class="font-bold text-lg">ottobre</p>
                <input wire:model="ottobre" type="number" style="color: black; width: 4em" class="w-full rounded border shadow">
                <div>{{$getOttobre}}</div>
            </div>
            <div class="col-1">
                <p class="font-bold text-lg">novembre</p>
                <input wire:model="novembre" type="number" style="color: black; width: 4em" class="w-full rounded border shadow">
                <div>{{$getNovembre}}</div>
            </div>
            <div class="col-1">
                <p class="font-bold text-lg">dicembre</p>
                <input wire:model="dicembre" type="number" style="color: black; width: 4em" class="w-full rounded border shadow">
                <div>{{$getDicembre}}</div>
            </div>
        </div>
        <div class="row justify-between my-1 align-items-end">
            Verifica: {{$verifica}}
        </div>
    </div>

    <div class="rounded border p-3 my-2" style="background-color: #124874; box-shadow: 2px 2px 4px #000000;">
        <div class="row justify-between my-1 align-items-start">
            <div class="col-12">
                <p class="font-bold text-lg ">Situazione Audioprotesisti</p>
                @foreach($audioprotesisti as $audio)
                    @if(isset($audio->budget_id))
                        <div class="rounded border p-1 my-2" style="background-color: #537429; box-shadow: 2px 2px 4px #000000;">
                            <div class="row justify-between my-1 align-items-center">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-3">
                                            <p class="font-bold text-left">{{$audio->name}}</p>
                                        </div>
                                        <div class="col-3">
                                            <p class="font-bold text-left">{{$audio->budget->budgetAnno}}</p>
                                        </div>
                                        <div class="col-3">
                                            <p class="font-bold text-left">{{$audio->budget->stipendio}}</p>
                                        </div>
                                        <div class="col-2">
                                            <p class="font-bold text-left">{{$audio->budget->provvigione}}</p>
                                        </div>
                                        <div class="col-1">
                                            <i class="fas fa-pen-square text-blue-400 hover:text-blue-600 cursor-pointer shadow" wire:click="modifica({{$audio->id}})"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

</div>


