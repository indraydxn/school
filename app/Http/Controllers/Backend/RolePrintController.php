<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RolePrintController extends Controller
{
    public function __invoke(Request $request)
    {
        $roles = Role::with('permissions')->orderBy('name')->get();
        return view('pages.backend.role.print', [
            'roles' => $roles,
            'printedAt' => now(),
            'printedBy' => auth()->check() ? auth()->user()->nama_lengkap : 'System',
            'search' => $request->input('search'),
        ]);
    }
}
