<div class="flex container" xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="row">

        <div class="row pr-5">
            <div class="col">
                <h1 class=" text-3xl">Invio sms</h1>
            </div>
            @include('partials.messaggio')
        </div>

        @error('newComment') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

        <form class="my-4" wire:submit.prevent="invia">
            <div>
                <select wire:model.defer="tipo" class="w-full rounded border shadow p-2 mr-2 my-2" style="color: black" aria-label="Default select example">
                    <option selected>Seleziona Tipo</option>
                    <option value="99">Tutti</option>
                    @foreach($tipologia as $item)
                        <option value="{{$item->id}}">{{$item->nome}}</option>
                    @endforeach
                </select>
                <select wire:model.defer="filiale" class="w-full rounded border shadow p-2 mr-2 my-2" style="color: black" aria-label="Default select example">
                    <option selected>Seleziona Filiale</option>
                    <option value="99">Tutte</option>
                    @foreach($filiali as $item)
                        <option value="{{$item->id}}">{{$item->nome}}</option>
                    @endforeach
                </select>

                <div class="mb-3">
                    <label for="testo" class="form-label">Testo messaggio</label>
                    <textarea wire:model.defer="messaggio" class="form-control" id="testo" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-success">Invia</button>
            </div>
        </form>

    </div>
</div>




