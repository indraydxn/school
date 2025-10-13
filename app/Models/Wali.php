<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wali extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'wali_siswa';

    protected $fillable = [
        'user_id',
        'student_id',
        'hubungan',
        'pendidikan_terakhir',
        'pekerjaan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function student()
    {
        return $this->belongsTo(Siswa::class);
    }
}
