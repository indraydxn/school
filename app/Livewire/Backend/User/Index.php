<?php

namespace App\Livewire\Backend\User;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Data Pengguna')]
#[Layout('components.layouts.backend')]

class Index extends Component
{
    public function render()
    {
        return view('pages.backend.user.index');
    }
}
