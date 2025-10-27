<?php

namespace App\Livewire\Backend;

use App\Models\Siswa;
use App\Models\Staf;
use App\Models\User;
use App\Models\Wali;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Dashboard')]
#[Layout('components.layouts.backend')]

class Dashboard extends Component
{
    public function render()
    {
        return view('pages.backend.dashboard', [
            "jmlUser"  => User::count(),
            "jmlSiswa" => Siswa::count(),
            "jmlGuru"  => Staf::count(),
            "jmlWali"  => Wali::count()
        ]);
    }
}
