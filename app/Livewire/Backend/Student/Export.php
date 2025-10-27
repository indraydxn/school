<?php

namespace App\Livewire\Backend\Student;

use App\Models\Siswa;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SiswaExport;

class Export extends Component
{
    public function exportPdf()
    {
        $siswa = Siswa::with('user')->get();
        $pdf = Pdf::loadView('exports.siswa-pdf', compact('siswa'));

        noty()->success('Data berhasil diexport ke PDF!');
        $this->dispatch('close-modal');

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, date('d-m-Y').'-data-siswa.pdf');
    }

    public function exportExcel()
    {
        noty()->success('Data berhasil diexport ke excel!');
        $this->dispatch('close-modal');
        return Excel::download(new SiswaExport, date('d-m-Y').'-data-siswa.xlsx');
    }

    public function render()
    {
        return view('components.backend.modal-export');
    }
}
