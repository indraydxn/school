<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siswa extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'siswa';

    protected $fillable = [
        'user_id',
        'nis',
        'nisn',
        'tahun_masuk',
    ];

    protected $casts = [
        'tahun_masuk' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function wali()
    {
        return $this->hasMany(Wali::class);
    }
}
