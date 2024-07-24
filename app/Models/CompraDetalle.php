<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompraDetalle extends Model
{
    use HasFactory;
    protected $table = 'compra_detalles';
    protected $fillable = [
        'compras_id',
'        producto_id',
'        cantidad',
'        costo'
    ];
    public function compra() {
        return $this->belongsTo(Compra::class, 'compras_id');
    }
    public function producto() {
        return $this->belongsTo(Productos::class, 'producto_id');
    }

}
