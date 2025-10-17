<?php

namespace App\Livewire\Backend\User;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class Create extends Component
{
    public $nik;
    public $no_kk;
    public $nama_lengkap;
    public $email;
    public $password;
    public $telepon;
    public $tempat_lahir;
    public $tanggal_lahir;
    public $jenis_kelamin;
    public $alamat;
    public $status;
    public $role;

    public function store()
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
            'nik'            => 'required|integer|unique:users,nik',
            'no_kk'          => 'nullable|integer',
            'nama_lengkap'   => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email',
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
            return;
        }

        $formattedPassword = date('d-m-Y', strtotime($this->tanggal_lahir));

        $user = User::create([
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
            'password'       => Hash::make($formattedPassword),
        ]);

        $user->assignRole($this->role);

        $this->dispatch('userCreated');
        $this->dispatch('closeModal');

        noty()->success('Pengguna berhasil ditambahkan!');

        $this->reset();
    }

    public function render()
    {
        return view('pages.backend.user.create', [
            'roles' => Role::all()
        ]);
    }
}
