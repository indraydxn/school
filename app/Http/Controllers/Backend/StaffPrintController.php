<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Staf;
use Illuminate\Http\Request;

class StaffPrintController extends Controller
{
    public function __invoke(Request $request)
    {
        $stafs = Staf::with(['user', 'jabatan'])->orderBy('no_staf')->get();
        return view('pages.backend.staff.print', [
            'stafs' => $stafs,
            'printedAt' => now(),
            'printedBy' => auth()->check() ? auth()->user()->nama_lengkap : 'System',
            'search' => $request->input('search'),
        ]);
    }
}
