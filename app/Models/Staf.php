<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staf extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'staf';

    protected $fillable = [
        'user_id',
        'no_staf',
        'nip',
        'nuptk',
        'tanggal_masuk',
        'status_kepegawaian',
        'pendidikan_terakhir',
    ];

    protected $casts = [
        'tanggal_masuk' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jabatan()
    {
        return $this->belongsToMany(Jabatan::class, 'staf_has_jabatan', 'staf_id', 'jabatan_id');
    }

    public function getTahunMasukAttribute()
    {
        return $this->tanggal_masuk ? $this->tanggal_masuk->year : null;
    }

    public static function countGuru()
    {
        return self::whereHas('user', function($query) {
            $query->whereHas('roles', function($q) {
                $q->where('name', 'guru');
            });
        })->count();
    }
}
