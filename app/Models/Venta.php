<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    protected $table='ventas';
    protected $fillable=[
        'usuario_id',
        'cliente_id',
        'fecha_venta',
        'total_venta',
        'estado',
    ];
    public function usuario(){
        return $this->belongsTo(User::class,'usuario_id');
    }
    public function cliente(){
        return $this->belongsTo(Clientes::class,'cliente_id');
    }
     public function detalles(){
         return $this->hasMany(VentaDetalle::class,'ventas_id');
    }
}
