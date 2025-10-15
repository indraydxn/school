<?php

namespace App\Livewire\Backend\User;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;

class Export extends Component
{
    public function exportPdf()
    {
        $users = User::with('roles')->get();

        $pdf = Pdf::loadView('exports.users-pdf', compact('users'));

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'data-pengguna-'. date('dmYHis') .'.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new UsersExport, 'data-pengguna-'. date('dmYHis') .'.xlsx');
    }

    public function render()
    {
        return view('components.backend.modal-export');
    }
}
