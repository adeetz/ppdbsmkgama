<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email;
    public $password;
    public $remember = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    protected $messages = [
        'email.required' => 'Email wajib diisi',
        'email.email' => 'Format email tidak valid',
        'password.required' => 'Password wajib diisi',
    ];

    public function login()
    {
        $this->validate();

        try {
            if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
                session()->regenerate();
                return redirect()->intended('datasiswa');
            }
            
            session()->flash('error', 'Email atau password salah!');
            
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }

    public function render()
    {
        return view('livewire.login');
    }
}