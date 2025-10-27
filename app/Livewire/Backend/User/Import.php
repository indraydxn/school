<?php

namespace App\Livewire\Backend\User;

use App\Imports\UserImport;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use Flasher\Prime\FlasherInterface;

class Import extends Component
{
    use WithFileUploads;

    public $file;
    public $href;
    protected $listeners = ['closeModal' => 'closeModal'];

    public function closeModal()
    {
        $this->reset('file');
        $this->resetValidation('file');
    }

    public function import()
    {
        $this->validate([
            'file' => 'required|mimes:xlsx,xls',
        ], [
            'file.required' => 'File wajib dipilih.',
            'file.mimes'    => 'File harus berformat Excel (.xlsx atau .xls).',
        ]);

        try {
            Excel::import(new UserImport, $this->file->getRealPath());

            $this->dispatch('userCreated');
            $this->dispatch('userImported');
            $this->reset('file');

            noty()->success('Pengguna berhasil diimpor!');
        } catch (\Exception $e) {
            noty()->error('Error mengimpor pengguna: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('components.backend.modal-import');
    }
}
