@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Tabla de Productos</h1><br>

    <a href="{{url('Producto/create')}}">Registrar Nuevo Producto</a><br><br>

    <a href="{{url('Pedido')}}">Regresar a Tabla de Pedidos</a><br><br>

    <h4>

        @if(Session::has('mensaje'))
            {{Session::get('mensaje')}}
        @endIf

    </h4>

    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Foto</th>
                <th>Nombre Producto</th>
                <th>Descripcion</th>
                <th>Precio Producto</th>
                <th>Stock Producto</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($productos as $producto)
            <tr>
                <td>{{$producto->id}}</td>
                <td>
                    <img src="{{asset('storage').'/'.$producto->fotoURLProducto}}" width="100" alt="">
                </td>
                <td>{{$producto->nombreProducto}}</td>
                <td>{{$producto->descripcionProducto}}</td>
                <td>{{$producto->precioProducto}}</td>
                <td>{{$producto->stockProducto}}</td>
                <td>
                    
                    <a href="{{url('/Producto/'.$producto->id.'/edit')}}">
                        Editar
                    </a>
                    
                    <form action="{{url('/Producto/'.$producto->id)}}"  method="post">
                        @csrf
                        {{method_field('DELETE')}}
                        <input type="submit" onclick="return confirm('¿Quieres eliminar este registro? Se perdera para siempre')" value="Eliminar"/>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection