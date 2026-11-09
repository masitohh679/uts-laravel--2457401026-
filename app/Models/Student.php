<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'nim',
        'name',
        'classroom',
        'birth_date',
        'average_score',
        'is_active',
        'address',
        'parent_phone',
    ];

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'average_score' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }
}
