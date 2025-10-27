<?php

namespace App\Livewire\Backend\Staff;

use App\Models\Staf;
use App\Models\User;
use App\Models\Jabatan;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class Create extends Component
{
    public $user_id;
    public $nip;
    public $nuptk;
    public $tanggal_masuk;
    public $status_kepegawaian;
    public $pendidikan_terakhir;
    public $jabatan_ids = [];

    public function store()
    {
        $rules = [
            'user_id'             => 'required|exists:users,id',
            'tanggal_masuk'       => 'required|date',
            'status_kepegawaian'  => 'required|string|max:50',
            'pendidikan_terakhir' => 'required|string|max:100',
            'jabatan_ids'         => 'required|array|min:1',
            'jabatan_ids.*'       => 'exists:jabatan,id',
            'nip'                 => 'nullable|string|max:50|unique:staf,nip',
            'nuptk'               => 'nullable|string|max:50|unique:staf,nuptk',
        ];

        if ($this->status_kepegawaian == 'PNS') {
            $rules['nip']   = 'required|string|max:50|unique:staf,nip';
            $rules['nuptk'] = 'required|string|max:50|unique:staf,nuptk';
        }

        $validator = Validator::make([
            'user_id'               => $this->user_id,
            'nip'                   => $this->nip,
            'nuptk'                 => $this->nuptk,
            'tanggal_masuk'         => $this->tanggal_masuk,
            'status_kepegawaian'    => $this->status_kepegawaian,
            'pendidikan_terakhir'   => $this->pendidikan_terakhir,
            'jabatan_ids'           => $this->jabatan_ids,
        ], $rules, [
            'user_id.required'             => 'Pengguna wajib dipilih.',
            'user_id.exists'               => 'Pengguna tidak ditemukan.',
            'nip.required'                 => 'NIP wajib diisi untuk PNS.',
            'nip.max'                      => 'NIP maksimal 50 karakter.',
            'nip.unique'                   => 'NIP sudah terdaftar.',
            'nuptk.required'               => 'NUPTK wajib diisi untuk PNS.',
            'nuptk.max'                    => 'NUPTK maksimal 50 karakter.',
            'nuptk.unique'                 => 'NUPTK sudah terdaftar.',
            'tanggal_masuk.required'       => 'Tanggal masuk wajib diisi.',
            'tanggal_masuk.date'           => 'Tanggal masuk tidak valid.',
            'status_kepegawaian.required'  => 'Status kepegawaian wajib dipilih.',
            'status_kepegawaian.max'       => 'Status kepegawaian maksimal 50 karakter.',
            'pendidikan_terakhir.required' => 'Pendidikan terakhir wajib diisi.',
            'pendidikan_terakhir.max'      => 'Pendidikan terakhir maksimal 100 karakter.',
            'jabatan_ids.required'          => 'Jabatan wajib dipilih.',
            'jabatan_ids.array'             => 'Jabatan harus berupa array.',
            'jabatan_ids.min'               => 'Minimal satu jabatan harus dipilih.',
            'jabatan_ids.*.exists'          => 'Jabatan tidak ditemukan.',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->messages() as $field => $messages) {
                $this->addError($field, implode(', ', $messages));
            }
            return;
        }

        // Validasi Kepala Sekolah hanya boleh satu orang
        $kepalaSekolahId = Jabatan::where('nama_jabatan', 'Kepala Sekolah')->value('id');
        if ($kepalaSekolahId && in_array($kepalaSekolahId, $this->jabatan_ids)) {
            $existingKepala = Staf::whereHas('jabatan', function($q) use ($kepalaSekolahId) {
                $q->where('jabatan.id', $kepalaSekolahId);
            })->exists();
            if ($existingKepala) {
                $this->addError('jabatan_ids', 'Jabatan Kepala Sekolah sudah dipegang oleh staf lain.');
                return;
            }
        }

        // no_staf
        $jabatanId        = $this->jabatan_ids[0]; // Gunakan jabatan pertama untuk generate no_staf
        $maxUrut          = Staf::whereHas('jabatan', function($q) use ($jabatanId) {
            $q->where('jabatan.id', $jabatanId);
        })->whereDate('tanggal_masuk', $this->tanggal_masuk)->max(DB::raw('substr(no_staf, -3)')) ?? 0;
        $counter          = $maxUrut + 1;
        $nomorUrut        = str_pad($counter, 3, '0', STR_PAD_LEFT);
        $jabatanIdPadded  = str_pad($jabatanId, 2, '0', STR_PAD_LEFT);
        $tanggalFormatted = date('Ymd', strtotime($this->tanggal_masuk));

        $staf = Staf::create([
            'user_id'               => $this->user_id,
            'no_staf'               => $tanggalFormatted . $jabatanIdPadded . $nomorUrut,
            'nip'                   => $this->nip,
            'nuptk'                 => $this->nuptk,
            'tanggal_masuk'         => $this->tanggal_masuk,
            'status_kepegawaian'    => $this->status_kepegawaian,
            'pendidikan_terakhir'   => $this->pendidikan_terakhir,
        ]);

        // Sync jabatan
        $staf->jabatan()->sync($this->jabatan_ids);

        $this->dispatch('staffCreated');
        $this->dispatch('close-modal');

        noty()->success('Staf berhasil ditambahkan!');

        $this->reset();
    }

    public function render()
    {
        return view('pages.backend.staff.create', [
            'users'    => User::withRoles(['admin', 'guru'])->whereDoesntHave('staf')->get(),
            'jabatan'  => Jabatan::all()
        ]);
    }
}
