<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proovedor extends Model
{
    use HasFactory;
    protected $table = 'proovedores';
    protected $fillable = [
        'razon_social',
'        nit',
'        nombre',
'        apellido',
'        email',
'        telefono',
'        estado',
    ];
}
