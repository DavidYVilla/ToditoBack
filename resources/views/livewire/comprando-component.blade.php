<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    @include('includes.alertas')
    {{-- Usuario: {{ auth()->user()->name }}
    productos: {{ $productos->count() }}
    carrito: {{ count($carrito) }}
    proveedores: {{ $proovedores_id }} --}}


    <form action="{{ route('compras.store') }}" method="POST">
        @csrf
        <div class="container-fluid mt-2">
            <div class="row justifi-content-center">
                <div class="col-sm-12 col-md-4 col-lg-4">
                    {{-- <div class="card-body"> --}}
                    <input type="text" wire:model.live="buscarProducto" class="form-control " placeholder="Buscar...">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>IMAGEN</th>
                                    <th>PRODUCTO</th>
                                    <th>AGREGAR</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($productos->count() < 1)
                                    <tr>
                                        <td colspan="4">No hay productos disponibles.</td>
                                    </tr>
                                    <a href="{{ route('productos.create') }}"
                                        class="btn btn-danger  ml-auto text-end">Agregar nuevo producto al
                                        Listado</a>
                                @else
                                    @foreach ($productos as $producto)
                                        <tr>
                                            <td><img src="{{ $producto->getImagenUrl() }}" alt=""
                                                    height="40px">
                                            </td>
                                            <td>{{ $producto->nombre }}</td>
                                            <td>
                                                <button type="button" wire:click="agregarProducto({{ $producto->id }})"
                                                    class="btn btn-primary" data-id="{{ $producto->id }}">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    {{-- </div> --}}
                </div>
                <div class="col-sm-12 col-md-8 col-lg-8">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Proveedor: </span>
                        <select wire:model.live="proovedor_id" class="form-control">
                            <option selected>Seleccione un Proveedor</option>
                            @foreach ($proovedores as $item)
                                {
                                <option value="{{ $item->id }}">{{ $item->nombre }}
                                </option>
                                }
                            @endforeach
                        </select>

                        @error('proovedor_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <a href="{{ route('proovedor.create') }}"class='btn small btn-warning'><i
                                class="fas fa-plus    "></i></a>
                    </div>
                    <div class="table-responsive mt-1">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="10%">#</th>
                                    <th>PRODUCTO</th>
                                    <th width="10%">UNIDADES</th>
                                    <th>PRECIO COMPRA</th>
                                    <th>PRECIO VENTA</th>
                                    <th>SUB TOTAL</th>
                                    <th><i class="fa fa-trash"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($carrito) == 0)
                                    <tr>
                                        <td colspan="6">No hay productos en el carrito.</td>
                                    </tr>
                                @else
                                    @foreach ($carrito as $key => $itemcar)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $itemcar['nombre'] }}</td>
                                            <td>
                                                <input wire:model.live="carrito.{{ $key }}.unidades"
                                                    wire:change="cacularUnitario({{ $key }})" type="number"
                                                    min="1" step="any" class="form-control">
                                            </td>
                                            <td>
                                                <input wire:model.live="carrito.{{ $key }}.precio_compra"
                                                    type="number" step="any" class="form-control" disabled>
                                            </td>
                                            <td>
                                                <input wire:model.live="carrito.{{ $key }}.precio_venta"
                                                    type="number" step="any" class="form-control">
                                                <span class="text-danger small">Precio Sugerido:
                                                    {{ $ayuda[$key] }}
                                                </span>
                                            </td>


                                            <td>
                                                <input wire:model.live="carrito.{{ $key }}.subtotal"
                                                    wire:change="calcularTotal()" type="number" step="any"
                                                    class="form-control">
                                            </td>
                                            <td>
                                                <button type="button" wire:click="quitarProducto({{ $key }})"
                                                    class="btn btn-sm btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5"><b>Total</b></td>
                                    <td><b>{{ $total }}</b></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="text-center">
                        @if ($total > 0)
                            <div class="text-center">
                                {{-- <button onclick="run()" class="btn btn-success" type="button">acetptar</button> --}}
                                <button type="button" wire:click="guardarPedido()" class="btn btn-success">Guardar
                                    Pedido <i class="fa fa-spinner" wire:loading
                                        wire:target="guardarPedido"></i></button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
