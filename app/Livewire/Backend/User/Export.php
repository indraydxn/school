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

        noty()->success('Data berhasil diexport ke PDF!');

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, date('d-m-Y').'-data-pengguna.pdf');
    }

    public function exportExcel()
    {
        noty()->success('Data berhasil diexport ke excel!');
        return Excel::download(new UsersExport, date('d-m-Y').'-data-pengguna.xlsx');
    }

    public function render()
    {
        return view('components.backend.modal-export');
    }
}
