<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaDetalle extends Model
{
    use HasFactory;
    protected $table='venta_detalles';
    protected $fillable=[
        'ventas_id',
        'producto_id',
        'cantidad',
        'costo'
    ];
    public function venta(){
        return $this->belongsTo(Venta::class,'ventas_id');
    }
    public function producto(){
        return $this->belongsTo(Productos::class,'producto_id');
    }
}
