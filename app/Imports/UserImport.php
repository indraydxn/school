<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Spatie\Permission\Models\Role;

class UserImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        $user = new User([
            'nik'           => $row['nik'],
            'no_kk'         => $row['no_kk'],
            'nama_lengkap'  => $row['nama_lengkap'],
            'email'         => $row['email'],
            'password'      => Hash::make($row['password'] ?? 'password123'),
            'telepon'       => $row['telepon'],
            'tempat_lahir'  => $row['tempat_lahir'],
            'tanggal_lahir' => $row['tanggal_lahir'],
            'jenis_kelamin' => $row['jenis_kelamin'],
            'alamat'        => $row['alamat'],
            'status'        => $row['status'] ?? true,
        ]);

        if (isset($row['role']) && !empty($row['role'])) {
            $role = Role::where('name', $row['role'])->first();
            if ($role) {
                $user->assignRole($role);
            }
        }

        return $user;
    }

    public function rules(): array
    {
        return [
            'nik'          => 'required|unique:users,nik',
            'email'        => 'required|email|unique:users,email',
            'nama_lengkap' => 'required',
            'role'         => 'nullable|in:admin,guru,siswa,wali',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'nik.required'          => 'NIK wajib diisi.',
            'nik.unique'            => 'NIK sudah terdaftar.',
            'email.required'        => 'Email wajib diisi.',
            'email.email'           => 'Format email tidak valid.',
            'email.unique'          => 'Email sudah terdaftar.',
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'role.in'               => 'Role harus salah satu dari: admin, guru, siswa, wali.',
        ];
    }
}
