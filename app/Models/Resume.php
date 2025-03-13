<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    protected $fillable = [
        'title', 'subtitle', 'type', 'description', 'start_date', 'end_date', 'location', 'contact'
    ];
}