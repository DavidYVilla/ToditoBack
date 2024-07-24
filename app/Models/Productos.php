<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;
    protected $table='productos';
    protected $fillable=[
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'imagen',
        'categoria_id',
        'estado'
    ];
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
    public function getImagenURl(){
        if ($this->imagen && $this->imagen != 'default.png' && $this->imagen != null) {
            return asset('imagenes/productos/'.$this->imagen);
        } else{
            return asset('default.png');
        }
    }
}
