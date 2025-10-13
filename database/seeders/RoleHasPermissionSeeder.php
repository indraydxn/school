<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RoleHasPermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = Permission::all();

        // Admin
        $admin = Role::where('name', 'admin')->first();
        if ($admin) {
            $admin->syncPermissions($permissions);
        }

        // Guru
        $guru = Role::where('name', 'guru')->first();
        if ($guru) {
            $guruPermissions = $permissions->filter(function ($permission) {
                return str_contains($permission->name, 'kelola siswa');
            });
            $guru->syncPermissions($guruPermissions);
        }

        // Siswa
        $siswa = Role::where('name', 'siswa')->first();
        if ($siswa) {
            $siswaPermissions = $permissions->filter(function ($permission) {
                return str_contains($permission->name, 'lihat siswa');
            });
            $siswa->syncPermissions($siswaPermissions);
        }

        // Wali
        $wali = Role::where('name', 'wali')->first();
        if ($wali) {
            $waliPermissions = $permissions->filter(function ($permission) {
                return str_contains($permission->name, 'lihat siswa') || str_contains($permission->name, 'lihat wali');
            });
            $wali->syncPermissions($waliPermissions);
        }
    }
}
