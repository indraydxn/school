<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    use SoftDeletes;

    protected $table = 'permissions';

    protected $fillable = [
        'module_id',
        'action_id',
        'name',
        'guard_name',
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function action()
    {
        return $this->belongsTo(Action::class);
    }
}
