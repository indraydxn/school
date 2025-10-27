<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ModuleSeeder::class,
            ActionSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            RoleHasPermissionSeeder::class,
            JabatanSeeder::class,
            UserSeeder::class,
            UserHasRoleSeeder::class,
            // StafSeeder::class,
            // SiswaSeeder::class,
            // WaliSeeder::class,
            StafHasJabatanSeeder::class
        ]);
    }
}
