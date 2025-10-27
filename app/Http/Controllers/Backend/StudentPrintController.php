<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;

class StudentPrintController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('pages.backend.student.print', [
            "siswa"     => Siswa::with('user')->get(),
            'printedAt' => now(),
            'printedBy' => auth()->check() ? auth()->user()->nama_lengkap : 'System',
            'search'    => $request->input('search'),
        ]);
    }
}
