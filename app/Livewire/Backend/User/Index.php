<?php

namespace App\Livewire\Backend\User;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Data Pengguna')]
#[Layout('components.layouts.backend')]

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        return view('pages.backend.user.index', [
            'users' => User::paginate(2),
        ]);
    }
}
