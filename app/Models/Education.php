<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $fillable = [
        'title', 
        'subtitle', 
        'location',
        'start_date',
        'end_date',
        'grade',
        'description'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    // Or alternatively use $dates (for Laravel < 8)
    protected $dates = ['start_date', 'end_date'];
}