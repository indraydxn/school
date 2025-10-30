<?php

namespace App\Livewire\Backend\Parent;

use App\Models\Wali;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Data Wali Siswa')]
#[Layout('components.layouts.backend')]

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = '10';

    public function toggleStatus($waliId)
    {
        $wali = User::find($waliId);
        if ($wali) {
            $wali->status = !$wali->status;
            $wali->save();
            noty()->success('Status ' . $wali->nama_lengkap . ' berhasil diubah!');
        } else {
            noty()->error('Data tidak ditemukan!');
        }
    }

    public function deleteData($id)
    {
        $wali = Wali::find($id);
        if ($wali) {
            $wali->delete();
            noty()->success($wali->user->nama_lengkap . ' berhasil dihapus dari wali!');
        } else {
            noty()->error('Data tidak ditemukan!');
        }
    }

    #[On('parentCreated')]
    public function refreshParent()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('pages.backend.parent.index', [
            "parents" => Wali::with(['user', 'student'])->when($this->search, function ($query) {
                $query->whereHas('user', function ($q) {
                    $q->where('nama_lengkap', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%')
                      ->orWhere('telepon', 'like', '%' . $this->search . '%');
                });
            })->paginate($this->perPage)
        ]);
    }
}
