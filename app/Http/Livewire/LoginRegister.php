<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use App\Models\User;
use function redirect;
use function view;

class LoginRegister extends Component
{
    public $users, $email, $password, $name;
    public $registerForm = false;

    public function mount()
    {
        if (isset(Auth::user()->name)){
            return redirect()->to('/');
        }
    }

    private function resetInputFields(){
        $this->name = '';
        $this->email = '';
        $this->password = '';
    }

    public function login()
    {
        $validatedDate = $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt(array('email' => $this->email, 'password' => $this->password))){
            $this->emitTo('nav-bar', 'isLogged');
            return redirect()->to('/');
        }else{
            session()->flash('error', 'email and password are wrong.');
        }
    }

    public function register()
    {
        $this->registerForm = !$this->registerForm;
    }

    public function registerStore()
    {
        $validatedDate = $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $this->password = Hash::make($this->password);

        User::create(['name' => $this->name, 'email' => $this->email,'password' => $this->password]);

        session()->flash('message', 'Your register successfully Go to the login page.');

        $this->resetInputFields();

    }

    public function render()
    {
        return view('livewire.login.login-register')->extends('inizio')->section('content');
    }
}
