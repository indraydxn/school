<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActionSeeder extends Seeder
{
    public function run(): void
    {
        $actions = [
            ['name' => 'tambah' , 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'lihat'  , 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ubah'   , 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'hapus'  , 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'kelola' , 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('actions')->insert($actions);
    }
}
