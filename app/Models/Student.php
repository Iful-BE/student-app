<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'lembaga_id',
        'nis',
        'nama',
        'email',
        'foto',
        'status',
    ];

    protected $casts = [
    'status' => 'integer',
];
 

    public function lembaga()
    {
        return $this->belongsTo(Lembaga::class);
    }
}
