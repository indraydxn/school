<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Siswa;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'siswa@sekolah.com')->first();

        if ($user) {
            $siswas = [
                [
                    'user_id'     => $user->id,
                    'nis'         => 20240001,
                    'nisn'        => 1234567890,
                    'tahun_masuk' => 2024,
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ],
            ];

            Siswa::insert($siswas);
        }
    }
}
