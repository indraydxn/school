<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class UsersExport implements FromArray, WithTitle, WithEvents
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
                $user->nik,
                $user->no_kk,
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
            ['Data Pengguna'],
            ['Di export pada: ' . now()->format('d-m-Y H:i:s')],
            ['Petugas: ' . (auth()->check() ? auth()->user()->nama_lengkap : 'System')],
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

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Title: bold, size 16
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);

                // Subtitles: size 12
                $sheet->getStyle('A2:A3')->getFont()->setSize(12);

                // Headings: bold
                $sheet->getStyle('A5:L5')->getFont()->setBold(true);
            },
        ];
    }
}
