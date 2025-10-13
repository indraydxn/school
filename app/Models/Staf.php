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
        'tahun_masuk',
        'status_kepegawaian',
        'pendidikan_terakhir',
        'jabatan',
    ];

    protected $casts = [
        'tahun_masuk' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
