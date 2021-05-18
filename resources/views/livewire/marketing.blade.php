

<div class="flex container" xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="row">

        <div class="row">
            <div class="col">
                <h1 class=" text-3xl">Canali Marketing</h1>
            </div>
            @include('partials.messaggio')
        </div>

        @error('newComment') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

        <form wire:submit.prevent="addCanale">
            <div class="row" style="display: flex; justify-content: space-between; align-items: center">
                <div class="col-6">
                    <input wire:model.prevent="newCanale" type="text" style="color: black" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="Nome">
                </div>
                <div class="col-6">
                    <button type="submit" class="btn btn-success">Aggiungi</button>
                </div>
            </div>
        </form>
        <div class="rounded border p-3" style="background-color: #124874; box-shadow: 2px 2px 4px #000000;">
            <div class="row justify-between my-1 align-items-center">
                <div class="col-8">
                    <p class="font-bold text-lg">Nome</p>
                </div>
                <div class="col-3">
                    <p class="font-bold text-lg">Fatturato Annuo</p>
                </div>
                <div class="col-1">

                </div>
            </div>

            @foreach($canali as $item)
                <div class="rounded border p-3 my-2" style="background-color: #3d742e; box-shadow: 2px 2px 4px #000000;">
                    <div class="row justify-between my-1 align-items-center">
                        <div class="col-8">
                            <p class="font-bold text-lg">{{$item->name}}</p>
                        </div>
                        <div class="col-3">
                            <p class="font-bold text-lg">€ {{$item->clients->sum('prova_fattura_sum_tot')}}</p>
                        </div>
                        <div class="col-1">
                            <i class="fas fa-times text-red-200 hover:text-red-600 cursor-pointer" wire:click="remove({{$item->id}})"></i>
                        </div>

                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>

<script>

</script>





