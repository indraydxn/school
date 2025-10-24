<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Staf;
use App\Models\Jabatan;

class StafSeeder extends Seeder
{
    public function run(): void
    {
        $admin        = User::where('email', 'admin@sekolah.com')->first();
        $guru         = User::where('email', 'guru@sekolah.com')->first();
        $jabatanAdmin = Jabatan::where('nama_jabatan', 'Administrator Sekolah')->first();
        $jabatanGuru = Jabatan::where('nama_jabatan', 'Guru Mata Pelajaran')->first();

        $jabatanCounters = []; // Track nomor urut per jabatan

        $stafs = [];

        if ($admin && $jabatanAdmin) {
            $tanggalMasuk                = '2015-01-01';
            $jabatanId                   = $jabatanAdmin->id;
            $jabatanCounters[$jabatanId] = ($jabatanCounters[$jabatanId] ?? 0) + 1;
            $nomorUrut                   = str_pad($jabatanCounters[$jabatanId], 3, '0', STR_PAD_LEFT);
            $jabatanIdPadded             = str_pad($jabatanId, 2, '0', STR_PAD_LEFT);
            $tanggalFormatted            = date('Ymd', strtotime($tanggalMasuk));
            $noStaf                      = $tanggalFormatted . $jabatanIdPadded . $nomorUrut;

            $stafs[] = [
                'user_id'             => $admin->id,
                'no_staf'             => $noStaf,
                'nip'                 => "199201021234567",
                'nuptk'               => null,
                'tanggal_masuk'       => $tanggalMasuk,
                'status_kepegawaian'  => 'PNS',
                'pendidikan_terakhir' => 'S1 Administrasi',
                'jabatan_id'          => $jabatanId,
                'created_at'          => now(),
                'updated_at'          => now(),
            ];
        }

        if ($guru && $jabatanGuru) {
            $tanggalMasuk                = '2010-01-01';
            $jabatanId                   = $jabatanGuru->id;
            $jabatanCounters[$jabatanId] = ($jabatanCounters[$jabatanId] ?? 0) + 1;
            $nomorUrut                   = str_pad($jabatanCounters[$jabatanId], 3, '0', STR_PAD_LEFT);
            $jabatanIdPadded             = str_pad($jabatanId, 2, '0', STR_PAD_LEFT);
            $tanggalFormatted            = date('Ymd', strtotime($tanggalMasuk));
            $noStaf                      = $tanggalFormatted . $jabatanIdPadded . $nomorUrut;

            $stafs[] = [
                'user_id'             => $guru->id,
                'no_staf'             => $noStaf,
                'nip'                 => "198503031234567",
                'nuptk'               => null,
                'tanggal_masuk'       => $tanggalMasuk,
                'status_kepegawaian'  => 'PNS',
                'pendidikan_terakhir' => 'S1 Matematika',
                'jabatan_id'          => $jabatanId,
                'created_at'          => now(),
                'updated_at'          => now(),
            ];
        }

        Staf::insert($stafs);
    }
}
