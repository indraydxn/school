<?php

namespace App\Livewire\Backend\Staff;

use App\Models\Staf;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Data Guru dan Staf')]
#[Layout('components.layouts.backend')]

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = '10';

    public function toggleStatus($stafId)
    {
        $staf = Staf::find($stafId);
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
            noty()->success($staf->nama_lengkap . ' berhasil dihapus!');
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
            "staff" => Staf::query()->when($this->search, function ($query) {
                $query->where('nama_lengkap', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->orWhere('telepon', 'like', '%' . $this->search . '%');
            })->paginate($this->perPage)
        ]);
    }
}
