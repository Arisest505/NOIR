<?php

namespace App\Models\LOGISTIC\MESSAGE;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id', 'receiver_id', 'message', 'read', 'file_path' // Añadir 'file_path'
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    // Agregar un accessor para obtener la URL completa del archivo
    public function getFilePathUrlAttribute()
    {
        if ($this->file_path) {
            return asset('storage/' . $this->file_path);
        }
        return null;
    }
}
