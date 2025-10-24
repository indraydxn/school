<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jabatan;

class JabatanSeeder extends Seeder
{
    public function run(): void
    {
        $jabatans = [
            [
                'nama_jabatan' => 'Administrator Sekolah',
                'deskripsi'    => 'Bertanggung jawab atas administrasi sekolah',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'nama_jabatan' => 'Guru Mata Pelajaran',
                'deskripsi'    => 'Mengajar mata pelajaran',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'nama_jabatan' => 'Kepala Sekolah',
                'deskripsi'    => 'Pemimpin tertinggi sekolah',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'nama_jabatan' => 'Wakil Kepala Sekolah',
                'deskripsi'    => 'Membantu Kepala Sekolah dalam mengelola sekolah',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'nama_jabatan' => 'Tata Usaha',
                'deskripsi'    => 'Mengelola administrasi dan keuangan sekolah',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'nama_jabatan' => 'Penjaga Sekolah',
                'deskripsi'    => 'Bertugas menjaga keamanan dan kebersihan sekolah',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'nama_jabatan' => 'Perpustakawan',
                'deskripsi'    => 'Mengelola perpustakaan sekolah',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ];

        Jabatan::insert($jabatans);
    }
}
