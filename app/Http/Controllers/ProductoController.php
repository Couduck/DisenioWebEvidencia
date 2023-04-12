<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $datos['productos']=Producto::Paginate(20);
        return view('Producto.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Producto.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datosProducto = request()->except('_token');

        $validacionDatos=[
            'nombreProducto' => 'required',
            'fotoURLProducto' => 'required|mimes:jpg,png',
            'descripcionProducto' => 'required',
            'precioProducto' => 'required|gt:0|numeric',
            'stockProducto' => 'required|gt:0|numeric'

        ];

        $mensajesValidacion=[
            'required' => 'Se requiere del atributo: :attribute ',
            'fotoURLProducto.mimes' => 'La foto proporcionada debe ser .jpg o .png',
            'numeric' => 'El atributo :atribute debe ser numerico',
            'gt' => 'El atributo :attribute no puede ser igual o menor a 0',
        ];

        $this->validate($request, $validacionDatos, $mensajesValidacion);

        if($request->hasFile('fotoURLProducto'))
        {
            $datosProducto['fotoURLProducto']=$request->file('fotoURLProducto')->store('uploads','public');
        }
        
        Producto::insert($datosProducto);

        return redirect('Producto')->with('mensaje', 'Nuevo Producto agregado con exito!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        return view('Producto.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $datosProducto = request()->except(['_token','_method']);
        $producto = Producto::findOrFail($id);

        $validacionDatos=[
            'nombreProducto' => 'required',
            'descripcionProducto' => 'required',
            'precioProducto' => 'required|gt:0|numeric',
            'stockProducto' => 'required|gt:0|numeric'

        ];

        $mensajesValidacion=[
            'required' => 'Se requiere del atributo: :attribute ',
            'fotoURLProducto.mimes' => 'La foto proporcionada debe ser .jpg o .png',
            'numeric' => 'El atributo :atributte debe ser numerico',
            'gt' => 'El atributo :attributte no puede ser igual o menor a 0',
        ];

        $this->validate($request, $validacionDatos, $mensajesValidacion);

        if($request->hasFile('fotoURLProducto'))
        {
            $producto = Producto::findOrFail($id);
            Storage::delete('public/'.$producto->fotoURLProducto);
            $datosProducto['fotoURLProducto']=$request->file('fotoURLProducto')->store('uploads','public');
        }

        Producto::where('id','=',$id)->update($datosProducto);
        $producto = Producto::findOrFail($id);
        return redirect('Producto')->with('mensaje', 'Producto actualizado con exito!!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);

        if(Storage::delete('public/'.$producto->fotoURLProducto))
        {
            Producto::destroy($id);
        }

        return redirect('Producto')->with('mensaje', 'Producto eliminado con exito!!');
    }
}
