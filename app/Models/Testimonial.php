<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'name', 'role', 'organization', 'email', 'phone', 'image_url', 'quote'
    ];
}
