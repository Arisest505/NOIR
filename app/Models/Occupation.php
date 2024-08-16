<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Occupation extends Model
{
    use HasFactory;

    protected $table = 'occupation'; // Definir la tabla de la base de datos
    protected $primaryKey = 'occupation_id'; // Definir la clave primaria
    protected $fillable = ['name_occupation'];
    public $timestamps = false;
}
