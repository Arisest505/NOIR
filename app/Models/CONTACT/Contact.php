<?php

namespace App\Models\CONTACT;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'name', 'type', 'ruc', 'phone', 'email',
    ];
}
