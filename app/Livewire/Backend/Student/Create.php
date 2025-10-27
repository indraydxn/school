<?php

namespace App\Livewire\Backend\Student;

use App\Models\Siswa;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class Create extends Component
{
    public $user_id;
    public $nis;
    public $nisn;
    public $tahun_masuk;

    public function store()
    {
        $rules = [
            'user_id'      => 'required|exists:users,id',
            'nisn'         => 'required|integer|unique:siswa,nisn',
            'tahun_masuk'  => 'required|integer|min:1900|max:' . date('Y'),
        ];

        $validator = Validator::make([
            'user_id'     => $this->user_id,
            'nisn'        => $this->nisn,
            'tahun_masuk' => $this->tahun_masuk,
        ], $rules, [
            'user_id.required'     => 'Pengguna wajib dipilih.',
            'user_id.exists'       => 'Pengguna tidak ditemukan.',
            'nisn.required'        => 'NISN wajib diisi.',
            'nisn.integer'         => 'NISN harus berupa angka.',
            'nisn.unique'          => 'NISN sudah terdaftar.',
            'tahun_masuk.required' => 'Tahun masuk wajib diisi.',
            'tahun_masuk.integer'  => 'Tahun masuk harus berupa angka.',
            'tahun_masuk.min'      => 'Tahun masuk minimal 1900.',
            'tahun_masuk.max'      => 'Tahun masuk maksimal tahun sekarang.',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->messages() as $field => $messages) {
                $this->addError($field, implode(', ', $messages));
            }
            return;
        }

        // NIS
        $baseNis = $this->tahun_masuk * 10000;
        $maxCounter = Siswa::where('tahun_masuk', $this->tahun_masuk)->max(DB::raw('nis - ' . $baseNis)) ?? 0;
        $counter = $maxCounter + 1;
        $this->nis = $baseNis + $counter;

        $siswa = Siswa::create([
            'user_id'     => $this->user_id,
            'nis'         => $this->nis,
            'nisn'        => $this->nisn,
            'tahun_masuk' => $this->tahun_masuk,
        ]);

        $this->dispatch('studentCreated');
        $this->dispatch('close-modal');

        noty()->success('Siswa berhasil ditambahkan dengan NIS: ' . $this->nis);

        $this->reset();
    }

    public function render()
    {
        return view('pages.backend.student.create', [
            'users' => User::withRoles(['siswa'])->whereDoesntHave('siswa')->get()
        ]);
    }
}
