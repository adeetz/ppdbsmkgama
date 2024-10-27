<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class NavBar extends Component
{
    public $isOpen = false;

    protected $listeners = [
        'refresh' => '$refresh',
        'logout' => 'logout'
    ];

    public function toggleMenu()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function logout()
    {
        try {
            Auth::logout();
            session()->invalidate();
            session()->regenerateToken();
            
            $this->dispatch('logout-success');
            return $this->redirect('/login');
            
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat logout');
        }
    }

    public function render()
    {
        return view('livewire.nav-bar', [
            'currentRoute' => request()->route()->getName()
        ]);
    }
}