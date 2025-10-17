<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserPrintController extends Controller
{
    public function __invoke(Request $request)
    {
        $users = User::with('roles')->orderBy('nama_lengkap')->get();
        return view('pages.backend.user.print', [
            'users' => $users,
            'printedAt' => now(),
            'printedBy' => auth()->check() ? auth()->user()->nama_lengkap : 'System',
            'search' => $request->input('search'),
        ]);
    }
}
