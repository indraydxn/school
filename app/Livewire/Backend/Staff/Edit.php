<?php

namespace App\Livewire\Backend\Staff;

use App\Models\Staf;
use App\Models\User;
use App\Models\Jabatan;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Validator;

#[Title('Edit Staff')]
#[Layout('components.layouts.backend')]

class Edit extends Component
{
    public $stafId;
    public $user_id;
    public $nip;
    public $nuptk;
    public $tanggal_masuk;
    public $status_kepegawaian;
    public $pendidikan_terakhir;
    public $jabatan_id;

    public function mount($staf)
    {
        $this->stafId = $staf;
        $staf = Staf::with('user')->findOrFail($staf);

        $this->user_id             = $staf->user_id;
        $this->nip                 = $staf->nip;
        $this->nuptk               = $staf->nuptk;
        $this->tanggal_masuk       = $staf->tanggal_masuk ? $staf->tanggal_masuk->format('Y-m-d') : null;
        $this->status_kepegawaian  = $staf->status_kepegawaian;
        $this->pendidikan_terakhir = $staf->pendidikan_terakhir;
        $this->jabatan_id          = $staf->jabatan_id;
    }

    public function update()
    {
        $rules = [
            'user_id'               => 'required|exists:users,id',
            'tanggal_masuk'         => 'required|date',
            'status_kepegawaian'    => 'required|string|max:50',
            'pendidikan_terakhir'   => 'required|string|max:100',
            'jabatan_id'            => 'required|exists:jabatan,id',
            'nip'                   => 'nullable|string|max:50|unique:staf,nip,' . $this->stafId,
            'nuptk'                 => 'nullable|string|max:50|unique:staf,nuptk,' . $this->stafId,
        ];

        if ($this->status_kepegawaian == 'PNS') {
            $rules['nip']   = 'required|string|max:50|unique:staf,nip,' . $this->stafId;
            $rules['nuptk'] = 'required|string|max:50|unique:staf,nuptk,' . $this->stafId;
        }

        $validator = Validator::make([
            'user_id'               => $this->user_id,
            'nip'                   => $this->nip,
            'nuptk'                 => $this->nuptk,
            'tanggal_masuk'         => $this->tanggal_masuk,
            'status_kepegawaian'    => $this->status_kepegawaian,
            'pendidikan_terakhir'   => $this->pendidikan_terakhir,
            'jabatan_id'            => $this->jabatan_id,
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
            'jabatan_id.required'          => 'Jabatan wajib dipilih.',
            'jabatan_id.exists'            => 'Jabatan tidak ditemukan.',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->messages() as $field => $messages) {
                $this->addError($field, implode(', ', $messages));
            }
            return;
        }

        $staf = Staf::findOrFail($this->stafId);
        $staf->update([
            'user_id'               => $this->user_id,
            'nip'                   => $this->nip,
            'nuptk'                 => $this->nuptk,
            'tanggal_masuk'         => $this->tanggal_masuk,
            'status_kepegawaian'    => $this->status_kepegawaian,
            'pendidikan_terakhir'   => $this->pendidikan_terakhir,
            'jabatan_id'            => $this->jabatan_id,
        ]);

        noty()->success('Staf berhasil diperbarui!');

        return redirect()->route('admin.user.staff.index');
    }

    public function render()
    {
        return view('pages.backend.staff.edit', [
            'users'    => User::withRoles(['admin', 'guru'])->get(),
            'jabatan'  => Jabatan::all(),
            'staf'     => Staf::with(['user', 'jabatan'])->findOrFail($this->stafId)
        ]);
    }
}
