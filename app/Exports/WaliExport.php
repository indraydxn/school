<?php

namespace App\Exports;

use App\Models\Wali;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Border;

class WaliExport implements FromArray, WithTitle, WithEvents, WithColumnFormatting
{
    public function array(): array
    {
        $wali = Wali::with(['user' => function($query) {
            $query->withTrashed();
        }, 'student.user'])->select(
            'id',
            'user_id',
            'student_id',
            'hubungan',
            'pendidikan_terakhir',
            'pekerjaan',
        )->get()->map(function ($w, $key) {

            return [
                $key + 1,
                $w->user->nama_lengkap ?? '',
                $w->hubungan ?? '',
                $w->student->user->nama_lengkap ?? '',
                $w->pendidikan_terakhir ?? '',
                $w->pekerjaan ?? '',
            ];

        })->toArray();

        return [
            ['Data Wali Siswa'],
            [''],
            [
                'No',
                'Nama Lengkap',
                'Hubungan',
                'Siswa',
                'Pendidikan Terakhir',
                'Pekerjaan',
            ],
            ...$wali
        ];
    }

    public function title(): string
    {
        return 'Data Wali Siswa';
    }

    public function columnFormats(): array
    {
        return [];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Title
                $sheet->mergeCells('A1:F1');
                $sheet->getRowDimension(1)->setRowHeight(28);
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
                $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

                // Headings
                $sheet->getStyle('A3:F3')->getFont()->setBold(true);
                $sheet->getStyle('A3:F3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

                // table
                $highestRow = $sheet->getHighestRow();
                $sheet->getStyle('A3:F' . $highestRow)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

                // Auto-fit
                foreach (range('A', 'F') as $column) {
                    $sheet->getColumnDimension($column)->setAutoSize(true);
                }
            },
        ];
    }
}
