<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    //add this to test api
    protected $fillable = [
        'name', 
        'slug',
        'logo',
        'is_featured',
        'status',
    ];
}
