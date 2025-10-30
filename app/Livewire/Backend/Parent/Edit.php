<?php

namespace App\Livewire\Backend\Parent;

use App\Models\User;
use App\Models\Wali;
use App\Models\Siswa;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Edit Wali Siswa')]
#[Layout('components.layouts.backend')]

class Edit extends Component
{
    public $waliId;
    public $user_id;
    public $student_id;
    public $hubungan;
    public $pendidikan_terakhir;
    public $pekerjaan;

    protected $rules = [
        'user_id'             => 'required|exists:users,id',
        'student_id'          => 'required|exists:siswa,id',
        'hubungan'            => 'required|string|max:255',
        'pendidikan_terakhir' => 'required|string|max:255',
        'pekerjaan'           => 'nullable|string|max:255',
    ];

    public function mount($wali)
    {
        $this->waliId = $wali;
        $waliData = Wali::findOrFail($wali);

        $this->user_id             = $waliData->user_id;
        $this->student_id          = $waliData->student_id;
        $this->hubungan            = $waliData->hubungan;
        $this->pendidikan_terakhir = $waliData->pendidikan_terakhir;
        $this->pekerjaan           = $waliData->pekerjaan;
    }

    public function store()
    {
        $this->validate();

        $wali = Wali::findOrFail($this->waliId);
        $wali->update([
            'user_id'             => $this->user_id,
            'student_id'          => $this->student_id,
            'hubungan'            => $this->hubungan,
            'pendidikan_terakhir' => $this->pendidikan_terakhir,
            'pekerjaan'           => $this->pekerjaan,
        ]);

        noty()->success('Wali siswa berhasil diperbarui!');
        return redirect()->route('admin.user.parent.index');
    }

    public function render()
    {
        return view('pages.backend.parent.edit', [
            'users'    => User::withRoles(['wali'])->get(),
            'students' => Siswa::with('user')->get(),
            'siswa'    => Siswa::with('user')->find($this->student_id)
        ]);
    }
}
