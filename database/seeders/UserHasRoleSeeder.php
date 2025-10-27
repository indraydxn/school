<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;

class UserHasRoleSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::whereIn('email', [
            'admin@sekolah.com',
            // 'guru@sekolah.com',
            // 'siswa@sekolah.com',
            // 'wali@sekolah.com'
        ])->get()->keyBy('email');

        $roles = Role::whereIn('name', [
            'admin',
            'guru',
            'siswa',
            'wali'
        ])->get()->keyBy('name');

        $userRoles = [
            'admin@sekolah.com' => 'admin',
            // 'guru@sekolah.com'  => 'guru',
            // 'siswa@sekolah.com' => 'siswa',
            // 'wali@sekolah.com'  => 'wali',
        ];

        foreach ($userRoles as $email => $roleName) {
            if ($users->has($email) && $roles->has($roleName)) {
                $users[$email]->assignRole($roles[$roleName]);
            }
        }
    }
}
