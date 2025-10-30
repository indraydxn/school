<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Wali;
use Illuminate\Http\Request;

class ParentPrintController extends Controller
{
    public function __invoke(Request $request)
    {
        $wali = Wali::with(['user', 'student.user'])->orderBy('id')->get();
        return view('pages.backend.parent.print', [
            'wali' => $wali,
            'printedAt' => now(),
            'printedBy' => auth()->check() ? auth()->user()->nama_lengkap : 'System',
            'search' => $request->input('search'),
        ]);
    }
}
