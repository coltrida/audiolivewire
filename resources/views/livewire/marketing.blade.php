<div class="flex container" xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="row">
        @include('partials.messaggio')

        <h1 class="text-3xl">Canali Marketing</h1>

        @error('newComment') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

        <form class="my-4" wire:submit.prevent="addCanale">
            <input wire:model.lazy="newCanale" type="text" style="color: black" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="Inserisci Canale Marketing">
            <div class="py-2">
                <button type="submit" class="btn btn-success">Aggiungi</button>
            </div>
        </form>
        @foreach($canali as $item)
            <div class="rounded border my-2" style="background-color: #124874; box-shadow: 2px 2px 4px #000000;">
                <div class="row justify-between  align-items-center">
                    <div class="col">
                        <p class="font-bold">{{$item->name}}</p>
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


