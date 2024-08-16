<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Permission extends Model
{
    use HasFactory;
    protected $table = 'permissions';
    protected $primaryKey = 'permission_id';
    protected $fillable = ['name'];
    public $timestamps = false; // Si no tienes columnas de timestamp en la tabla

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_permissions', 'permission_id', 'user_id');
    }
}
