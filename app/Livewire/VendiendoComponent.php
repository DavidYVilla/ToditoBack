<?php

namespace App\Livewire;

use App\Models\Venta;
use Livewire\Component;
use App\Models\Clientes;
use App\Models\Productos;
use App\Models\VentaDetalle;
use Livewire\WithPagination;

class VendiendoComponent extends Component
{
    use WithPagination;
    protected $paginationTheme ='bootstrap';
    public $buscarProducto='',$total,$cliente_id;
    public $carrito=[];
    public function render()
    {
        $productos=Productos::where('nombre','LIKE','%'.$this->buscarProducto.'%')->orderBy('id','DESC')->paginate(10);
        $clientes=Clientes::where('estado',true)->orderby('id','DESC')->paginate(10);
        return view('livewire.vendiendo-component', compact('productos','clientes'));
    }
    public function agregarProducto($id){
        $producto=Productos::find($id);
        $this->agregarCarrito($producto);
    }
    private function agregarCarrito($producto){
        $existe=false;
        foreach($this->carrito as $item=>$value){
            if($value['producto_id']==$producto->id){
                $existe=true;
                $this->carrito[$item]['cantidad']++;
                $this->carrito[$item]['subtotal'] == $this->carrito[$item]['cantidad'] * $this->carrito[$item]['precio'];
                $this->calcularUnitario($item);
            }
        }
        if($existe==false){
            $elemento=[
                'producto_id' => $producto['id'],
                'nombre' => $producto['nombre'],
                'precio' => $producto['precio'],
                'stock' => $producto['stock']-1,
                'limite'=>$producto['stock'],
                'cantidad' => 1,
                'subtotal' => $producto['precio'],
            ];
            $this->carrito[]=$elemento;
        }

    }
    public function calcularUnitario($item){

        if($this->carrito[$item]['cantidad']<$this->carrito[$item]['limite']){
            $this->carrito[$item]['stock']=$this->carrito[$item]['limite']-$this->carrito[$item]['cantidad'];


        }else{
            $this->carrito[$item]['stock']=0;
            $this->carrito[$item]['cantidad']=$this->carrito[$item]['limite'];

            //$this->dispatch('mensaje-error', 'Has llegado al límite de stock');
        }
         $this->carrito[$item]['subtotal'] = $this->carrito[$item]['precio'] * $this->carrito[$item]['cantidad'];
         $this->calcularTotal();


    }

    public function calcularTotal(){
        $this->total=0;
        foreach($this->carrito as $key=>$item){
            $this->total += $this->carrito[$key]['subtotal'];


        }
    }
    public function quitarProducto($posicion){
        //Quitar el producto del carrito de compras
        //...
        unset($this->carrito[$posicion]);
        $this->calcularTotal();
    }
    public function guardarVenta(){
        $this->validate([
            'cliente_id' => 'required|exists:Clientes,id',
            'total'      => 'required|numeric'
        ]);
        $venta=new Venta();
        $venta->usuario_id=auth()->user()->id;
        $venta->cliente_id=$this->cliente_id;
        $venta->fecha_venta=now();
        $venta->total_venta=$this->total;
        $venta->estado=true;
        if($venta->save()) {
             //dd($venta->id);
            foreach($this->carrito as $item){
                $venta_detalle=new VentaDetalle();
                $venta_detalle->ventas_id=$venta->id;
                $venta_detalle->producto_id=$item['producto_id'];
                $venta_detalle->cantidad=$item['cantidad'];
                $venta_detalle->costo=$item['subtotal'];
                $venta_detalle->save();
                $producto=Productos::find($item['producto_id']);
                $producto->stock=$producto->stock-$item['cantidad'];

                $producto->save();

            }


            session()->flash('success','venta registrada exitosamente');
            $this->reset(['cliente_id','total','carrito']);
        } else{
            session()->flash('error','No se pudo registrar la venta');
        }

    }
}
