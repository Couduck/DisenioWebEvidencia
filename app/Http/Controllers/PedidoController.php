<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Http\Request;
use DB;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $datos['pedidos']=Pedido::Paginate(20);
        return view('Pedido.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Pedido.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        
        $datosPedido = request()->except('_token');
        $productoReferido = DB::table('productos')->where('id', $datosPedido['id_producto'])->first();
        $stockpedido = $datosPedido['cantidadPedido'];

        if(is_null($productoReferido))
        {
            $datosPedido['id_producto'] = null;
            $this->validate($request, $errorNull = ['id_producto' => 'required'], $mensajeNull = ['required' => 'Se requiere del ID del producto', 'numeric' => 'El ID del producto debe existir en la tabla de Productos']);
            $this->validate($request, $errorNull = ['id_producto' => 'numeric'], $mensajeNull = ['numeric' => 'El ID del producto debe existir en la tabla de Productos']);
            $this->validate($request, $errorNull = ['id_producto' => 'alpha'], $mensajeNull = ['alpha' => 'El ID del producto debe existir en la tabla de Productos']);
        }

        else
        {
            $validacionDatos=[
                'id_producto' => 'required|numeric|nullable',
                'cantidadPedido' => 'required|numeric|lte:'.$productoReferido->stockProducto,
            ];
    
            $mensajesValidacion=[
                'required' => 'Se requiere del atributo: :attribute ',
                'id_producto.numeric' => 'El ID del producto debe ser numerico',
                'cantidadPedido.numeric' => 'La cantidad del producto debe ser numerico',
                'cantidadPedido.lte' => 'El stock solicitado ('.$datosPedido['cantidadPedido'].') del producto '.$datosPedido['id_producto'].' es mayor al que se tiene almacenado ('.$productoReferido->stockProducto.')',
            ];
    
            $this->validate($request, $validacionDatos, $mensajesValidacion);
    
    
            $datosPedido['precioUnitarioPedido'] = $productoReferido->precioProducto;
            $datosPedido['precioTotalPedido'] = $datosPedido['precioUnitarioPedido'] * $datosPedido['cantidadPedido'];
            $datosPedido['estatusPedido'] = 'En Proceso';
            
            Pedido::insert($datosPedido);
        }

        return redirect('Pedido')->with('mensaje', 'Nuevo Pedido agregado con exito!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $pedido = Pedido::findOrFail($id);
        return view('Pedido.edit', compact('pedido'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $datosPedido = request()->except(['_token','_method']);
        

        if($datosPedido['estatusPedido'] == 'Entregado')
        {
            $pedido = Pedido::findOrFail($id);
            $producto = Producto::findOrFail($pedido->id_producto);
            $producto->stockProducto -=  $pedido->cantidadPedido;
            $producto->save();
        }

        Pedido::where('id','=',$id)->update($datosPedido);
        $pedido = Pedido::findOrFail($id);
        return redirect('Pedido')->with('mensaje', 'Estado de Pedido actualizado con exito!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        Pedido::destroy($id);
        return redirect('Pedido')->with('mensaje', 'Pedido eliminado con exito!!');
    }
}
