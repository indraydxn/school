<?php

namespace App\Livewire\Backend\User;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Spatie\Permission\Models\Role;

#[Title('Edit Pengguna')]
#[Layout('components.layouts.backend')]

class Edit extends Component
{
    public User $user;

    public $nik;
    public $no_kk;
    public $nama_lengkap;
    public $email;
    public $telepon;
    public $tempat_lahir;
    public $tanggal_lahir;
    public $jenis_kelamin;
    public $alamat;
    public $status;
    public $role;

    public function mount(User $user): void
    {
        $this->user          = $user;
        $this->nik           = $user->nik;
        $this->no_kk         = $user->no_kk;
        $this->nama_lengkap  = $user->nama_lengkap;
        $this->email         = $user->email;
        $this->telepon       = $user->telepon;
        $this->tempat_lahir  = $user->tempat_lahir;
        $this->tanggal_lahir = optional($user->tanggal_lahir)->format('Y-m-d');
        $this->jenis_kelamin = $user->jenis_kelamin;
        $this->alamat        = $user->alamat;
        $this->status        = $user->status ? '1' : '0';
        $this->role          = $user->getRoleNames()->first();
    }

    public function update(): mixed
    {
        $validator = Validator::make([
            'nik'            => $this->nik,
            'no_kk'          => $this->no_kk,
            'nama_lengkap'   => $this->nama_lengkap,
            'email'          => $this->email,
            'telepon'        => $this->telepon,
            'tempat_lahir'   => $this->tempat_lahir,
            'tanggal_lahir'  => $this->tanggal_lahir,
            'jenis_kelamin'  => $this->jenis_kelamin,
            'alamat'         => $this->alamat,
            'status'         => $this->status,
            'role'           => $this->role,
        ], [
            'nik'            => [
                'required',
                'integer',
                Rule::unique('users', 'nik')->ignore($this->user->id),
            ],
            'no_kk'          => 'nullable|integer',
            'nama_lengkap'   => 'required|string|max:255',
            'email'          => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->user->id),
            ],
            'telepon'        => 'required|string|max:30',
            'tempat_lahir'   => 'required|string|max:120',
            'tanggal_lahir'  => 'required|date',
            'jenis_kelamin'  => 'required|in:L,P',
            'alamat'         => 'required|string',
            'status'         => 'required|boolean',
            'role'           => 'required|exists:roles,name',
        ], [
            'nik.required'           => 'NIK wajib diisi.',
            'nik.integer'            => 'NIK harus berupa angka.',
            'nik.unique'             => 'NIK sudah terdaftar.',
            'no_kk.integer'          => 'Nomor KK harus berupa angka.',
            'nama_lengkap.required'  => 'Nama lengkap wajib diisi.',
            'nama_lengkap.max'       => 'Nama lengkap maksimal 255 karakter.',
            'email.required'         => 'Email wajib diisi.',
            'email.email'            => 'Format email tidak valid.',
            'email.unique'           => 'Email sudah terdaftar.',
            'telepon.required'       => 'Telepon wajib diisi.',
            'telepon.max'            => 'Telepon maksimal 30 karakter.',
            'tempat_lahir.required'  => 'Tempat lahir wajib diisi.',
            'tempat_lahir.max'       => 'Tempat lahir maksimal 120 karakter.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date'     => 'Tanggal lahir tidak valid.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in'       => 'Jenis kelamin tidak valid.',
            'alamat.required'        => 'Alamat wajib diisi.',
            'status.required'        => 'Status wajib dipilih.',
            'status.boolean'         => 'Status tidak valid.',
            'role.required'          => 'Role wajib dipilih.',
            'role.exists'            => 'Role tidak ditemukan.',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->messages() as $field => $messages) {
                $this->addError($field, implode(', ', $messages));
            }

            return null;
        }

        $this->user->update([
            'nik'            => $this->nik,
            'no_kk'          => $this->no_kk,
            'nama_lengkap'   => $this->nama_lengkap,
            'email'          => $this->email,
            'telepon'        => $this->telepon,
            'tempat_lahir'   => $this->tempat_lahir,
            'tanggal_lahir'  => $this->tanggal_lahir,
            'jenis_kelamin'  => $this->jenis_kelamin,
            'alamat'         => $this->alamat,
            'status'         => (bool) ((int) $this->status),
        ]);

        $this->user->syncRoles([$this->role]);

        noty()->success('Pengguna berhasil diperbarui!');

        return redirect()->route('admin.user.index');
    }

    public function getDefaultPasswordProperty(): ?string
    {
        if (empty($this->tanggal_lahir)) {
            return null;
        }

        $timestamp = strtotime($this->tanggal_lahir);

        if ($timestamp === false) {
            return null;
        }

        return date('d-m-Y', $timestamp);
    }

    public function resetPassword(?int $userId = null): void
    {
        if ($userId !== null && (int) $userId !== (int) $this->user->id) {
            noty()->error('Pengguna tidak valid.');
            return;
        }

        $formattedPassword = $this->defaultPassword;

        if (empty($formattedPassword)) {
            noty()->error('Tanggal lahir pengguna tidak tersedia.');
            return;
        }

        try {
            $this->user->update([
                'password' => Hash::make($formattedPassword),
            ]);

            noty()->success('Password berhasil direset menjadi tanggal lahir (d-m-Y).');
            $this->dispatch('password-reset-success');
        } catch (\Throwable $e) {
            noty()->error('Gagal mereset password: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('pages.backend.user.edit', [
            'roles'          => Role::all(),
            'nama_pengguna'  => $this->nama_lengkap,
            'defaultPassword' => $this->defaultPassword,
            'userId'         => $this->user->id,
        ]);
    }
}
