<div xmlns:wire="http://www.w3.org/1999/xhtml">

    <form class="my-4" action="#" wire:submit.prevent = {{$idClient ? "modifica" : "aggiungi"}}>
        @csrf
        <div class="row">
            <div class="mb-3 col-3">
                <label for="nome" class="form-label">Nome @error('nome') <span class="text-red-500 text-xs"> - {{ $message }}</span> @enderror</label>
                <input type="text" wire:model="client.nome" class="form-control" placeholder="nome">
            </div>
            <div class="mb-3 col-3">
                <label for="cognome" class="form-label">Cognome @error('cognome')  <span class="text-red-500 text-xs"> - {{ $message }}</span> @enderror</label>
                <input type="text" wire:model="client.cognome" class="form-control" placeholder="cognome">
            </div>
            <div class="mb-3 col-3">
                <label for="telefono" class="form-label">Telefono</label>
                <input type="text" wire:model="client.telefono" class="form-control" placeholder="telefono">
            </div>
            <div class="mb-3 col-3">
                <label for="codfisc" class="form-label">Codice Fiscale</label>
                <input type="text" wire:model="client.codfisc" class="form-control" placeholder="codice fiscale">
            </div>
        </div>

        <div class="row">
            <div class="mb-3 col-3">
                <label for="indirizzo" class="form-label">Indirizzo @error('indirizzo') <span class="text-red-500 text-xs"> - {{ $message }}</span> @enderror</label>
                <input type="text" wire:model="client.indirizzo" class="form-control" placeholder="indirizzo">
            </div>
            <div class="mb-3 col-3">
                <label for="citta" class="form-label">Città @error('citta') <span class="text-red-500 text-xs"> - {{ $message }}</span> @enderror</label>
                <input type="text" wire:model="client.citta" class="form-control" placeholder="citta">
            </div>
            <div class="mb-3 col-2">
                <label for="cap" class="form-label">CAP @error('cap') <span class="text-red-500 text-xs"> - {{ $message }}</span> @enderror</label>
                <input type="text" wire:model="client.cap" class="form-control" placeholder="cap">
            </div>
            <div class="mb-3 col-2">
                <label for="provincia" class="form-label">Provincia @error('provincia') <span class="text-red-500 text-xs"> - {{ $message }}</span> @enderror</label>
                <input type="text" wire:model="client.provincia" class="form-control" placeholder="provincia">
            </div>
            <div class="mb-3 col-2">
                <label for="filiale_id" class="form-label">Filiale @error('filiale_id') <span class="text-red-500 text-xs"> - {{ $message }}</span> @enderror</label>
                <select class="form-select" wire:model="client.filiale_id" aria-label="Default select example">
                    <option selected></option>
                    @foreach($filiali as $filiale)
                        <option value="{{$filiale->id}}" >{{$filiale->nome}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <div class="mb-3 col-3">
                <label for="recapito_id" class="form-label">Recapito @error('recapito_id') <span class="text-red-500 text-xs"> - {{ $message }}</span> @enderror</label>
                <select class="form-select" wire:model="client.recapito_id" aria-label="Default select example" >
                    <option selected></option>
                    @foreach($recapiti as $recapito)
                        <option value="{{$recapito->id}}" @if($idClient) {{$recapito->id == $client->recapito_id ? 'selected' : ''}} @endif >{{$recapito->nome}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 col-3">
                <label for="mail" class="form-label">email</label>
                <input type="text" wire:model="client.mail" class="form-control" placeholder="mail">
            </div>
            <div class="mb-3 col-2">
                <label for="tipo" class="form-label">Tipo @error('tipo') <span class="text-red-500 text-xs"> - {{ $message }}</span> @enderror</label>
                <select class="form-select" wire:model="client.tipo" aria-label="Default select example">
                    <option selected></option>
                    @foreach($tipi as $tipo)
                        <option @if(isset($client->nome)) {{$tipo->nome == $client->tipo ? 'selected' : ''}} @endif >{{$tipo->nome}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 col-2">
                <label for="fonte" class="form-label">Canale Mkt @error('fonte') <span class="text-red-500 text-xs"> - {{ $message }}</span> @enderror</label>
                <select class="form-select" wire:model="client.fonte" aria-label="Default select example">
                    <option selected></option>
                    @foreach($canali as $canale)
                        <option @if(isset($client->nome)) {{$canale->name == $client->fonte ? 'selected' : ''}} @endif value="{{$canale->name}}">{{$canale->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 col-2">
                <label for="fonte" class="form-label">Data Nascita</label>
                <input type="date" wire:model="client.datanascita" class="form-control">
            </div>
        </div>

            <button type="submit" class="btn btn-success">{{$idClient ? "modifica" : "aggiungi"}}</button>
    </form>
</div>


