<?php

namespace App\Livewire;

use App\Models\Compra;
use Livewire\Component;
use App\Models\Productos;
use App\Models\Proovedor;
use Livewire\WithPagination;
use App\Models\CompraDetalle;

class ComprandoComponent extends Component
{
    use WithPagination;
    protected $paginationTheme='bootstrap';
    public $buscarProducto='',$total,$total_producto,$unidades,$proovedor_id;
    public $carrito=[],$ayuda=[];
    public function render()
    {
        $proovedores=Proovedor::orderBy('id', 'desc')->paginate(10);
        $productos=Productos::where('nombre','LIKE','%'.$this->buscarProducto.'%')->orderBy('id', 'desc')->paginate(10);

        return view('livewire.comprando-component', compact('proovedores','productos'));
    }
    public function agregarProducto($id){
        //Agregar el producto a la tabla carrito de compras
        //...
        $producto=Productos::find($id);

        $this->agregarCarrito($producto);

    }
    private function agregarCarrito($producto){
        //Agregar el producto a carrito de compras
        //...
        $existe=false;
        foreach($this->carrito as $item=>$value){
            if($value['producto_id']==$producto->id){
                $existe=true;
                break;
            }
        }
        if($existe==false){
         $elemento=[
            'producto_id'=>$producto['id'],
            'nombre'=>$producto['nombre'],
            'precio_venta'=>$producto['precio'],
            'unidades'=>1,
            'subtotal'=>0,
            'cantidad'=>1,

            ];
            $this->carrito[]=$elemento;
        }
        $this->calcularTotal();
    }
    public function cacularUnitario($item){
        if($this->carrito[$item]['unidades']>0 ){

            $this->carrito[$item]['precio_compra']=$this->carrito[$item]['subtotal']/$this->carrito[$item]['unidades'];
            $this->ayuda[$item]=$this->carrito[$item]['precio_compra']+($this->carrito[$item]['precio_compra']*0.3);
        }else{
            $this->carrito[$item]['unidades']=1;
             $this->ayuda[$item]=0;
        }
    }
    public function calcularTotal(){
        $this->total=0;
        foreach($this->carrito as $key=>$item){
            //$this->carrito[$key]['subtotal']=$item['cantidad']*$item['precio'];
            $this->total=$this->total+$this->carrito[$key]['subtotal'];
            $this->cacularUnitario($key);
        }
    }
    public function quitarProducto($posicion){
        //Quitar el producto del carrito de compras
        //...
        unset($this->carrito[$posicion]);
        $this->calcularTotal();
    }
    public function guardarPedido(){
        $this->validate([
            'proovedor_id' => 'required|exists:Proovedores,id',
            'total'      => 'required|numeric'
        ]);
        $compra=new Compra();
        $compra->usuario_id=auth()->user()->id;
        $compra->proovedor_id=$this->proovedor_id;
        $compra->fecha_compra=now();
        $compra->total_compra=$this->total;
        $compra->estado=true;
        if($compra->save()) {
             //dd($compra->id);
            foreach($this->carrito as $item){
                $compra_detalle=new CompraDetalle();
                $compra_detalle->compras_id=$compra->id;
                $compra_detalle->producto_id=$item['producto_id'];
                $compra_detalle->cantidad=$item['unidades'];
                $compra_detalle->costo=$item['subtotal'];
                $compra_detalle->save();
                $producto=Productos::find($item['producto_id']);
                $producto->stock=$producto->stock+$item['unidades'];
                $producto->precio_compra=$item['precio_compra'];
                $producto->precio=$item['precio_venta'];
                $producto->save();

            }


            session()->flash('success','Compra registrada exitosamente');
            $this->reset(['proovedor_id','total','carrito','unidades','ayuda']);
        } else{
            session()->flash('error','No se pudo registrar la compra');
        }

    }
}
