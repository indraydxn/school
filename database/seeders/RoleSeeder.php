<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'admin' , 'guard_name' => 'web'],
            ['name' => 'guru'  , 'guard_name' => 'web'],
            ['name' => 'siswa' , 'guard_name' => 'web'],
            ['name' => 'wali'  , 'guard_name' => 'web'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
