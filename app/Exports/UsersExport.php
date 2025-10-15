<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return User::select('nik', 'nama_lengkap', 'email', 'telepon', 'jenis_kelamin', 'status')->get();
    }

    public function headings(): array
    {
        return [
            'NIK',
            'Nama Lengkap',
            'Email',
            'Telepon',
            'Jenis Kelamin',
            'Status',
        ];
    }
}