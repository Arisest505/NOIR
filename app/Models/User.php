<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Logistic\Message\Message;


class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $primaryKey = 'user_id'; // Especifica el nombre de la clave primaria

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'id_staff_user',
        'id_role_user',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'id_staff_user', 'staff_id');
    }
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'user_permissions', 'user_id', 'permission_id');
    }

    // Verificar si el usuario tiene un permiso
    public function hasPermission($permissionName)
    {
        return $this->permissions()->where('name', $permissionName)->exists();
    }
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id', 'user_id');
    }

    // Relación con los mensajes recibidos
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id', 'user_id');
    }
    public function latestMessage()
    {
        return $this->hasOne(Message::class, 'sender_id', 'user_id')
                    ->where(function ($query) {
                        $query->whereNotNull('message')
                              ->orWhereNotNull('file_path');
                    })
                    ->orderBy('created_at', 'desc');
    }
}
