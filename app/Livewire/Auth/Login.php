<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Login')]
#[Layout('components.layouts.base')]

class Login extends Component
{
    public function render()
    {
        return view('pages.auth.login');
    }
}
