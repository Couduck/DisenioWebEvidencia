@if(count($errors)>0)
    <ul>
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
@endif

@if($modo == 'Crear')
    <label for="id_producto">ID del producto comprado: </label>
    <input type="text" name = "id_producto" value="{{isset($pedido->id_producto)?$pedido->id_producto:''}}" id = "id_producto">
    <br>

    <label for="cantidadPedido">Cantidad del producto solicitada: </label>
    <input type="text" name = "cantidadPedido" value="{{isset($producto->cantidadPedido)?$producto->descripcionProducto:''}}" id = "cantidadPedido">
    <br>
    <br>
@endif

@if($modo == 'Editar')
    <label for="estatusPedido">Estado del pedido </label>
    <select name="estatusPedido" id = "estatusPedido">
        <option value="En Proceso" selected>En Proceso</option>
        <option value="En Ruta">En Ruta</option>
        <option value="Entregado">Entregado</option>
        </select>
    <br>
    <br>
@endif

<input type="submit" value = "{{$label}}">