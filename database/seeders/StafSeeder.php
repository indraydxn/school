<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Staf;

class StafSeeder extends Seeder
{
    public function run(): void
    {
        $admin      = User::where('email', 'admin@sekolah.com')->first();
        $guru       = User::where('email', 'guru@sekolah.com')->first();

        $stafs = [];

        if ($admin) {
            $stafs[] = [
                'user_id'             => $admin->id,
                'no_staf'             => 01150001,
                'nip'                 => 199201021234567,
                'tahun_masuk'         => 2015,
                'status_kepegawaian'  => 'PNS',
                'pendidikan_terakhir' => 'S1 Administrasi',
                'jabatan'             => 'Administrator Sekolah',
                'created_at'          => now(),
                'updated_at'          => now(),
            ];
        }

        if ($guru) {
            $stafs[] = [
                'user_id'             => $guru->id,
                'no_staf'             => 02100001,
                'nip'                 => 198503031234567,
                'tahun_masuk'         => 2010,
                'status_kepegawaian'  => 'PNS',
                'pendidikan_terakhir' => 'S1 Matematika',
                'jabatan'             => 'Guru Matematika',
                'created_at'          => now(),
                'updated_at'          => now(),
            ];
        }

        Staf::insert($stafs);
    }
}
