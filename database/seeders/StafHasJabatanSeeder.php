<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Staf;
use App\Models\Jabatan;
use Illuminate\Support\Facades\DB;

class StafHasJabatanSeeder extends Seeder
{
    public function run(): void
    {
        $stafs    = Staf::all();
        $jabatans = Jabatan::all();

        if ($stafs->isEmpty() || $jabatans->isEmpty()) {
            return;
        }

        $pivotData = [];

        foreach ($stafs as $staf) {
            $randomJabatans = $jabatans->random(rand(1, min(3, $jabatans->count())));

            foreach ($randomJabatans as $jabatan) {
                $pivotData[] = [
                    'staf_id'    => $staf->id,
                    'jabatan_id' => $jabatan->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('staf_has_jabatan')->insert($pivotData);
    }
}
