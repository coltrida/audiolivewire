<div class="flex container" xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="row">

        <div class="row pr-5">
            <div class="col">
                <h1 class=" text-3xl">Listino</h1>
            </div>
            @include('partials.messaggio')
        </div>

        @error('newComment') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

        <form class="my-4" wire:submit.prevent="aggiungi">
            <div class="flex">
                <select wire:model="fornitore_id" class="w-full rounded border shadow p-2 mr-2 my-2" style="color: black" aria-label="Default select example">
                    <option selected>Seleziona Fornitore</option>
                    @foreach($fornitori as $item)
                        <option value="{{$item->id}}">{{$item->nome}}</option>
                    @endforeach
                </select>
                <select wire:model="categoria" class="w-full rounded border shadow p-2 mr-2 my-2" style="color: black" aria-label="Default select example">
                    <option selected>Categoria</option>
                    @foreach(config('enum.categoria_listino') as $item)
                        <option value="{{$item}}">{{$item}}</option>
                    @endforeach
                </select>
                <input wire:model.lazy="nome" type="text" style="color: black" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="Nome Prodotto">
            </div>
            <div class="flex">
                <input wire:model.lazy="costo" type="text" style="color: black" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="costo">
                <input wire:model.lazy="prezzolistino" type="text" style="color: black" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="prezzo di listino">
                <input wire:model.lazy="iva" type="text" style="color: black" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="iva">
                <input wire:model.lazy="giorniDiReso" type="text" style="color: black" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="Giorni di Reso">
            </div>
            <div class="py-2 flex justify-content-between">
                <div>
                    <button type="submit" class="btn btn-success">Aggiungi</button>
                </div>
                <div>
                    {{--<input type="text" wire:model="ricerca" style="color: black" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="filtra">--}}
                    <div class="w-96 flex rounded-lg shadow-sm">
                        <div class="relative flex-grow focus-within:z-10">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" stroke="currentColor" fill="none">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input wire:model.debounce.500ms="ricerca" style="padding: 10px 0 10px 40px; color: black" class="form-input block bg-gray-50 focus:bg-white w-full rounded-md pl-10 transition ease-in-out duration-150 sm:text-sm sm:leading-5" placeholder="Search in Name">
                            {{--<div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <button wire:click="$set('search', null)" class="text-gray-300 hover:text-red-600 focus:outline-none">
                                    <svg class="h-5 w-5 stroke-current" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </button>
                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </form>

        @foreach($listino as $item)
            <div class="rounded border p-3 my-2" style="background-color: #124874; box-shadow: 2px 2px 4px #000000;">
                <div class="row justify-between my-1 align-items-center">
                    <div class="col">
                        <p class="font-bold">{{$item->fornitore->nome}}</p>
                    </div>
                    <div class="col">
                        <p class="font-bold">{{$item->categoria}}</p>
                    </div>
                    <div class="col-2">
                        <p class="font-bold">{{$item->nome}}</p>
                    </div>
                    <div class="col">
                        <p class="font-bold">€ {{$item->costo}}</p>
                    </div>
                    <div class="col">
                        <p class="font-bold">€ {{$item->prezzolistino}}</p>
                    </div>
                    <div class="col">
                        <p class="font-bold">{{$item->iva}}%</p>
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



