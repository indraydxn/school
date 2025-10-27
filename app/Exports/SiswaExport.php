<?php

namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Border;

class SiswaExport implements FromArray, WithTitle, WithEvents, WithColumnFormatting
{
    public function array(): array
    {
        $siswa = Siswa::with('user')->get()->map(function ($s, $key) {

            return [
                $key + 1,
                "\u{200B}" . (string)$s->nis,
                "\u{200B}" . (string)$s->nisn,
                $s->tahun_masuk,
                $s->user->nama_lengkap ?? 'N/A',
                "\u{200B}" . (string)$s->user->nik ?? '',
                "\u{200B}" . (string)$s->user->no_kk ?? '',
                $s->user->tempat_lahir ?? '',
                $s->user->tanggal_lahir ? $s->user->tanggal_lahir->format('d-m-Y') : '',
                $s->user->jenis_kelamin ?? '',
                $s->user->alamat ?? '',
            ];

        })->toArray();

        return [
            ['Data Siswa'],
            [''],
            [
                'No',
                'NIS',
                'NISN',
                'Tahun Masuk',
                'Nama Lengkap',
                'NIK',
                'No KK',
                'Tempat Lahir',
                'Tanggal Lahir',
                'Jenis Kelamin',
                'Alamat',
            ],
            ...$siswa
        ];
    }

    public function title(): string
    {
        return 'Data Siswa';
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_TEXT,
            'C' => NumberFormat::FORMAT_TEXT,
            'F' => NumberFormat::FORMAT_TEXT,
            'G' => NumberFormat::FORMAT_TEXT,
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
