<?php

namespace App\Livewire\Backend\Role;

use App\Models\Role;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class Create extends Component
{
    public $name;
    public $guard_name;
    public $status;

    public function mount()
    {
        $this->guard_name = 'web';
    }

    public function store()
    {
        $rules = [
            'name'       => 'required|string|max:255|unique:roles,name',
            'guard_name' => 'required|string|max:255',
            'status'     => 'required|boolean',
        ];

        $validator = Validator::make([
            'name'       => $this->name,
            'guard_name' => $this->guard_name,
            'status'     => $this->status,
        ], $rules, [
            'name.required'       => 'Nama role wajib diisi.',
            'name.max'            => 'Nama role maksimal 255 karakter.',
            'name.unique'         => 'Nama role sudah ada.',
            'guard_name.required' => 'Guard name wajib diisi.',
            'guard_name.max'      => 'Guard name maksimal 255 karakter.',
            'status.required'     => 'Status wajib dipilih.',
            'status.boolean'      => 'Status harus berupa boolean.',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->messages() as $field => $messages) {
                $this->addError($field, implode(', ', $messages));
            }
            return;
        }

        Role::create([
            'name'       => $this->name,
            'guard_name' => $this->guard_name,
            'status'     => $this->status,
        ]);

        $this->dispatch('roleCreated');
        $this->dispatch('close-modal');

        noty()->success('Role berhasil ditambahkan!');

        $this->reset();
    }

    public function render()
    {
        return view('pages.backend.role.create');
    }
}
