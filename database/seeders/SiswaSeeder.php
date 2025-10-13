<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $user = DB::table('users')->where('email', 'siswa@sekolah.com')->first(); //GUNAKAN MODEL

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

            DB::table('siswa')->insert($siswas); //GUNAKAN MODEL
        }
    }
}
