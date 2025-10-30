<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    public function run(): void
    {
        $modules = [
            ['name' => 'User'  , 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Role'  , 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Staf'  , 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Siswa' , 'status' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Wali'  , 'status' => true, 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('modules')->insert($modules);
    }
}
