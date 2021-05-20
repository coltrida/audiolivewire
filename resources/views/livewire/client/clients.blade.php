<div class="container pt-4" xmlns:livewire="" xmlns:wire="http://www.w3.org/1999/xhtml">
    @include('partials.messaggio')

    <div style="color: black">

        <a class="btn btn-primary w-full mb-2 shadow-lg" href="{{route('client.inserisci', ['idFiliale' => $idFiliale])}}">Inserisci</a>

        <livewire:client-datatables
            searchable="nome, cognome"
            :idAudio="$idAudio"
            :idFiliale="$idFiliale"
            exportable
        />

        <livewire:modalcall/>
        <livewire:modalnote/>
        <livewire:modalappuntamenti/>
        <livewire:modalfattura/>
        <livewire:modalprova
            :filialeId="$idFiliale"
        />
        <livewire:modalaudiogramma/>
        <livewire:modalddt/>
        <livewire:modalasl/>
        {{--<livewire:fattura/>--}}
    </div>
</div>
