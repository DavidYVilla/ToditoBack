<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;
    protected $table='compras';
    protected $fillable=[
        'usuario_id',
        'proovedor_id',
        'fecha_compra',
        'total_compra',
        'estado'
    ];

    //Relacion usuario
    public function usuario(){
        return $this->belongsTo(User::class,'usuario_id');
    }
    //Relacion con proveedor
    public function proovedor(){
        return $this->belongsTo(Proovedor::class,'proovedor_id');
    }
    //RELACION CON PEDIDOS DETALLES
     public function detalles(){
         return $this->hasMany(CompraDetalle::class,'compras_id');
 }
}
