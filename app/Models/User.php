<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, HasRoles;

    protected $table = 'users';

    protected $fillable = [
        'nik',
        'no_kk',
        'nama_lengkap',
        'email',
        'password',
        'foto_url',
        'telepon',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'status',
        'login_terakhir',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'tanggal_lahir'  => 'date',
        'status'         => 'boolean',
        'login_terakhir' => 'datetime',
    ];

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function staf()
    {
        return $this->hasOne(Staf::class);
    }

    public function siswa()
    {
        return $this->hasOne(Siswa::class);
    }

    public function wali()
    {
        return $this->hasOne(Wali::class);
    }

    public function scopeWithRoles($query, $roles)
    {
        return $query->whereHas('roles', function($q) use ($roles) {
            $q->whereIn('name', $roles);
        });
    }
}
