<?php

namespace App\Livewire\Backend\User;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;

class Export extends Component
{
    public $showModal = false;

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function exportPdf()
    {
        $users = User::all();

        $pdf = Pdf::loadView('exports.users-pdf', compact('users'));

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'users.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function render()
    {
        return view('components.backend.modal-export');
    }
}
