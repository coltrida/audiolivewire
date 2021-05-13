<?php

namespace App\Http\Livewire;

use Livewire\Component;
use function dd;

class Iniziospa extends Component
{
    public $homeVisibile = true;
    public $magazzinoFilialeVisibile = false;
    public $loginVisibile = false;
    public $idFiliale = 1;

    protected $listeners = [
            'magazzinoFiliale', 'login', 'isLogged'
        ];

    public function invisibileTutti()
    {
        $this->homeVisibile = false;
        $this->magazzinoFilialeVisibile = false;
        $this->loginVisibile = false;
    }

    public function isLogged()
    {
        $this->invisibileTutti();
        $this->homeVisibile = true;
    }

    public function magazzinoFiliale($id)
    {
        $this->invisibileTutti();
        $this->magazzinoFilialeVisibile = true;
        $this->idFiliale = $id;
    }

    public function login()
    {
        $this->invisibileTutti();
        $this->loginVisibile = true;
    }

    public function render()
    {
        return view('livewire.iniziospa');
    }
}
