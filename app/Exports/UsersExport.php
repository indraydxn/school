<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Border;

class UsersExport implements FromArray, WithTitle, WithEvents, WithColumnFormatting
{
    public function array(): array
    {
        $users = User::with('roles')->select(
                'id',
                'nik',
                'no_kk',
                'nama_lengkap',
                'email', 'telepon',
                'tempat_lahir',
                'tanggal_lahir',
                'jenis_kelamin',
                'alamat',
                'status'
            )->get()->map(function ($user, $key) {

            return [
                $key + 1,
                $user->nama_lengkap,
                "\u{200B}" . (string)$user->nik,
                "\u{200B}" . (string)$user->no_kk,
                $user->email,
                $user->telepon,
                $user->tempat_lahir,
                $user->tanggal_lahir->format('d-m-Y'),
                $user->jenis_kelamin,
                $user->alamat,
                $user->status ? 'Aktif' : 'Tidak aktif',
                $user->roles->pluck('name')->implode(', ') ?: 'Tidak ada role',
            ];

        })->toArray();

        return [
            ['Data Pengguna Aplikasi'],
            [''],
            [
                'No',
                'Nama Lengkap',
                'NIK',
                'No KK',
                'Email',
                'Telepon',
                'Tempat Lahir',
                'Tanggal Lahir',
                'Jenis Kelamin',
                'Alamat',
                'Status',
                'Role',
            ],
            ...$users
        ];
    }

    public function title(): string
    {
        return 'Data Pengguna';
    }

    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_TEXT,
            'D' => NumberFormat::FORMAT_TEXT,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Title);
                $sheet->mergeCells('A1:L1');
                $sheet->getRowDimension(1)->setRowHeight(28);
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
                $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

                // Headings
                $sheet->getStyle('A3:L3')->getFont()->setBold(true);
                $sheet->getStyle('A3:L3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

                // table
                $highestRow = $sheet->getHighestRow();
                $sheet->getStyle('A3:L' . $highestRow)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

                // Auto-fit
                foreach (range('A', 'L') as $column) {
                    $sheet->getColumnDimension($column)->setAutoSize(true);
                }
            },
        ];
    }
}
