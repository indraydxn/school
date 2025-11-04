<?php

namespace App\Exports;

use App\Models\Role;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Border;

class RolesExport implements FromArray, WithTitle, WithEvents, WithColumnFormatting
{
    public function array(): array
    {
        $roles = Role::with('permissions')->get()->map(function ($role, $key) {
            return [
                $key + 1,
                $role->name,
                $role->guard_name,
                $role->permissions->pluck('name')->implode(', ') ?: 'Tidak ada permission',
                $role->status ? 'Aktif' : 'Tidak aktif',
            ];
        })->toArray();

        return [
            ['Data Role Aplikasi'],
            [''],
            [
                'No',
                'Nama Role',
                'Guard Name',
                'Permissions',
                'Status',
            ],
            ...$roles
        ];
    }

    public function title(): string
    {
        return 'Data Role';
    }

    public function columnFormats(): array
    {
        return [
            // No specific formats needed
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Title
                $sheet->mergeCells('A1:E1');
                $sheet->getRowDimension(1)->setRowHeight(28);
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
                $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

                // Headings
                $sheet->getStyle('A3:E3')->getFont()->setBold(true);
                $sheet->getStyle('A3:E3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);

                // table
                $highestRow = $sheet->getHighestRow();
                $sheet->getStyle('A3:E' . $highestRow)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

                // Auto-fit
                foreach (range('A', 'E') as $column) {
                    $sheet->getColumnDimension($column)->setAutoSize(true);
                }
            },
        ];
    }
}
