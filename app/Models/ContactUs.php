<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;

    protected $table = "contact_us";

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'contact_concluded_at' => 'datetime',
    ];
}
