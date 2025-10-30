<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActionSeeder extends Seeder
{
    public function run(): void
    {
        $actions = [
            ['name' => 'tambah' , 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'lihat'  , 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ubah'   , 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'hapus'  , 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'kelola' , 'status' => true, 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('actions')->insert($actions);
    }
}
