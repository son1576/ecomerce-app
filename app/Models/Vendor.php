<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'business_name',
        'business_license',
        'tax_id',
        'logo',
        'banner',
        'website',
        'description',
        'status', // Trạng thái active/inactive
        'created_at',
        'updated_at'
    ];
    public function user()    {

        return $this->belongsTo(User::class);
    }
}
