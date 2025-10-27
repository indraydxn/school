<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class UserTemplateExport implements FromArray, WithHeadings, ShouldAutoSize, WithEvents, WithTitle
{
    public function headings(): array
    {
        return [
            'nik',
            'no_kk',
            'nama_lengkap',
            'email',
            'password',
            'telepon',
            'tempat_lahir',
            'tanggal_lahir',
            'jenis_kelamin',
            'alamat',
            'status',
            'role'
        ];
    }

    public function array(): array
    {
        return [
            // Baris contoh data
            [
                '1234567890123456', // nik - 16 digit
                '123456789012345678', // no_kk - 18 digit
                'Nama Lengkap User', // nama_lengkap
                'user@example.com', // email
                'password123', // password (opsional, default: password123)
                '081234567890', // telepon
                'Jakarta', // tempat_lahir
                '1990-01-01', // tanggal_lahir (format: YYYY-MM-DD)
                'Laki-laki', // jenis_kelamin (Laki-laki/Perempuan)
                'Jl. Contoh No. 123, Jakarta', // alamat
                '1', // status (1 = aktif, 0 = tidak aktif)
                'siswa' // role (admin, guru, siswa, wali)
            ],
            // Baris informasi format
            [
                'NIK: 16 digit angka',
                'KK: 18 digit angka',
                'Nama lengkap',
                'Email valid & unik',
                'Password (opsional)',
                'Nomor telepon',
                'Tempat lahir',
                'Tanggal lahir (YYYY-MM-DD)',
                'Laki-laki/Perempuan',
                'Alamat lengkap',
                'Status: 1=aktif, 0=tidak',
                'Role: admin/guru/siswa/wali'
            ]
        ];
    }

    public function title(): string
    {
        return 'Data Pengguna';
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_TEXT,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Headings
                $sheet->getStyle('A1:L1')->getFont()->setBold(true);
                $sheet->getStyle('A1:L1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

                // Table
                $highestRow = $sheet->getHighestRow();
                $sheet->getStyle('A1:L' . $highestRow)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

                // Auto-fit
                foreach (range('A', 'L') as $column) {
                    $sheet->getColumnDimension($column)->setAutoSize(true);
                }
            },
        ];
    }
}
