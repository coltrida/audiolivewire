<div class="flex container" xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="row">

        <div class="row pr-5">
            <div class="col">
                <h1 class=" text-3xl">Recapiti</h1>
            </div>
            @include('partials.messaggio')
        </div>

        @error('newComment') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

        <form class="my-4" wire:submit.prevent="aggiungi">
            <div class="flex">
                <input wire:model.lazy="nome" type="text" style="color: black" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="Nome Recapito">
                <input wire:model.lazy="indirizzo" type="text" style="color: black" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="Indirizzo">
            </div>
            <div class="flex">
                <input wire:model.lazy="citta" type="text" style="color: black" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="città">
                <input wire:model.lazy="provincia" type="text" style="color: black" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="provincia">
            </div>
            <div class="py-2">
                <button type="submit" class="btn btn-success">Aggiungi</button>
            </div>
        </form>
        @foreach($recapiti as $item)
            <div class="rounded border p-3 my-2" style="background-color: #124874; box-shadow: 2px 2px 4px #000000;">
                <div class="row justify-between my-1 align-items-center">
                    <div class="col">
                        <p >{{$item->nome}}</p>
                    </div>
                    <div class="col-3">
                        <p >{{$item->indirizzo}}</p>
                    </div>
                    <div class="col">
                        <p >{{$item->citta}}</p>
                    </div>
                    <div class="col-1">
                        <p >{{$item->provincia}}</p>
                    </div>
                    <div class="col">
                        <p >costo annuale</p>
                    </div>
                    <div class="col">
                        <p >fatturato: € {{$item->clients->sum('prova_fattura_sum_tot')}}</p>
                    </div>
                    <div class="col-1">
                        <i class="fas fa-times text-red-200 hover:text-red-600 cursor-pointer" wire:click="remove({{$item->id}})"></i>
                    </div>

                </div>
            </div>
        @endforeach

    </div>
</div>

<script>

</script>



