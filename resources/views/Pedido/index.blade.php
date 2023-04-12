@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Tabla de Pedidos</h1><br>

    <a href="{{url('Pedido/create')}}">Registrar Nuevo Pedido</a><br><br>

    <a href="{{url('Producto')}}">Tabla de Productos</a><br><br>

    <h4>

        @if(Session::has('mensaje'))
            {{Session::get('mensaje')}}
        @endIf

    </h4>

    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>ID Producto Referido</th>
                <th>Cantidad Pedido</th>
                <th>Precio Unitario del Producto solicitado</th>
                <th>Precio Total del Pedido</th>
                <th>Estatus del pedido</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($pedidos as $pedido)
            <tr>
                <td>{{$pedido->id}}</td>
                <td>{{is_null($pedido->id_producto)?'NULL':$pedido->id_producto}}</td>
                <td>{{$pedido->cantidadPedido}}</td>
                <td>{{$pedido->precioUnitarioPedido}}</td>
                <td>{{$pedido->precioTotalPedido}}</td>
                <td>{{$pedido->estatusPedido}}</td>
                <td>
                    
                    @if($pedido->estatusPedido != 'Entregado' && is_null($pedido->id_producto) == false)
                        <a href="{{url('/Pedido/'.$pedido->id.'/edit')}}">
                            Editar
                        </a>

                    @endIf
                    
                    
                    <form action="{{url('/Pedido/'.$pedido->id)}}"  method="post">
                        @csrf
                        {{method_field('DELETE')}}
                        <input type="submit" onclick="return confirm('¿Quieres eliminar este registro? Se perdera para siempre')" value="Eliminar"/>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection