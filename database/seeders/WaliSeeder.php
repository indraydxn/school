<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Wali;

class WaliSeeder extends Seeder
{
    public function run(): void
    {
        $user  = User::where('email', 'wali@sekolah.com')->first();
        $siswa = Siswa::first();

        if ($user && $siswa) {
            $walis = [
                [
                    'user_id'             => $user->id,
                    'student_id'          => $siswa->id,
                    'hubungan'            => 'Ayah',
                    'pendidikan_terakhir' => 'SMA',
                    'pekerjaan'           => 'Wiraswasta',
                    'created_at'          => now(),
                    'updated_at'          => now(),
                ],
            ];

            Wali::insert($walis);
        }
    }
}
