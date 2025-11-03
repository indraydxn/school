<?php

namespace App\Livewire\Backend\Staff;

use App\Models\Staf;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Data Guru dan Staff')]
#[Layout('components.layouts.backend')]

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = '10';

    public function toggleStatus($stafId)
    {
        $staf = User::find($stafId);
        if ($staf) {
            $staf->status = !$staf->status;
            $staf->save();
            noty()->success('Status ' . $staf->nama_lengkap . ' berhasil diubah!');
        } else {
            noty()->error('Data tidak ditemukan!');
        }
    }

    public function deleteData($id)
    {
        $staf = Staf::find($id);
        if ($staf) {
            $staf->delete();
            $this->dispatch('close-modal');
            noty()->success($staf->user->nama_lengkap . ' berhasil dihapus dari staff!');
        } else {
            noty()->error('Data tidak ditemukan!');
        }
    }

    #[On('staffCreated')]
    public function refreshStaff()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('pages.backend.staff.index', [
            "staff" => Staf::with(['jabatan', 'user'])->when($this->search, function ($query) {
                $query->whereHas('user', function ($q) {
                    $q->where('nama_lengkap', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%')
                      ->orWhere('telepon', 'like', '%' . $this->search . '%');
                });
            })->paginate($this->perPage)
        ]);
    }
}
