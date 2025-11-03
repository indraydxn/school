<?php

namespace App\Livewire\Backend\Role;

use App\Models\Permission;
use App\Models\Role;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class Create extends Component
{
    public $name;
    public $guard_name;
    public $status;
    public $permissions = [];

    public function mount()
    {
        $this->guard_name = 'web';
    }

    public function toggleModule($moduleName)
    {
        $this->permissions = $this->permissions ?? [];

        $modulePermissions = Permission::where('guard_name', $this->guard_name)
            ->whereHas('module', function ($query) use ($moduleName) {
                $query->where('name', $moduleName);
            })->pluck('id')->toArray();

        $selectedInModule = array_intersect($this->permissions, $modulePermissions);

        if (count($selectedInModule) === count($modulePermissions)) {
            // All selected, deselect all
            $this->permissions = array_diff($this->permissions, $modulePermissions);
        } else {
            // Not all selected, select all
            $this->permissions = array_unique(array_merge($this->permissions, $modulePermissions));
        }
    }

    public function updatedGuardName()
    {
        $this->permissions = $this->permissions ?? [];
        $validPermissions = Permission::where('guard_name', $this->guard_name)->pluck('id')->toArray();
        $this->permissions = array_intersect($this->permissions, $validPermissions);
    }

    public function store()
    {
        $rules = [
            'name'        => 'required|string|max:255|unique:roles,name',
            'guard_name'  => 'required|string|max:255',
            'status'      => 'required|boolean',
            'permissions' => 'array',
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
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->messages() as $field => $messages) {
                $this->addError($field, implode(', ', $messages));
            }
            return;
        }

        $role = Role::create([
            'name'       => $this->name,
            'guard_name' => $this->guard_name,
            'status'     => $this->status,
        ]);

        $role->syncPermissions(Permission::whereIn('id', $this->permissions)->get());

        $this->dispatch('roleCreated');
        $this->dispatch('close-modal');

        noty()->success('Role berhasil ditambahkan!');

        $this->reset();
    }

    public function render()
    {
        return view('pages.backend.role.create', [
            'allPermissions' => Permission::with(['module', 'action'])->where('guard_name', $this->guard_name)->get(),
        ]);
    }
}
