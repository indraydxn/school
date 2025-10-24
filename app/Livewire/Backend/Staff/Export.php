<?php

namespace App\Livewire\Backend\Staff;

use App\Models\Staf;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StafsExport;

class Export extends Component
{
    public function exportPdf()
    {
        $stafs = Staf::with(['user', 'jabatan'])->get();
        $pdf   = Pdf::loadView('exports.stafs-pdf', compact('stafs'))->setPaper('a3', 'landscape');

        noty()->success('Data berhasil diexport ke PDF!');
        $this->dispatch('close-modal');

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, date('d-m-Y').'-data-staf.pdf');
    }

    public function exportExcel()
    {
        noty()->success('Data berhasil diexport ke excel!');
        $this->dispatch('close-modal');
        return Excel::download(new StafsExport, date('d-m-Y').'-data-staf.xlsx');
    }

    public function render()
    {
        return view('components.backend.modal-export');
    }
}
