<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';  
    
    public $timestamps = false;

    protected $fillable = [
        'username',
        'password',
        'rol',
        'activo',
        'fecha_creacion',
        'id_empresa'
    ];
}