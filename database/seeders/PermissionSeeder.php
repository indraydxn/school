<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Module;
use App\Models\Action;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $modules = Module::all();
        $actions = Action::all();

        foreach ($modules as $module) {
            foreach ($actions as $action) {
                Permission::create([
                    'module_id'  => $module->id,
                    'action_id'  => $action->id,
                    'name'       => $action->name . ' ' . strtolower(str_replace(' ', '-', $module->name)),
                    'guard_name' => 'web',
                ]);
            }
        }
    }
}
