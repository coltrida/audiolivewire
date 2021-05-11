<?php

use App\Http\Livewire\Home;
use App\Http\Livewire\LoginRegister;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class);
Route::get('/login', LoginRegister::class);

