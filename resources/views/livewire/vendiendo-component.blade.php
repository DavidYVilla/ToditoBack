<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    @include('includes.alertas')
    <form action="{{ route('ventas.store') }}" method="POST">
        @csrf
        <div class="container-fluid mt-2">
            <div class="row justifi-content-center">
                <div class="col-sm-12 col-md-5 col-lg-5">
                    {{-- <div class="card-body"> --}}
                    <input type="text" wire:model.live="buscarProducto" class="form-control " placeholder="Buscar...">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>IMAGEN</th>
                                    <th>PRODUCTO</th>
                                    <th>PRECIO</th>
                                    <th>STOCK</th>
                                    <th><i class="fa fa-plus"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($productos->count() < 1)
                                    <tr>
                                        <td colspan="4">No hay productos disponibles.</td>
                                    </tr>
                                    <a href="{{ route('productos.create') }}"
                                        class="btn btn-warning  ml-auto text-end">Agregar nuevo producto</a>
                                @else
                                    @foreach ($productos as $producto)
                                        <tr>
                                            <td><img src="{{ $producto->getImagenUrl() }}" alt=""
                                                    height="40px">
                                            </td>
                                            <td>{{ $producto->nombre }}</td>
                                            <td>{{ $producto->precio }}</td>
                                            <td>{{ $producto->stock }}</td>
                                            <td>
                                                <button type="button" wire:click="agregarProducto({{ $producto->id }})"
                                                    class="btn btn-primary btn-sm" data-id="{{ $producto->id }}">
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
                <div class="col-sm-12 col-md-7 col-lg-7">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Cliente: </span>
                        <select wire:model.live="cliente_id" class="form-control">
                            <option selected>Seleccione un Cliente</option>
                            @foreach ($clientes as $item)
                                {
                                <option value="{{ $item->id }}">{{ $item->nombre }} {{ $item->apellido }}
                                </option>
                                }
                            @endforeach
                        </select>

                        @error('cliente_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <a href="{{ route('clientes.create') }}"class='btn btn-sm btn-warning'><i
                                class="fas fa-plus    "></i></a>
                    </div>
                    <div class="table-responsive mt-1">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>PRODUCTO</th>
                                    <th>STOCK</th>
                                    <th>PRECIO</th>
                                    <th>CANTIDAD</th>
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
                                            <td>{{ $itemcar['stock'] }}</td>
                                            <td>{{ $itemcar['precio'] }}</td>
                                            <td>
                                                <input wire:model.live="carrito.{{ $key }}.cantidad"
                                                    wire:change="calcularUnitario({{ $key }})" type="number"
                                                    min="1" step="any" class="form-control small">
                                            </td>
                                            <td>{{ $itemcar['subtotal'] }}</td>

                                            {{-- <td>
                                                <input wire:model.live="carrito.{{ $key }}.subtotal"
                                                    wire:change="calcularTotal()" type="number" step="any"
                                                    class="form-control small">
                                            </td> --}}
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
                                <button type="button" wire:click="guardarVenta()" class="btn btn-success">Guardar
                                    <i class="fa fa-spinner" wire:loading wire:target="guardarVenta"></i></button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
