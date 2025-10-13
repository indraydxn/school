<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'nik'           => 1234567890123457,
                'no_kk'         => 1234567890123457,
                'nama_lengkap'  => 'Administrator',
                'email'         => 'admin@sekolah.com',
                'password'      => Hash::make('admin123'),
                'telepon'       => '081234567891',
                'tempat_lahir'  => 'Jakarta',
                'tanggal_lahir' => '1992-02-02',
                'jenis_kelamin' => 'P',
                'alamat'        => 'Jl. Administrator No. 2, Jakarta',
                'status'        => true,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'nik'           => 1234567890123458,
                'no_kk'         => 1234567890123458,
                'nama_lengkap'  => 'Guru',
                'email'         => 'guru@sekolah.com',
                'password'      => Hash::make('guru123'),
                'telepon'       => '081234567892',
                'tempat_lahir'  => 'Bandung',
                'tanggal_lahir' => '1985-03-03',
                'jenis_kelamin' => 'L',
                'alamat'        => 'Jl. Guru No. 1, Bandung',
                'status'        => true,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'nik'           => 1234567890123459,
                'no_kk'         => 1234567890123459,
                'nama_lengkap'  => 'Siswa',
                'email'         => 'siswa@sekolah.com',
                'password'      => Hash::make('siswa123'),
                'telepon'       => '081234567893',
                'tempat_lahir'  => 'Surabaya',
                'tanggal_lahir' => '2010-04-04',
                'jenis_kelamin' => 'L',
                'alamat'        => 'Jl. Siswa No. 1, Surabaya',
                'status'        => true,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'nik'           => 1234567890123460,
                'no_kk'         => 1234567890123460,
                'nama_lengkap'  => 'Orang Tua Siswa',
                'email'         => 'wali@sekolah.com',
                'password'      => Hash::make('wali123'),
                'telepon'       => '081234567894',
                'tempat_lahir'  => 'Yogyakarta',
                'tanggal_lahir' => '1980-05-05',
                'jenis_kelamin' => 'P',
                'alamat'        => 'Jl. Orang Tua No. 1, Yogyakarta',
                'status'        => true,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ];

        User::insert($users);
    }
}
