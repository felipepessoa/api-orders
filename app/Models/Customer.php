<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'birthdate',
        'address',
        'complement',
        'neighborhood',
        'zip_code',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
