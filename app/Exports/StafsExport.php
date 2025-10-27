<?php

namespace App\Exports;

use App\Models\Staf;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Border;

class StafsExport implements FromArray, WithTitle, WithEvents, WithColumnFormatting
{
    public function array(): array
    {
        $stafs = Staf::with(['user' => function($query) {
            $query->withTrashed();
        }, 'jabatan'])->get()->map(function ($staf, $key) {

            return [
                $key + 1,
                $staf->user->nama_lengkap ?? '',
                "\u{200B}" . (string)$staf->no_staf,
                "\u{200B}" . (string)$staf->nip,
                "\u{200B}" . (string)$staf->nuptk,
                $staf->user->email ?? '',
                $staf->user->telepon ?? '',
                $staf->tanggal_masuk ? $staf->tanggal_masuk->format('d-m-Y') : '',
                $staf->status_kepegawaian,
                $staf->pendidikan_terakhir,
                $staf->jabatan->pluck('nama_jabatan')->implode(', ') ?? '',
            ];

        })->toArray();

        return [
            ['Data Guru dan Staf'],
            [''],
            [
                'No',
                'Nama Lengkap',
                'No Staf',
                'NIP',
                'NUPTK',
                'Email',
                'Telepon',
                'Tanggal Masuk',
                'Kepegawaian',
                'Pendidikan Terakhir',
                'Jabatan',
            ],
            ...$stafs
        ];
    }

    public function title(): string
    {
        return 'Data Guru dan Staf';
    }

    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_TEXT,
            'D' => NumberFormat::FORMAT_TEXT,
            'E' => NumberFormat::FORMAT_TEXT,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Title
                $sheet->mergeCells('A1:K1');
                $sheet->getRowDimension(1)->setRowHeight(28);
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
                $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

                // Headings
                $sheet->getStyle('A3:K3')->getFont()->setBold(true);
                $sheet->getStyle('A3:K3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

                // table
                $highestRow = $sheet->getHighestRow();
                $sheet->getStyle('A3:K' . $highestRow)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

                // Auto-fit
                foreach (range('A', 'K') as $column) {
                    $sheet->getColumnDimension($column)->setAutoSize(true);
                }
            },
        ];
    }
}
