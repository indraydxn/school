<?php

namespace App\Livewire\Backend\Parent;

use App\Models\Wali;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\WaliExport;

class Export extends Component
{
    public function exportPdf()
    {
        $wali = Wali::with(['user', 'student.user'])->get();
        $pdf   = Pdf::loadView('exports.wali-pdf', compact('wali'))->setPaper('a3', 'landscape');

        noty()->success('Data berhasil diexport ke PDF!');
        $this->dispatch('close-modal');

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, date('d-m-Y').'-data-wali.pdf');
    }

    public function exportExcel()
    {
        noty()->success('Data berhasil diexport ke excel!');
        $this->dispatch('close-modal');
        return Excel::download(new WaliExport, date('d-m-Y').'-data-wali.xlsx');
    }

    public function render()
    {
        return view('components.backend.modal-export');
    }
}
