<?php

namespace App\Livewire\Backend\Role;

use App\Models\Role;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Data Role')]
#[Layout('components.layouts.backend')]

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = '10';

    public function toggleStatus($roleId)
    {
        $role = Role::find($roleId);
        if ($role) {
            $role->status = !$role->status;
            $role->save();
            noty()->success('Status role ' . $role->name . ' berhasil diubah!');
        } else {
            noty()->error('Data tidak ditemukan!');
        }
    }

    public function deleteData($id)
    {
        $role = Role::find($id);
        if ($role) {
            $role->delete();
            $this->dispatch('close-modal');
            noty()->success('Role berhasil dihapus.');
        } else {
            noty()->error('Data tidak ditemukan!');
        }
    }

    #[On('roleCreated')]
    public function refreshRole()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('pages.backend.role.index', [
            "roles" => Role::with('permissions')->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })->orderBy('name')->paginate($this->perPage)
        ]);
    }
}
