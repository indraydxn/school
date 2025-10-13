<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WaliSeeder extends Seeder
{
    public function run(): void
    {
        $user  = DB::table('users')->where('email', 'wali@sekolah.com')->first();  //GUNAKAN MODEL
        $siswa = DB::table('siswa')->first();                                      //GUNAKAN MODEL

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

            DB::table('wali_siswa')->insert($walis); //GUNAKAN MODEL
        }
    }
}
