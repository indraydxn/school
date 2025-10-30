<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'admin' , 'guard_name' => 'web', 'status' => true],
            ['name' => 'guru'  , 'guard_name' => 'web', 'status' => true],
            ['name' => 'siswa' , 'guard_name' => 'web', 'status' => true],
            ['name' => 'wali'  , 'guard_name' => 'web', 'status' => true],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
