<?php

namespace App\Http\Livewire;

use App\Models\Client;
use App\Models\Filiale;
use App\Models\FilialeUser;
use App\Models\User;
use App\Services\ClientService;
use App\Services\FilialeService;
use App\Services\FornitoreService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use function collect;
use function dd;
use function view;

class ClientDatatables extends LivewireDatatable
{
    public $idAudio;
    public $idFiliale;
    public $model = Client::class;

    /*public function mount()
    {
        $this->idFiliale = $idFiliale;
        $this->idAudio = $idAudio;
    }*/

    public function builder()
    {
        return $this->idAudio != ''
            ? Client::query()->where('filiale_id', $this->idFiliale)->where('tipo', '!=', 'DEC')
            : Client::query()->where('tipo', '!=', 'DEC');
    }

    public function columns()
    {
        return [
            Column::callback(['id', 'filiale_id'], function ($id, $filiale_id) {
                return view('livewire.buttons', ['id' => $id, 'filiale_id' => $filiale_id]);
            }),
            /*NumberColumn::name('id')->filterable(),*/
            Column::name('cognome')->filterable()->searchable(),
            Column::name('nome')->filterable()->searchable(),
            Column::name('indirizzo')->filterable()->searchable(),
            Column::name('citta')->filterable()->searchable(),
            Column::name('cap')->filterable()->searchable(),
            Column::name('provincia')->filterable()->searchable(),
            Column::name('telefono')->filterable()->searchable(),
            Column::name('user.name')->filterable()->searchable()->label('Audioprotesista'),
            Column::name('filiale.nome')->filterable()->searchable()->label('Filile'),
            Column::name('recapito.nome')->filterable()->searchable()->label('Recapito'),
            Column::name('tipo')->filterable()->searchable(),
            Column::name('marketing.name')->filterable()->searchable()->label('Fonte'),
            Column::name('mail')->filterable()->searchable(),
            DateColumn::name('datanascita')->filterable(),
            DateColumn::name('created_at')->filterable(),
            /*Column::delete()*/

        ];
    }

    public function render()
    {
        return view('livewire.datatables.datatable')->extends('inizio')->section('content');
    }
}
