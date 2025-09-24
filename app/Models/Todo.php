<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'completed',
        'completed_at',
    ];

    /**
     * Konversi atribut completed_at ke tipe Carbon/datetime.
     *
     * @var array
     */
    protected $casts = [
        'completed_at' => 'datetime',
    ];
}
