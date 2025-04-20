<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'organization', 'start_date', 'end_date', 'description',
    ];

    protected $casts = [
        'end_date' => 'datetime',
    ];

    public function getEndDateAttribute($value)
    {
        return $value ?? 'Present';
    }
}