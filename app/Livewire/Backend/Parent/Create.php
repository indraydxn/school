<?php

namespace App\Livewire\Backend\Parent;

use App\Models\Siswa;
use App\Models\User;
use App\Models\Wali;
use Livewire\Component;

class Create extends Component
{
    public $user_id;
    public $student_id;
    public $hubungan;
    public $pendidikan_terakhir;
    public $pekerjaan;

    public $showModal = false;

    protected $rules = [
        'user_id'             => 'required|exists:users,id',
        'student_id'          => 'required|exists:siswa,id',
        'hubungan'            => 'required|string|max:255',
        'pendidikan_terakhir' => 'required|string|max:255',
        'pekerjaan'           => 'nullable|string|max:255',
    ];

    public function store()
    {
        $this->validate();

        Wali::create([
            'user_id'             => $this->user_id,
            'student_id'          => $this->student_id,
            'hubungan'            => $this->hubungan,
            'pendidikan_terakhir' => $this->pendidikan_terakhir,
            'pekerjaan'           => $this->pekerjaan,
        ]);

        $this->dispatch('parentCreated');
        $this->reset();
        noty()->success('Wali siswa berhasil ditambahkan!');
        $this->showModal = false;
    }

    public function render()
    {
        return view('pages.backend.parent.create', [
            'users'    => User::withRoles(['wali'])->whereDoesntHave('wali')->get(),
            'students' => Siswa::with('user')->get()
        ]);
    }
}
