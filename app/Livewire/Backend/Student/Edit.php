<?php

namespace App\Livewire\Backend\Student;

use App\Models\Siswa;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

#[Title('Edit Siswa')]
#[Layout('components.layouts.backend')]

class Edit extends Component
{
    public $siswaId;
    public $user_id;
    public $nis;
    public $nisn;
    public $tahun_masuk;
    public $original_tahun_masuk;

    public function mount($siswa)
    {
        $this->siswaId = $siswa;
        $siswa = Siswa::with('user')->findOrFail($siswa);

        $this->user_id               = $siswa->user_id;
        $this->nis                   = $siswa->nis;
        $this->nisn                  = $siswa->nisn;
        $this->tahun_masuk           = $siswa->tahun_masuk;
        $this->original_tahun_masuk  = $siswa->tahun_masuk;
    }

    public function store()
    {
        $rules = [
            'user_id'      => 'required|exists:users,id',
            'nis'          => 'nullable|max:50|unique:siswa,nis,' . $this->siswaId,
            'nisn'         => 'required|max:50|unique:siswa,nisn,' . $this->siswaId,
            'tahun_masuk'  => 'required|integer|min:1900|max:' . date('Y'),
        ];

        $validator = Validator::make([
            'user_id'      => $this->user_id,
            'nis'          => $this->nis,
            'nisn'         => $this->nisn,
            'tahun_masuk'  => $this->tahun_masuk,
        ], $rules, [
            'user_id.required'    => 'Pengguna wajib dipilih.',
            'user_id.exists'      => 'Pengguna tidak ditemukan.',
            'nis.max'             => 'NIS maksimal 50 karakter.',
            'nis.unique'          => 'NIS sudah terdaftar.',
            'nisn.required'       => 'NISN wajib diisi.',
            'nisn.max'            => 'NISN maksimal 50 karakter.',
            'nisn.unique'         => 'NISN sudah terdaftar.',
            'tahun_masuk.required' => 'Tahun masuk wajib diisi.',
            'tahun_masuk.integer' => 'Tahun masuk harus berupa angka.',
            'tahun_masuk.min'     => 'Tahun masuk minimal 1900.',
            'tahun_masuk.max'     => 'Tahun masuk maksimal tahun sekarang.',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->messages() as $field => $messages) {
                $this->addError($field, implode(', ', $messages));
            }
            return;
        }

        // NIS
        if ($this->tahun_masuk != $this->original_tahun_masuk) {
            $baseNis    = $this->tahun_masuk * 10000;
            $maxCounter = Siswa::where('tahun_masuk', $this->tahun_masuk)->max(DB::raw('nis - ' . $baseNis)) ?? 0;
            $counter    = $maxCounter + 1;
            $this->nis  = $baseNis + $counter;
        }

        $siswa = Siswa::findOrFail($this->siswaId);
        $siswa->update([
            'user_id'      => $this->user_id,
            'nis'          => $this->nis,
            'nisn'         => $this->nisn,
            'tahun_masuk'  => $this->tahun_masuk,
        ]);

        noty()->success('Siswa berhasil diperbarui!');

        return redirect()->route('admin.user.student.index');
    }

    public function render()
    {
        return view('pages.backend.student.edit', [
            'users'  => User::withRoles(['siswa'])->get(),
            'siswa'  => Siswa::with('user')->findOrFail($this->siswaId)
        ]);
    }
}
