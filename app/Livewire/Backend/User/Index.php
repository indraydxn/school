<?php

namespace App\Livewire\Backend\User;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Data Pengguna')]
#[Layout('components.layouts.backend')]

class Index extends Component
{
    use withPagination;
    
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

    public function render()
    {
        return view('pages.backend.user.index', [
            'users' => User::paginate($this->perPage)
        ]);
    }
}