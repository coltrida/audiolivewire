<?php

namespace App\Http\Livewire;

use App\Services\UserService;
use Livewire\Component;

class StatisticheAudio extends Component
{
    public function render(UserService $userService)
    {
        return view('livewire.statistiche.statistiche-audio', [
            'audioprotesisti' => $userService->getAudioprotesistiStatistiche(),
        ])->extends('inizio')->section('content');
    }
}
