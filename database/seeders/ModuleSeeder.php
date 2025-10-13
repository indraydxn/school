<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    public function run(): void
    {
        $modules = [
            ['name' => 'User'  , 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Role'  , 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Staf'  , 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Siswa' , 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Wali'  , 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('modules')->insert($modules);
    }
}
