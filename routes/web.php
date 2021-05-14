<?php

use App\Http\Livewire\Amministrazione;
use App\Http\Livewire\AssociaFiliale;
use App\Http\Livewire\Audioprotesisti;
use App\Http\Livewire\Budget;
use App\Http\Livewire\ClientInserisci;
use App\Http\Livewire\Clients;
use App\Http\Livewire\Filiali;
use App\Http\Livewire\Fornitori;
use App\Http\Livewire\Home;
use App\Http\Livewire\Listino;
use App\Http\Livewire\LoginRegister;
use App\Http\Livewire\Logout;
use App\Http\Livewire\Magazzino;
use App\Http\Livewire\MagazzinoFiliale;
use App\Http\Livewire\Marketing;
use App\Http\Livewire\Recapiti;
use App\Http\Livewire\TempiRecall;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('inizio');
Route::get('/login', LoginRegister::class)->name('login');
Route::get('/logout', Logout::class)->name('logout');

Route::group([ 'middleware' => 'auth' ], function() {
    Route::get('/client/inserisci', ClientInserisci::class)->name('client.inserisci');
    Route::get('/clients/{idAudio?}/{idFiliale?}', Clients::class)->name('client.index');
    Route::get('/magazzino/{idFiliale}', Magazzino::class)->name('magazzino.index');
    Route::get('/magazzinoFiliale/{idFiliale}', MagazzinoFiliale::class)->where('id', '[1-9]+')->name('magazzinoFiliale.index');
});

Route::group(['middleware' => ['auth','verifyIsAdmin'], 'prefix' => 'admin'], function(){
    Route::get('/filiali', Filiali::class)->name('filiale.index');
    Route::get('/recapiti', Recapiti::class)->name('recapiti.index');
    Route::get('/audioprotesisti', Audioprotesisti::class)->name('audioprotesisti.index');
    Route::get('/amministrazione', Amministrazione::class)->name('amministrazione.index');
    Route::get('/listino', Listino::class)->name('listino.index');
    Route::get('/fornitori', Fornitori::class)->name('fornitori.index');
    Route::get('/marketing', Marketing::class)->name('marketing.index');
    Route::get('/user/associa/filiale', AssociaFiliale::class)->name('user.associaFiliale');
    Route::get('/imposta/recall', TempiRecall::class)->name('imposta.recall');
    Route::get('/imposta/budget', Budget::class)->name('user.budget');
});
