<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $primaryKey = 'staff_id'; // Definir la clave primaria
    protected $fillable = [
        'name_staff',
        'apat_staff',
        'apmat_staff', // Asegúrate de que esto esté aquí
        'dni_staff',
        'birthdate_staff',
        'phone_staff',
        'email_staff',
        'bank_account_staff',
        'id_occupation_staff',
    ];
// Staff.php

    public function occupation()
    {
        return $this->belongsTo(Occupation::class, 'id_occupation_staff', 'occupation_id');
    }

    // Si es necesario, define las relaciones aquí
}
