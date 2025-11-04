<?php

namespace App\Livewire\Backend\Role;

use App\Models\Role;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RolesExport;

class Export extends Component
{
    public function exportPdf()
    {
        $roles = Role::with('permissions')->get();
        $pdf = Pdf::loadView('exports.roles-pdf', compact('roles'));

        noty()->success('Data role berhasil diexport ke PDF!');
        $this->dispatch('close-modal');

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, date('d-m-Y').'-data-role.pdf');
    }

    public function exportExcel()
    {
        noty()->success('Data role berhasil diexport ke excel!');
        $this->dispatch('close-modal');
        return Excel::download(new RolesExport, date('d-m-Y').'-data-role.xlsx');
    }

    public function render()
    {
        return view('components.backend.modal-export');
    }
}
