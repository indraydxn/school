<?php

namespace App\Livewire\Backend\Student;

use App\Models\Siswa;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Data Siswa')]
#[Layout('components.layouts.backend')]

class Index extends Component
{
    use WithPagination;

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
        $siswa = Siswa::find($id);
        if ($siswa) {
            $siswa->delete();
            noty()->success($siswa->user->nama_lengkap . ' berhasil dihapus dari siswa!');
        } else {
            noty()->error('Data tidak ditemukan!');
        }
    }

    #[On('studentCreated')]
    public function refreshStudent()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('pages.backend.student.index', [
            "siswa" => Siswa::with(['user'])->when($this->search, function ($query) {
                $query->whereHas('user', function ($q) {
                    $q->where('nama_lengkap', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%')
                      ->orWhere('telepon', 'like', '%' . $this->search . '%');
                })
                ->orWhere('nis', 'like', '%' . $this->search . '%')
                ->orWhere('nisn', 'like', '%' . $this->search . '%');
            })->paginate($this->perPage)
        ]);
    }
}
