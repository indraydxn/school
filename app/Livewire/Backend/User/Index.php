<?php

namespace App\Livewire\Backend\User;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Data Pengguna')]
#[Layout('components.layouts.backend')]

class Index extends Component
{
    use withPagination;

    public $search = '';
    public $perPage = '10';

    public function toggleStatus($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->status = !$user->status;
            $user->save();
            noty()->success('Status ' . $user->nama_lengkap . ' berhasil diubah!');
        } else {
            noty()->error('Data tidak ditemukan!');
        }
    }

    public function deleteData($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            noty()->success($user->nama_lengkap . ' berhasil dihapus!');
        } else {
            noty()->error('Data tidak ditemukan!');
        }
    }

    #[On('userCreated')]
    public function refreshUsers()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('pages.backend.user.index', [
            "users" => User::query()->when($this->search, function ($query) {
                $query->where('nama_lengkap', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->orWhere('telepon', 'like', '%' . $this->search . '%');
            })->paginate($this->perPage)
        ]);
    }
}
