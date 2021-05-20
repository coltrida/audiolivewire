<div class="flex container" xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="row">

        <div class="row pr-5">
            <div class="col">
                <h1 class=" text-3xl">Amministrazione</h1>
            </div>
            @include('partials.messaggio')
        </div>

        @error('newComment') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

        <form class="my-4" wire:submit.prevent="addAmministrazione">
            <div class="flex">
                <input wire:model.defer="nome" type="text" style="color: black" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="Nome">
                <input wire:model.defer="email" type="text" style="color: black" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="email">

                {{--<select wire:model="id_filiale" class="w-full rounded border shadow p-2 mr-2 my-2" style="color: black" aria-label="Default select example">
                    <option selected>Seleziona Filiale</option>
                    @foreach($filiali as $item)
                        <option value="{{$item->id}}">{{$item->nome}}</option>
                    @endforeach
                </select>--}}
            </div>
            <div class="py-2">
                <button type="submit" class="btn btn-success">Aggiungi</button>
            </div>
        </form>
        @foreach($amministrazione as $item)
            <div class="rounded border p-3 my-2" style="background-color: #124874; box-shadow: 2px 2px 4px #000000;">
                <div class="row justify-between my-1 align-items-center">
                    <div class="col">
                        <p class="font-bold">{{$item->name}}</p>
                    </div>
                    <div class="col">
                        <p class="font-bold">{{$item->email}}</p>
                    </div>
                    <div class="col">
                        @foreach($item->filiale as $filiale)
                            <p class="font-bold">{{$filiale->nome}}</p>
                        @endforeach
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





