<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class CookieBanner extends Component
{
	protected $listeners = ['refresh' => '$refresh'];
	
	public function aceptar() 
	{
		Cookie::queue('cookies', true, 525600);
		$this->dispatch('refresh');
	}

    public function render()
    {
        return view('livewire.cookie-banner');
    }
}
