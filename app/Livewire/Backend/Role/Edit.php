<?php

namespace App\Livewire\Backend\Role;

use App\Models\Role;
use App\Models\Permission;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Validator;

#[Title('Edit Role')]
#[Layout('components.layouts.backend')]

class Edit extends Component
{
    public $roleId;
    public $name;
    public $guard_name;
    public $status;
    public $permissions = [];

    public function mount($role)
    {
        $this->roleId = $role;
        $role = Role::with('permissions')->findOrFail($role);

        $this->name         = $role->name;
        $this->guard_name   = $role->guard_name;
        $this->status       = $role->status;
        $this->permissions  = $role->permissions->pluck('id')->toArray();
    }

    public function update()
    {
        $rules = [
            'name'          => 'required|string|max:255|unique:roles,name,' . $this->roleId,
            'guard_name'    => 'required|string|max:255',
            'status'        => 'required|boolean',
            'permissions'   => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ];

        $validator = Validator::make([
            'name'        => $this->name,
            'guard_name'  => $this->guard_name,
            'status'      => $this->status,
            'permissions' => $this->permissions,
        ], $rules, [
            'name.required'        => 'Nama role wajib diisi.',
            'name.max'             => 'Nama role maksimal 255 karakter.',
            'name.unique'          => 'Nama role sudah ada.',
            'guard_name.required'  => 'Guard name wajib diisi.',
            'guard_name.max'       => 'Guard name maksimal 255 karakter.',
            'status.required'      => 'Status wajib dipilih.',
            'status.boolean'       => 'Status harus berupa boolean.',
            'permissions.array'    => 'Permissions harus berupa array.',
            'permissions.*.exists' => 'Permission tidak ditemukan.',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->messages() as $field => $messages) {
                $this->addError($field, implode(', ', $messages));
            }
            return;
        }

        $role = Role::findOrFail($this->roleId);
        $role->update([
            'name'       => $this->name,
            'guard_name' => $this->guard_name,
            'status'     => $this->status,
        ]);

        // Sync permissions
        $role->syncPermissions(Permission::whereIn('id', $this->permissions)->get());

        noty()->success('Role berhasil diperbarui!');

        return redirect()->route('admin.role.index');
    }

    public function toggleModule($moduleName)
    {
        $this->permissions = $this->permissions ?? [];

        $modulePermissions = Permission::where('guard_name', $this->guard_name)
            ->whereHas('module', function($q) use ($moduleName) {
                $q->where('name', $moduleName);
            })->pluck('id')->toArray();

        $selectedInModule = array_intersect($this->permissions, $modulePermissions);

        if (count($selectedInModule) === count($modulePermissions)) {
            // all selected, deselect all
            $this->permissions = array_diff($this->permissions, $modulePermissions);
        } else {
            // select all
            $this->permissions = array_unique(array_merge($this->permissions, $modulePermissions));
        }
    }

    public function updatedGuardName()
    {
        $this->permissions = $this->permissions ?? [];
        $validPermissions = Permission::where('guard_name', $this->guard_name)->pluck('id')->toArray();
        $this->permissions = array_intersect($this->permissions, $validPermissions);
    }

    public function render()
    {
        return view('pages.backend.role.edit', [
            'allPermissions' => Permission::with(['module', 'action'])->where('guard_name', $this->guard_name)->get(),
            'role'        => Role::findOrFail($this->roleId)
        ]);
    }
}
