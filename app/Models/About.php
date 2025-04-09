<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $table = 'about';
    protected $fillable = [
        'name', 'birthday', 'website', 'phone', 'city', 'age', 'degree', 'email', 'freelance', 'description', 'image_url','additional_info'
    ];
}